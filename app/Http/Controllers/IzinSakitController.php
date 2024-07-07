<?php

namespace App\Http\Controllers;

use App\Models\PengajuanIzinSakit;
use Illuminate\Http\Request;

class IzinSakitController extends Controller
{
    public function index()
    {
        $izinSakits = PengajuanIzinSakit::with('karyawan')->get();
        return view('HR.izin_sakit.izin_sakit', compact('izinSakits'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required',
            'bukti_dokumen' => 'nullable|file|max:10240', // max 10MB
        ]);

        // Simpan pengajuan izin sakit ke database
        $izinSakit = new PengajuanIzinSakit();
        $izinSakit->karyawan_id = auth()->user()->id;
        $izinSakit->tanggal_mulai = $request->tanggal_mulai;
        $izinSakit->tanggal_akhir = $request->tanggal_akhir;
        $izinSakit->alasan = $request->alasan;

        // Upload bukti dokumen jika ada
        if ($request->hasFile('bukti_dokumen')) {
            $file = $request->file('bukti_dokumen');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/bukti_izin_sakit', $fileName);
            $izinSakit->bukti_dokumen = $fileName;
        }

        $izinSakit->save();

        return redirect()->route('pengajuan.izin-sakit.index')->with('success', 'Pengajuan izin sakit berhasil diajukan.');
    }
}
