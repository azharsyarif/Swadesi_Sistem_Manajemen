<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    public function index(){
        $kendaraans = Kendaraan::all();

        return view('Operasional.kendaraan', compact('kendaraans'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nopol' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'panjang' => 'required|string',
            'lebar' => 'required|string',
            'tinggi' => 'required|string',
            'berat_maksimal' => 'required|string',
            'no_rangka' => 'required|string',
            'tanggal_pajak_plat' => 'required|date',
            'tanggal_pajak_stnk' => 'required|date',
        ]);

        if ($validator->fails()){
            return redirect()->route('karyawan.index')
                ->withErrors($validator)
                ->withInput();
        }

        $kendaraan = new Kendaraan();
        $kendaraan->nopol = $request->nopol;
        $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $kendaraan->panjang = $request->panjang;
        $kendaraan->lebar = $request->lebar;
        $kendaraan->tinggi = $request->tinggi;
        $kendaraan->berat_maksimal = $request->berat_maksimal;
        $kendaraan->no_rangka = $request->no_rangka;
        $kendaraan->tanggal_pajak_plat = $request->tanggal_pajak_plat;
        $kendaraan->tanggal_pajak_stnk = $request->tanggal_pajak_stnk;
        $kendaraan->save();
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan');
    }
}
