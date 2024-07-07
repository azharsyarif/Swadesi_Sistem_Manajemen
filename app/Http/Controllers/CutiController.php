<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cutis = PengajuanCuti::where('karyawan_id', $user->id)->get();

        return view('HR.cuti.cuti', compact('cutis','user'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required',
        ]);

        // Create a new leave request
        $cuti = new PengajuanCuti();
        $cuti->karyawan_id = Auth::id(); // Get the authenticated user's ID
        $cuti->tanggal_mulai = $request->tanggal_mulai;
        $cuti->tanggal_akhir = $request->tanggal_akhir;
        $cuti->alasan = $request->alasan;
        $cuti->status = 'Pending'; // Default status is Pending
        $cuti->save();

        return redirect()->route('pengajuan.cuti.index')
                        ->with('success', 'Pengajuan cuti berhasil disimpan.');
    }


    // public function confirmCuti(Request $request, $id)
    // {
    //     $cuti = Cuti::findOrFail($id);
    //     $cuti->update(['status' => 'approved']);

    //     // Deduct leave days from user's remaining leave count
    //     $user = User::findOrFail($cuti->user_id);
    //     $user->decrement('sisa_cuti');

    //     return Redirect::back()->with('success', 'Cuti berhasil disetujui');
    // }
    
}
