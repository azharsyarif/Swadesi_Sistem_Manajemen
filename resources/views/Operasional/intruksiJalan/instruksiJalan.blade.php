@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Instruksi Jalan') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <!-- Tabel Instruksi Jalan -->
            <div class="card shadow mb-4">
                
                <div class="card-body">
                    <a href="/op-intruksiJalan/create" class="btn btn-primary mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No Surat Jalan</th>
                                    <th>Order</th>
                                    <th>Driver</th> 
                                    <th>Kenek</th>
                                    <th>No Pol</th>
                                    <th>Tanggal Jalan</th>
                                    <th>Estimasi Waktu ke Tujuan</th>
                                    <th>Estimasi Jarak</th>
                                    <th>Dibuat Pada</th>
                                    <th>Terakhir Diupdate</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intruksiJalans as $ij)
                                    <tr>
                                        <td>{{ $ij->no_surat_jalan }}</td>
                                        <td>{{ $ij->order->no_order }}</td>
                                        <td>{{ $ij->driver->name }}</td>
                                        <td>{{ $ij->kenek->name ?? '-' }}</td>
                                        <td>{{ $ij->nopol }}</td>
                                        <td>{{ $ij->tanggal_jalan }}</td>
                                        <td>{{ $ij->estimasi_waktu_ke_tujuan }} Jam</td>
                                        <td>{{ $ij->estimasi_jarak}} KM</td>
                                        <td>{{ $ij->created_at->format('d-m-Y H:i:s')}}</td>
                                        <td>{{ $ij->updated_at->format('d-m-Y H:i:s')}}</td>
                                        <td>
                                            <a href="{{ route('instruksi_jalan.edit', $ij->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('intruksiJalan.delete', $ij->id) }}" method="POST" style="display: inline;">
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
            <!-- End Tabel Instruksi Jalan -->
        </div>
    </div>
@endsection
