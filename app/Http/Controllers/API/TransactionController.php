<?php

namespace App\Http\Controllers\API;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Consults;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        
        $transaction = Transaction::with(['dokter', 'pasien'])
        ->where('id_pasien', Auth::user()->id_pasien);
        
        return ResponseFormatter::success(
            $transaction->get(),
            'Data list transaksi berhasil diambil'
        );
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbarui');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokters,id_dokter',
        ]);
      
        
        $transaction = Transaction::create([
            'id_pasien' =>  Auth::user()->id_pasien,
            'id_dokter' => $request->id_dokter,
            'total_bayar' => 150000,
            'status_bayar' => "PENDING",
            'payment_url' => '',
        ]);
        
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Panggil Transaki yang sudah dibuat
        $transaction = Transaction::with(['pasien', 'dokter'])->find($transaction->id);

        // Membuat Transaksi Midtrans

        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total_bayar
            ],
            'enable_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        // Memanggil Midtrans

        try {
            // Ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            // Mengembalikan data ke API
            return ResponseFormatter::success($transaction, 'Transaksi Berhasil');
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Transaksi Gagal');
        }
    }

    public function callback(Request $request)
    {
        // Set konfigurasi
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notif
        $notification = new Notification();

        // Assign ke variabel untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle notifikasi status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status_bayar = 'PENDING';
                } else {
                    $transaction->status_bayar = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->status_bayar = 'SUCCESS';
            Consults::create([
                'id_pasien' => $transaction->id_pasien,
                'id_dokter' => $transaction->id_dokter,
                'id_transaksi' => $order_id,
                'status_konsultasi' => "PENDING",
                'diagnosa_sementara' => $transaction->diagnosa_sementara,
            ]);
        } elseif ($status == 'pending') {
            $transaction->status_bayar = 'PENDING';
        } elseif ($status == 'deny') {
            $transaction->status_bayar = 'CANCELLED';
        } elseif ($status == 'expire') {
            $transaction->status_bayar = 'CANCELLED';
        } elseif ($status == 'cancel') {
            $transaction->status_bayar = 'CANCELLED';
        }

        // Proses simpan Transaksi
        $transaction->save();
    }

    public function success(Request $request)
    {
        return view('midtrans.success');
    }

    public function unfinish(Request $request)
    {
        return view('midtrans.unfinish');
    }
    public function error(Request $request)
    {
        return view('midtrans.error');
    }
}
