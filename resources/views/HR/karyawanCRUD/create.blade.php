@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Form Data Karyawan</h1>
    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role_id">Role <small class="text-muted">(Hak akses pengguna dalam sistem)</small></label>
                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="position_id">Jabatan <small class="text-muted">(Posisi atau judul pekerjaan dalam organisasi)</small></label>
                    <select class="form-control @error('position_id') is-invalid @enderror" id="position_id" name="position_id" required>
                        <option value="">Select Jabatan</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                        @endforeach
                    </select>
                    @error('position_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="division_id">Divisi</label>
                    <select class="form-control @error('division_id') is-invalid @enderror" id="division_id" name="division_id" required>
                        <option value="">Select Divisi</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_join">Tanggal Bergabung</label>
                    <input type="date" class="form-control @error('tanggal_join') is-invalid @enderror" id="tanggal_join" name="tanggal_join" value="{{ old('tanggal_join') }}" required>
                    @error('tanggal_join')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="emergency_call_nama">Nama Kontak Darurat</label>
                    <input type="text" class="form-control @error('emergency_call_nama') is-invalid @enderror" id="emergency_call_nama" name="emergency_call_nama" value="{{ old('emergency_call_nama') }}">
                    @error('emergency_call_nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="emergency_call_nomor">Nomor Panggilan Darurat</label>
                    <input type="text" class="form-control @error('emergency_call_nomor') is-invalid @enderror" id="emergency_call_nomor" name="emergency_call_nomor" value="{{ old('emergency_call_nomor') }}">
                    @error('emergency_call_nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jatah_cuti">Jatah Cuti</label>
                    <input type="number" class="form-control @error('jatah_cuti') is-invalid @enderror" id="jatah_cuti" name="jatah_cuti" value="{{ old('jatah_cuti', 12) }}">
                    @error('jatah_cuti')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tombol submit -->
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
