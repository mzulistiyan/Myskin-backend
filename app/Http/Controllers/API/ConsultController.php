<?php

namespace App\Http\Controllers\API;

use App\Models\Consults;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class ConsultController extends Controller
{
    public function consultasiPasien(Request $request)
    {
        try {
            $consult = Consults::with(['dokter', 'pasien','transaksi'])
            ->where('id_pasien', Auth::user()->id_pasien)
            ->Where('status_konsultasi', '!=' , 'PENDING');

            return ResponseFormatter::success(
                $consult->get(),
                'Data list konsultasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Data list konsultasi Gagal');
        }
    }

    public function consultasiDokter(Request $request)
    {
        try {
            $consult = Consults::with(['dokter', 'pasien','transaksi'])
            ->where('id_dokter', Auth::user()->id_dokter);

            return ResponseFormatter::success(
                $consult->get(),
                'Data list konsultasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Data list konsultasi Gagal');
        }
    }

    public function update(Request $request, $id)
    {
        $consults = Consults::findOrFail($id);

        $consults->update($request->all());

        return ResponseFormatter::success($consults, 'Transaksi berhasil diperbarui');
    }
}
