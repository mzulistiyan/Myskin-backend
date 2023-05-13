<?php

namespace App\Http\Controllers\API;

use App\Models\Consults;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class ConsultController extends Controller
{
    public function getConsultasiPasien(Request $request)
    {
        try {
            $consult = Consults::with(['transaksi.dokter','transaksi.pasien'])
            ->whereRelation('transaksi.pasien', 'id_pasien', Auth::user()->id_pasien)
            ->Where('status_konsultasi', '!=' , 'PENDING');

            return ResponseFormatter::success(
                $consult->get(),
                'Data list konsultasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Data list konsultasi Gagal');
        }
    }

   

    public function getConsultasiDokter(Request $request)
    {
        try {
            $consult = Consults::with(['transaksi.dokter','transaksi.pasien'])
            ->whereRelation('transaksi.dokter', 'id_dokter', 1)->Where('status_konsultasi', '!=' , 'SELESAI');
            

            return ResponseFormatter::success(
                $consult->get(),
                'Data list konsultasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Data list konsultasi Gagal');
        }
    }

    public function getRekamMedis(Request $request)
    {
        try {

            $rekamMedis = RekamMedis::with(['konsultasi'])
            ->whereRelation('konsultasi', 'id_pasien', Auth::user()->id_pasien)
            ->get();

            return $rekamMedis;
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Data list konsultasi Gagal');
        }
    }

    public function updateKonsultasi(Request $request, $id)
    {
        $consults = Consults::findOrFail($id);
        $consults->update($request->all());

        RekamMedis::create([
            'id_konsultasi' => $id,
        ]);
        return ResponseFormatter::success($consults, 'Transaksi berhasil diperbarui');
    }

    
}
