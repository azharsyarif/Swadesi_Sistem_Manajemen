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
        $users = User::with('role', 'divisions', 'position')->get();
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
    $users = User::with('role', 'divisions', 'position')->get();
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
    $user = User::with('divisions', 'position', 'role')->findOrFail($id);
    $roles = Role::all();
    $divisions = Divisions::all();
    $positions = Positions::all();

    return view('HR.karyawanCRUD.editKaryawan', compact('user', 'roles', 'divisions', 'positions'));
}
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'status' => 'required',
            'position_id' => 'required|exists:positions,id',
            'tanggal_join' => 'nullable|date',
            'alamat' => 'nullable|string',
            'emergency_call_nama' => 'nullable|string|max:255',
            'emergency_call_nomor' => 'nullable|string|max:20',
            'jatah_cuti' => 'nullable|integer',
            'divisions' => 'nullable|array',
            'divisions.*' => 'exists:divisions,id',
            'upload_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->fill($validatedData);

        if ($request->hasFile('upload_ktp')) {
            $file = $request->file('upload_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto_ktp', $filename);
            $user->upload_ktp = $path;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if (isset($validatedData['divisions'])) {
            $user->divisions()->sync($validatedData['divisions']);
        }

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate.');
    }

public function show($id)
{
    $karyawan = Karyawan::findOrFail($id); // Ubah model dan field sesuai dengan struktur Anda
    return view('HR.show', compact('karyawan'));
}


public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus.');
    }


    public function storeUser(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required', // Tambahkan validasi status
            'position_id' => 'required|exists:positions,id',
            'tanggal_join' => 'nullable|date',
            'alamat' => 'nullable|string',
            'emergency_call_nama' => 'nullable|string|max:255',
            'emergency_call_nomor' => 'nullable|string|max:20',
            'jatah_cuti' => 'nullable|integer',
            'divisions' => 'nullable|array', // Validasi untuk array divisions
            'divisions.*' => 'exists:divisions,id', // Validasi untuk setiap elemen di dalam array divisions
            'upload_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi untuk file upload KTP
        ]);
    
        // Mengunggah file KTP jika ada
        if ($request->hasFile('upload_ktp')) {
            $file = $request->file('upload_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto_ktp', $filename); // Simpan di storage/app/uploads/ktp
            $validatedData['upload_ktp'] = $path;
        }
    
        // Generate nomor karyawan dengan format KRY-(Angka)
        $validatedData['no_karyawan'] = $this->generateNoKaryawan();
    
        // Menyimpan user ke dalam database
        $user = new User();
        $user->fill($validatedData);
        $user->password = Hash::make($validatedData['password']);
        $user->save();
    
        // Menyimpan relasi many-to-many untuk divisions
        if (isset($validatedData['divisions'])) {
            $user->divisions()->attach($validatedData['divisions']);
        }
    
        // Redirect atau tampilkan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'User created successfully.');
    }
    
    // Fungsi untuk menghasilkan nomor karyawan unik dengan format KRY-(Angka)
    private function generateNoKaryawan()
    {
        $lastUser = User::orderBy('id', 'desc')->first();
        $lastNoKaryawan = $lastUser ? $lastUser->no_karyawan : null;
    
        if ($lastNoKaryawan) {
            // Ambil angka terakhir dari nomor karyawan sebelumnya
            $lastNumber = (int)str_replace('KRY-', '', $lastNoKaryawan);
            $newNoKaryawan = $lastNumber + 1;
        } else {
            // Jika belum ada, mulai dari 1001
            $newNoKaryawan = 1001;
        }
    
        return 'KRY-' . str_pad($newNoKaryawan, 4, '0', STR_PAD_LEFT);
    }
    




}


