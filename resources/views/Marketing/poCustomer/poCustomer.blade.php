@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Data PO Customer') }}</h1>

    <!-- Tabel PO Customer -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Tombol Tambah Data -->
            <a href="{{ route('marketing.po.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

            <!-- Tabel Responsive -->
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No PO</th>
                            <th>Nama PT</th>
                            <th>Alamat</th>
                            <th>PIC Customer</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($poCustomers as $poCustomer)
                            <tr>
                                <td>{{ $poCustomer->id }}</td>
                                <td>{{ $poCustomer->no_po }}</td>
                                <td>{{ $poCustomer->rekanan->nama_pt }}</td>
                                <td>{{ $poCustomer->alamat }}</td>
                                <td>{{ $poCustomer->picCustomer->nama }}</td>
                                <td>{{ $poCustomer->created_at }}</td>
                                <td>{{ $poCustomer->updated_at }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('marketing.po.viewEdit', $poCustomer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('marketing.po.destroy', $poCustomer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
