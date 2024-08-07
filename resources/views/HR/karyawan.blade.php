@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Data Karyawan') }}</h1>

    <!-- Tabel User -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Tombol Tambah Data -->
            <a href="/hr-karyawan-create" class="btn btn-primary mb-4">Tambah Data</a>

            <!-- Tabel Responsive -->
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Karyawan</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Tanggal Bergabung</th>
                            {{-- <th>Foto KTP</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->no_karyawan }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    @if ($user->status == 'karyawan_tetap')
                                        <span class="badge badge-info">Karyawan Tetap</span>
                                    @elseif ($user->status == 'kontrak')
                                        <span class="badge badge-warning">Kontrak</span>
                                    @else
                                        <span class="badge badge-secondary">Tidak Diketahui</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach($user->divisions as $division)
                                        <span class="badge badge-secondary">{{ $division->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $user->position->name }}</td>
                                <td>{{ $user->tanggal_join }}</td>
                                {{-- <td>
                                    @if($user->upload_ktp)
                                        <img src="{{ asset('storage/' . $user->upload_ktp) }}" alt="KTP {{ $user->name }}" style="max-width: 200px;">
                                    @else
                                        Tidak ada dokumen
                                    @endif
                                </td> --}}
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('karyawan.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
