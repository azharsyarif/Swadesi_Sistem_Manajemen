@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Data PIC') }}</h1>

    <!-- Tabel User -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Tombol Tambah Data -->
            <a href="/pic-customer-create" class="btn btn-primary mb-4">Tambah Data</a>

            <!-- Tabel Responsive -->
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PT</th>
                            <th>Nama PIC</th>
                            <th>Nomor Telepon</th>
                            <th>Posisi</th>
                            <th>Cabang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekanans as $rekanan)
                            <tr>
                                <td>{{ $rekanan->id }}</td>
                                <td>{{ $rekanan->rekanan->nama_pt }}</td>
                                <td>{{ $rekanan->nama }}</td>
                                <td>{{ $rekanan->no_tlp }}</td>
                                <td>{{ $rekanan->posisi }}</td>
                                <td>{{ $rekanan->cabang }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('pic_customer.edit', $rekanan->id) }}" class="btn btn-primary btn-sm ">Edit</a>
                                        <form action="{{ route('pic.delete', $rekanan->id) }}" method="POST" style="display:inline;">
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
