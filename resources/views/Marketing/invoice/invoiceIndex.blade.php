@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Invoice Management') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Pencarian PO Customer -->
            <form action="{{ route('marketing.invoice.index') }}" method="GET" class="mb-4">
                <div class="form-group">
                    <label for="search_no_po">Cari berdasarkan No PO Customer</label>
                    <input type="text" name="search_no_po" id="search_no_po" class="form-control" placeholder="Masukkan nomor PO" value="{{ request()->input('search_no_po') }}" pattern="\d*">
                    <small class="form-text text-muted">Hanya angka yang diperbolehkan.</small>
                    <small class="form-text text-muted">Contoh : 000004</small>
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <!-- Tabel Invoices -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="{{ route('marketing.invoice.create') }}" class="btn btn-primary mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No Order</th>
                                    <th>No PO Customer</th>
                                    <th>No Invoice</th>
                                    <th>Tanggal Kirim Invoice</th>
                                    <th>Term Agreement</th>
                                    <th>Biaya Operasional</th>
                                    <th>Revenue</th>
                                    <th>Net Income</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr data-toggle="collapse" data-target="#order-details-{{ $invoice->id }}" class="clickable">
                                        <td>{{ $invoice->id }}</td>
                                        <td class="text-primary cursor-pointer">Klik untuk melihat No Order <i class="fas fa-chevron-down"></i></td>
                                        <td>{{ $invoice->poCustomer ? $invoice->poCustomer->no_po : 'N/A' }}</td>
                                        <td>{{ $invoice->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($invoice->tanggal_kirim_inv)->format('Y-m-d') }}</td>
                                        <td>{{ $invoice->orders->first()->rekanan->term_agrement ?? 'N/A' }} Hari</td>
                                        <td>@currency($invoice->biaya_operasional)</td>
                                        <td>@currency($invoice->revenue)</td>
                                        <td>@currency($invoice->net_income)</td>
                                        <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    <tr id="order-details-{{ $invoice->id }}" class="collapse">
                                        <td colspan="10">
                                            <div class="p-3">
                                                <h5>Orders:</h5>
                                                <ul class="list-unstyled">
                                                    @foreach ($invoice->orders as $order)
                                                        <li class="border-bottom py-2">
                                                            <strong>No Order:</strong> {{ $order->no_order }} <br>
                                                            <strong>Tujuan:</strong> {{ $order->tujuanCity() }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Tabel Invoices -->

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $invoices->appends(['search_no_po' => request()->input('search_no_po')])->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

            // Toggle icon direction on row click
            $('#dataTable').on('click', 'tr[data-toggle="collapse"]', function () {
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
            });
        });
    </script>
@endsection
