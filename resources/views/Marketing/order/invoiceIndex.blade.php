@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Invoice Management') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Tabel Invoices -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <button id="btnTambahData" class="btn btn-primary mb-4">Tambah Data</button>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->No_Order }}</td>
                                        <td>{{ $invoice->No_Po_Customer }}</td>
                                        <td>{{ $invoice->No_Inv }}</td>
                                        <td>{{ $invoice->Tanggal_Kirim_Inv }}</td>
                                        <td>{{ $invoice->term_agrement }}</td>
                                        <td>{{ $invoice->Biaya_Operasional }}</td>
                                        <td>{{ $invoice->Revenue }}</td>
                                        <td>{{ $invoice->Net_Income }}</td>
                                        <td>
                                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display: inline;">
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
            <!-- End Tabel Invoices -->

            <!-- Form Tambah/Edit Invoice -->
            <div class="card shadow mb-4" id="formTambahData" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah/Edit Invoice</h5>
                    {{-- <form action="{{ route('invoices.store') }}" method="POST"> --}}
                        @csrf

                        <div class="form-group">
                            <label for="No_PO">No PO</label>
                            <select class="form-control @error('No_PO') is-invalid @enderror" id="No_PO" name="No_PO" required>
                                <option value="">Pilih No PO</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->po_customer }}">{{ $order->po_customer }}</option>
                                @endforeach
                            </select>
                            @error('No_PO')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="No_Order">No Order</label>
                            <select class="form-control @error('No_Order') is-invalid @enderror" id="No_Order" name="No_Order" required>
                                <option value="">Pilih No Order</option>
                                <!-- Options akan diisi dengan JavaScript berdasarkan pilihan No PO -->
                            </select>
                            @error('No_Order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="No_Inv">No Invoice</label>
                            <input type="text" class="form-control @error('No_Inv') is-invalid @enderror" id="No_Inv" name="No_Inv" value="{{ old('No_Inv') }}" readonly>
                            @error('No_Inv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Tanggal_Kirim_Inv">Tanggal Kirim Invoice</label>
                            <input type="date" class="form-control @error('Tanggal_Kirim_Inv') is-invalid @enderror" id="Tanggal_Kirim_Inv" name="Tanggal_Kirim_Inv" value="{{ old('Tanggal_Kirim_Inv') }}" required>
                            @error('Tanggal_Kirim_Inv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="term_agrement">Agreement Term</label>
                            <input type="text" class="form-control" id="term_agrement" name="term_agrement" value="{{ old('term_agrement') }}" readonly>
                            <!-- Nilai akan diisi dengan JavaScript berdasarkan pilihan No Order -->
                        </div>

                        <div class="form-group">
                            <label for="Biaya_Operasional">Biaya Operasional</label>
                            <input type="number" step="0.01" class="form-control @error('Biaya_Operasional') is-invalid @enderror" id="Biaya_Operasional" name="Biaya_Operasional" value="{{ old('Biaya_Operasional') }}" required>
                            @error('Biaya_Operasional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Revenue">Revenue</label>
                            <input type="number" step="0.01" class="form-control @error('Revenue') is-invalid @enderror" id="Revenue" name="Revenue" value="{{ old('Revenue') }}" readonly>
                            <!-- Nilai akan diisi dengan JavaScript berdasarkan pilihan No Order -->
                        </div>

                        <div class="form-group">
                            <label for="Net_Income">Net Income</label>
                            <input type="number" step="0.01" class="form-control" id="Net_Income" name="Net_Income" value="{{ old('Net_Income') }}" readonly>
                            <!-- Nilai akan diisi dengan JavaScript berdasarkan Biaya Operasional dan Revenue -->
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
            <!-- End Form Tambah/Edit Invoice -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle form visibility when button is clicked
            $('#btnTambahData').click(function() {
                $('#formTambahData').toggle('medium');
                $(this).text($(this).text() === 'Tambah Data' ? 'Tutup Form' : 'Tambah Data');
            });

            // Reset form when it is hidden
            $('#formTambahData').on('hide', function() {
                $(this).find('form')[0].reset();
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            });

            // Update term_agrement when No_Order changes
            $('#No_Order').change(function() {
                var selectedOrder = $(this).find(':selected');
                var rekananId = selectedOrder.data('rekanan');
                $('#term_agrement').val(rekananId).change();
            });
        });
    </script>
@endsection
