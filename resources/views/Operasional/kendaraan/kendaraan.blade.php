@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Kendaraan') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <!-- Tabel Kendaraan -->
            <div class="card shadow mb-4">
                
                <div class="card-body">
                    <a href="/op-kendaraan-create" class="btn btn-primary mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nomor Polisi</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Panjang</th>
                                    <th>Lebar</th>
                                    <th>Tinggi</th>
                                    <th>Berat Maksimal</th>
                                    <th>No Rangka</th>
                                    <th>Tanggal Pajak Plat</th>
                                    <th>Tanggal Pajak STNK</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraans as $kendaraan)
                                    <tr>
                                        <td>{{ $kendaraan->id }}</td>
                                        <td>{{ $kendaraan->nopol }}</td>
                                        <td>{{ $kendaraan->jenis_kendaraan }}</td>
                                        <td>{{ $kendaraan->panjang }} Meter</td>
                                        <td>{{ $kendaraan->lebar }} Meter</td>
                                        <td>{{ $kendaraan->tinggi }} Meter</td>
                                        <td>{{ $kendaraan->berat_maksimal }} KG</td>
                                        <td>{{ $kendaraan->no_rangka }}</td>
                                        <td>{{ $kendaraan->tanggal_pajak_plat }}</td>
                                        <td>{{ $kendaraan->tanggal_pajak_stnk }}</td>
                                        <td>
                                            <a href="{{ route('kendaraaan.edit', $kendaraan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('kendaraan.delete', $kendaraan->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Tabel Kendaraan -->

            <!-- Form Tambah/Edit Kendaraan -->
            <div class="card shadow mb-4" id="formTambahData" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah/Edit Kendaraan</h5>
                </div>
            </div>
            <!-- End Form Tambah/Edit Kendaraan -->
        </div>
    </div>
@endsection
