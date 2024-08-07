@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengajuan Izin Sakit') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="table-responsive">
                <a href="/create-izin-sakit" class="btn btn-primary mb-4">Ajukan Izin Sakit</a>
                <div class="d-flex">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Karyawan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Alasan</th>
                            <th>Jenis</th> <!-- New column for Jenis (Type) -->
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinSakits as $izinsakit)
                            <tr>
                                <td>{{ $izinsakit->id }}</td>
                                <td>{{ $izinsakit->karyawan->name }}</td>
                                <td>{{ $izinsakit->tanggal_mulai }}</td>
                                <td>{{ $izinsakit->tanggal_akhir }}</td>
                                <td>{{ $izinsakit->alasan }}</td>
                                <td>{{ $izinsakit->jenis }}</td>
                                <td>{{ $izinsakit->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
