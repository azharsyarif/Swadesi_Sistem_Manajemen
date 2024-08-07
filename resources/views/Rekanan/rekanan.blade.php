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
                            <th>NPWP</th>
                            <th>Nomor Telepon</th>
                            <th>Jenis Usaha</th>
                            <th>Alamat</th>
                            <th>Bukti NPWP</th>
                            <th>Term Agreement</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekanan as $rekanan)
                            <tr>
                                <td>{{ $rekanan->nama_pt }}</td>
                                <td>{{ $rekanan->npwp }}</td>
                                <td>{{ $rekanan->no_tlp }}</td>
                                <td>{{ $rekanan->jenis_usaha }}</td>
                                <td>{{ $rekanan->alamat }}</td>
                                <td>
                                    @if($rekanan->upload_npwp)
                                        <a href="{{ asset('storage/' . $rekanan->upload_npwp) }}" target="_blank">Lihat Dokumen</a>
                                    @else
                                        Tidak ada dokumen
                                    @endif
                                </td>   
                                <td>Net {{ $rekanan->term_agrement }} Hari</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('rekanan.edit', $rekanan->id) }}" class="btn btn-primary btn-sm ">Edit</a>
                                        <form action="{{ route('rekanan.delete', $rekanan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
@endsection
