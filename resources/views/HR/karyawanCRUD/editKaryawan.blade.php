@extends('layouts.admin')

@section('main-content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Rekanan</h1>
        <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>    
    <form action="{{ route('karyawan.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="role_id">Role <small>(Menentukan hak akses karyawan)</small></label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="tetap" {{ $user->status == 'tetap' ? 'selected' : '' }}>Karyawan Tetap</option>
                        <option value="kontrak" {{ $user->status == 'kontrak' ? 'selected' : '' }}>Karyawan Kontrak</option>
                    </select>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="position_id">Jabatan</label>
                    <select class="form-control" id="position_id" name="position_id" required>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" {{ $position->id == $user->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Divisions <small>(Pilih divisi/divisi yang terkait dengan karyawan)</small></label><br>
                    @foreach ($divisions as $division)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="division_{{ $division->id }}" name="divisions[]" value="{{ $division->id }}"
                                {{ in_array($division->id, old('divisions', $user->divisions->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="division_{{ $division->id }}">{{ $division->name }}</label>
                        </div>
                    @endforeach
                    @error('divisions')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_join">Tanggal Join</label>
                    <input type="date" class="form-control" id="tanggal_join" name="tanggal_join" value="{{ old('tanggal_join', $user->tanggal_join) }}">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}">
                </div>

                <div class="form-group">
                    <label for="emergency_call_nama">Nama Emergency Call</label>
                    <input type="text" class="form-control" id="emergency_call_nama" name="emergency_call_nama" value="{{ old('emergency_call_nama', $user->emergency_call_nama) }}">
                </div>

                <div class="form-group">
                    <label for="emergency_call_nomor">Nomor Emergency Call</label>
                    <input type="text" class="form-control" id="emergency_call_nomor" name="emergency_call_nomor" value="{{ old('emergency_call_nomor', $user->emergency_call_nomor) }}">
                </div>

                <div class="form-group">
                    <label for="jatah_cuti">Jatah Cuti</label>
                    <input type="number" class="form-control" id="jatah_cuti" name="jatah_cuti" value="{{ old('jatah_cuti', $user->jatah_cuti) }}">
                </div>
                <div class="form-group">
                    <label for="upload_ktp">Upload KTP</label>
                    <input type="file" class="form-control" id="upload_ktp" name="upload_ktp">
                    @if($user->upload_ktp)
                        <p><a href="{{ Storage::url($user->upload_ktp) }}">Lihat KTP</a></p>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
