@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Rekanan') }}</h1>

    <!-- Tabel User -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Tombol Tambah Data -->
            <a href="/rekanan-create" class="btn btn-primary mb-4">Tambah Data</a>

            <!-- Tabel Responsive -->
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama PT</th>
                            <th>Nomor Telepon</th>
                            <th>Jenis Usaha</th>
                            <th>Alamat</th>
                            <th>Term Agreement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekanan as $rekanan)
                            <tr>
                                <td>{{ $rekanan->nama_pt }}</td>
                                <td>{{ $rekanan->no_tlp }}</td>
                                <td>{{ $rekanan->jenis_usaha }}</td>
                                <td>{{ $rekanan->alamat }}</td>
                                <td>Net {{ $rekanan->term_agrement }} Hari</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('rekanan.edit', $rekanan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
