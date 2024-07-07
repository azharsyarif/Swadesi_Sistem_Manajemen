<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Divisions;
use App\Models\Karyawan;
use App\Models\Positions;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    public function karyawanIndex()
    {
        $roles = Role::all();
        $users = User::with('role', 'division', 'position')->get();
        $divisions = Divisions::all();
        $positions = Positions::all();
    
        return view('HR.karyawan', [
            'roles' => $roles,
            'divisions' => $divisions,
            'positions' => $positions,
            'users' => $users
        ]);
    }

    // FUNCTION


    public function viewCreate()
{
    $roles = Role::all();
    $users = User::with('role', 'division', 'position')->get();
    $divisions = Divisions::all();
    $positions = Positions::all();

    return view('HR.karyawanCRUD.create', [
        'roles' => $roles,
        'divisions' => $divisions,
        'positions' => $positions,
        'users' => $users
    ]);
}

    public function edit($id)
{
    $roles = Role::all(); // Fetch all roles
    $karyawans = Karyawan::findOrFail($id);
    return view('HR.editKaryawan', compact('roles','karyawans'));
}
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        // Validasi data yang akan diupdate
        'nama' => 'required|string|max:255',
        'divisi' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'tanggal_join' => 'required|date',
        'alamat' => 'nullable|string',
        'emergency_call' => 'nullable|string|max:255',
        'jatah_cuti' => 'nullable|integer',
    ]);

    try {
        // Cari karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);

        // Update data karyawan
        $karyawan->nama = $validatedData['nama'];
        $karyawan->divisi = $validatedData['divisi'];
        $karyawan->jabatan = $validatedData['jabatan'];
        $karyawan->tanggal_join = $validatedData['tanggal_join'];
        $karyawan->alamat = $validatedData['alamat'];
        $karyawan->emergency_call = $validatedData['emergency_call'];
        $karyawan->jatah_cuti = $validatedData['jatah_cuti'] ?? 12;
        $karyawan->save();

        // Update juga data user jika ada perubahan
        $user = $karyawan->user;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate'); // Redirect ke halaman index karyawan dengan pesan sukses
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengupdate karyawan: ' . $e->getMessage())->withInput(); // Redirect kembali dengan pesan error dan data input sebelumnya
    }
}

public function show($id)
{
    $karyawan = Karyawan::findOrFail($id); // Ubah model dan field sesuai dengan struktur Anda
    return view('HR.show', compact('karyawan'));
}


public function delete($id)
{
    // Cari karyawan berdasarkan ID
    $karyawan = Karyawan::findOrFail($id);

    // Hapus user terkait
    $user = $karyawan->user;
    if ($user) {
        $user->delete();
    }

    // Hapus karyawan
    $karyawan->delete();

    // Redirect atau beri respons sukses
    return redirect()->route('karyawan.index')->with('success', 'Karyawan dan user terkait berhasil dihapus');
}
    public function storeUser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'division_id' => 'required|exists:divisions,id',
            'position_id' => 'required|exists:positions,id',
            'tanggal_join' => 'nullable|date',
            'alamat' => 'nullable|string',
            'emergency_call_nama' => 'nullable|string|max:255',
            'emergency_call_nomor' => 'nullable|string|max:255',
            'jatah_cuti' => 'required|integer',
        ]);

        // Create the user
        $user = User::create($validatedData);

        // Redirect back with success message
        return redirect()->route('karyawan.index')->with('success', 'User created successfully.');
    }
}


