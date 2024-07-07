@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Karyawan') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Form Edit Karyawan -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Karyawan</h5>
                    <form action="{{ route('karyawan.update', $karyawans->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Input untuk User -->
                        <div class="card mb-4">
                            <div class="card-header">User Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $karyawans->user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $karyawans->user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    <small class="form-text text-muted">Isi hanya jika ingin mengubah password.</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $karyawans->user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Input untuk Karyawan -->
                        <div class="card">
                            <div class="card-header">Karyawan Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $karyawans->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="divisi">Divisi</label>
                                    <input type="text" class="form-control @error('divisi') is-invalid @enderror" id="divisi" name="divisi" value="{{ old('divisi', $karyawans->divisi) }}" required>
                                    @error('divisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $karyawans->jabatan) }}" required>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_join">Tanggal Bergabung</label>
                                    <input type="date" class="form-control @error('tanggal_join') is-invalid @enderror" id="tanggal_join" name="tanggal_join" value="{{ old('tanggal_join', $karyawans->tanggal_join) }}" required>
                                    @error('tanggal_join')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ old('alamat', $karyawans->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="emergency_call">Emergency Call</label>
                                    <input type="text" class="form-control @error('emergency_call') is-invalid @enderror" id="emergency_call" name="emergency_call" value="{{ old('emergency_call', $karyawans->emergency_call) }}">
                                    @error('emergency_call')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jatah_cuti">Jatah Cuti</label>
                                    <input type="number" class="form-control @error('jatah_cuti') is-invalid @enderror" id="jatah_cuti" name="jatah_cuti" value="{{ old('jatah_cuti', $karyawans->jatah_cuti) }}">
                                    @error('jatah_cuti')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tombol submit -->
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
            <!-- End Form Edit Karyawan -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btnTambahData').click(function() {
                $('#formTambahData').toggle('medium');
                $(this).text($(this).text() === 'Tambah Data' ? 'Tutup Form' : 'Tambah Data');
            });

            $('#formTambahData').on('hide', function() {
                $(this).find('form')[0].reset();
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            });
        });
    </script>
@endsection
