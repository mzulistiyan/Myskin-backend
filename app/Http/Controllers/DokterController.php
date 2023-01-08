<?php

namespace App\Http\Controllers;

use App\Models\Dokters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function indexDokter()
    {
        $data = DB::table('dokters')->get();
        return view('dashboard.dokter.index', compact('data'));
    }

    public function createDokter(Request $request)
    {
        $data = $request->all();
        Dokters::create($data);
        return back();
    }

    public function deleteDokter($id)
    {
        $data = Dokters::find($id);
        $data->delete();

        return back();
    }

    public function detailDokter($id)
    {
        $data = Dokters::find($id);
       
        return view('dashboard.dokter.edit', compact('data'));
    }

    public function updateDokter(Request $request,$id)
    {
        $data = Dokters::find($id); 
        $data->nama_dokter = $request->nama_dokter;
        $data->NIK = $request->NIK;
        $data->no_STR = $request->no_STR;
        $data->no_SIP = $request->no_SIP;
        $data->rumah_sakit = $request->rumah_sakit;
        $data->update(); 
        return redirect('/dashboard/dokter/index');
    }
}
