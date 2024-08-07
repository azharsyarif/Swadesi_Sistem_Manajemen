<?php
namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use App\Models\PengajuanIzinSakit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $pengajuanCuti = PengajuanCuti::with('karyawan')->where('status', 'Pending')->get();
        $pengajuanIzinSakit = PengajuanIzinSakit::with('karyawan')->where('status', 'Pending')->get();

        $pengajuan = $pengajuanCuti->merge($pengajuanIzinSakit);

        return view('HR.cuti.approval', compact('pengajuan'));
    }

    public function approveCuti($id)
    {
        $cuti = PengajuanCuti::findOrFail($id);

        // Update status to 'Diterima'
        $cuti->status = 'Diterima';
        $cuti->approved_by = Auth::id();
        $cuti->save();

        $user = User::findOrFail($cuti->karyawan_id);
        $user->jatah_cuti -= 1;
        $user->save();

        return redirect()->route('approval.index')->with('success', 'Cuti berhasil disetujui');
    }

    public function rejectCuti($id)
    {
        $cuti = PengajuanCuti::findOrFail($id);

        $cuti->status = 'Ditolak';
        $cuti->approved_by = Auth::id(); 
        $cuti->save();

        return redirect()->route('approval.index')->with('error', 'Cuti berhasil ditolak');
    }

    public function approveIzinSakit($id)
    {
        $izinSakit = PengajuanIzinSakit::findOrFail($id);

        // Update status to 'Diterima'
        $izinSakit->status = 'Diterima';
        $izinSakit->approved_by = Auth::id();
        $izinSakit->save();

        return redirect()->route('approval.index')->with('success', 'Pengajuan izin sakit berhasil disetujui');
    }

    public function rejectIzinSakit($id)
    {
        $izinSakit = PengajuanIzinSakit::findOrFail($id);

        // Update status to 'Ditolak'
        $izinSakit->status = 'Ditolak';
        $izinSakit->approved_by = Auth::id();
        $izinSakit->save();

        return redirect()->route('approval.index')->with('error', 'Pengajuan izin sakit berhasil ditolak');
    }
}
