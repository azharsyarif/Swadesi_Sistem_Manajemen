@extends('layouts.admin')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Order Management') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Total Orders</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Total Orders: {{ $orders->count() }}</h4>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Average Revenue</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Average Revenue: @currency($averageRevenue)</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="m-0 font-weight-bold text-primary">Filter No. PO</h6>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('marketing.order.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="search_po" name="search_po" value="{{ request('search_po') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                                        @if (request()->has('search_po'))
                                            <div class="input-group-append">
                                                <a href="{{ route('marketing.order.index') }}" class="btn btn-outline-secondary">X</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="per_page">Show per page:</label>
                                        <select class="form-control" id="per_page" name="per_page" onchange="this.form.submit()">
                                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <a href="/order-view-create" id="btnTambahData" class="btn btn-primary mb-4">Tambah Data</a>
                        </div>
                        <div class="table-responsive mt-5">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO ORDER</th>
                                        <th>NO PO</th>
                                        <th>ASAL</th>
                                        <th>TUJUAN</th>
                                        <th>JENIS LAYANAN</th>
                                        <th>NAMA PERUSAHAAN</th>
                                        <th>TERM AGREEMENT</th>
                                        <th>TOTAL HARGA DEAL</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->no_order }}</td>
                                            <td>{{ $order->poCustomer->no_po }}</td>
                                            <td>{{ $order->asalCity() }}</td>
                                            <td>{{ $order->tujuanCity() }}</td>
                                            <td>{{ $order->layanan }}</td>
                                            <td>{{ $order->rekanan->nama_pt }}</td>
                                            <td>{{ $order->rekanan->term_agrement }} Hari</td>
                                            <td>@currency($order->total_harga_deal)</td>                                            
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            {{-- <td>
                                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-start" id="formTambahData" @if ($errors->any()) style="display: block;" @else style="display: none;" @endif>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
