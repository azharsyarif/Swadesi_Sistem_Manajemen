@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Data Karyawan') }}</h1>

            <!-- Tabel User -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- Tombol Tambah Data -->
                    <a href="/hr-karyawan-create"  class="btn btn-primary mb-4">Tambah Data</a>

                    <!-- Tabel Responsive -->
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Divisi</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->division->name }}</td>
                                        <td>{{ $user->position->name }}</td>
                                        <td>{{ $user->tanggal_join }}</td>
                                        {{-- <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
