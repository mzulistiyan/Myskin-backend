<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Dokters;

use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function indexTransaksi()
    {
        $data = Transaction::with(['dokter', 'pasien'])->get();
        return view('dashboard.transaction.index', compact('data'));
    }

    public function detailTransaksi($id)
    {
        $data = Transaction::find($id);
        $dokter = Dokters::get();
        return view('dashboard.transaction.edit', compact('data','dokter'));
    }


    public function updateTransaction(Request $request,$id)
    {
        $data = Transaction::find($id); 
        $data->id_dokter = $request->id_dokter;
        $data->update(); 
        return redirect('/dashboard/transaksi/index');
    }
}
