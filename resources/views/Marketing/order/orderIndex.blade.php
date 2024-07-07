@extends('layouts.admin')

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
                            <h4 class="font-weight-bold">
                                Total Orders: {{ $orders->count() }}
                            </h4>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Average Revenue</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">
                                Average Revenue: @currency($averageRevenue)
                            </h4>
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
                                    <div class="form-group">
                                        <label for="per_page">Show per page:</label>
                                        <select class="form-control" id="per_page" name="per_page" onchange="this.form.submit()">
                                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive mt-5">
                            <button id="btnTambahData" class="btn btn-primary mb-4">Tambah Data</button>
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
                                            <td>{{ $order->No_Order }}</td>
                                            <td>{{ $order->No_PO_Customer }}</td>
                                            <td>{{ $order->asal }}</td>
                                            <td>{{ $order->tujuan }}</td>
                                            <td>{{ $order->layanan }}</td>
                                            <td>{{ $order->rekanan->nama_pt }}</td>
                                            <td>{{ $order->rekanan->term_agrement }}</td>
                                            <td>@currency($order->total_harga_deal)</td>
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
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header">Form Data Order</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="No_PO_Customer">No PO Customer</label>
                                    <input type="text" class="form-control @error('No_PO_Customer') is-invalid @enderror" id="No_PO_Customer" name="No_PO_Customer" value="{{ old('No_PO_Customer') }}" required>
                                    @error('No_PO_Customer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="asal">Asal</label>
                                    <input type="text" class="form-control @error('asal') is-invalid @enderror" id="asal" name="asal" value="{{ old('asal') }}" required>
                                    @error('asal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tujuan">Tujuan</label>
                                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required>
                                    @error('tujuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="layanan">Pilih Layanan</label>
                                    <select class="form-control @error('layanan') is-invalid @enderror" id="layanan" name="layanan" required>
                                        <option value="">Pilih Jenis Kendaraan</option>
                                        <option value="darat">Darat</option>
                                        <option value="laut">Laut</option>
                                        <option value="udara">Udara</option>
                                        <option value="mobil">Mobil</option>
                                    </select>
                                    @error('layanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="formMobil" style="display: none;">
                                    <div class="form-group">
                                        <label for="kendaraan_id">Pilih Kendaraan</label>
                                        <select class="form-control @error('kendaraan_id') is-invalid @enderror" id="kendaraan_id" name="kendaraan_id">
                                            <option value="">Pilih Kendaraan</option>
                                            @foreach ($kendaraans as $kendaraan)
                                                <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>{{ $kendaraan->nopol }}</option>
                                            @endforeach
                                        </select>
                                        @error('kendaraan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="total_km">Total KM</label>
                                    <input type="text" class="form-control @error('total_km') is-invalid @enderror" id="total_km" name="total_km" value="{{ old('total_km') }}" required>
                                    @error('total_km')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_koli">Total Koli</label>
                                    <input type="text" class="form-control @error('total_koli') is-invalid @enderror" id="total_koli" name="total_koli" value="{{ old('total_koli') }}" required>
                                    @error('total_koli')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_berat">Total Berat</label>
                                    <input type="number" class="form-control @error('total_berat') is-invalid @enderror" id="total_berat" name="total_berat" value="{{ old('total_berat') }}" required>
                                    @error('total_berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi_barang">Deskripsi Barang</label>
                                    <textarea class="form-control @error('deskripsi_barang') is-invalid @enderror" id="deskripsi_barang" name="deskripsi_barang" required>{{ old('deskripsi_barang') }}</textarea>
                                    @error('deskripsi_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="rekanan_id">Pilih Perusahaan</label>
                                    <select class="form-control @error('rekanan_id') is-invalid @enderror" id="rekanan_id" name="rekanan_id" required>
                                        <option value="">Pilih Perusahaan</option>
                                        @foreach ($rekanans as $rekanan)
                                            <option value="{{ $rekanan->id }}" {{ old('rekanan_id') == $rekanan->id ? 'selected' : '' }}>{{ $rekanan->nama_pt }}</option>
                                        @endforeach
                                    </select>
                                    @error('rekanan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="harga_deal">Harga Deal</label>
                                    <input type="number" class="form-control @error('harga_deal') is-invalid @enderror" id="harga_deal" name="harga_deal" value="{{ old('harga_deal') }}" required>
                                    @error('harga_deal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_harga_deal">Total Harga Deal</label>
                                    <input type="number" step="0.01" class="form-control @error('total_harga_deal') is-invalid @enderror" id="total_harga_deal" name="total_harga_deal" value="{{ old('total_harga_deal') }}">
                                    @error('total_harga_deal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="upload_harga_deal">Upload Harga Deal</label>
                                    <input type="file" class="form-control @error('upload_harga_deal') is-invalid @enderror" id="upload_harga_deal" name="upload_harga_deal" value="{{ old('upload_harga_deal') }}" required>
                                    @error('upload_harga_deal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" id="btnCancelTambahData" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const layananSelect = document.getElementById('layanan');
            const formMobil = document.getElementById('formMobil');
            const kendaraanSelect = document.getElementById('kendaraan_id');
            const hargaDealInput = document.getElementById('harga_deal');
            const totalBeratInput = document.getElementById('total_berat');
            const totalHargaDealInput = document.getElementById('total_harga_deal');

            function toggleMobilFields() {
                if (layananSelect.value === 'mobil') {
                    formMobil.style.display = 'block';
                    kendaraanSelect.setAttribute('required', 'required');
                } else {
                    formMobil.style.display = 'none';
                    kendaraanSelect.removeAttribute('required');
                }
            }

            function calculateTotalHargaDeal() {
                const hargaDeal = parseFloat(hargaDealInput.value) || 0;
                const totalBerat = parseFloat(totalBeratInput.value) || 0;
                const totalHargaDeal = hargaDeal * totalBerat;
                totalHargaDealInput.value = totalHargaDeal.toFixed(2);
            }

            layananSelect.addEventListener('change', toggleMobilFields);
            hargaDealInput.addEventListener('input', calculateTotalHargaDeal);
            totalBeratInput.addEventListener('input', calculateTotalHargaDeal);

            // Initialize the fields visibility and calculation on page load
            toggleMobilFields();
            calculateTotalHargaDeal();
        });
    </script>
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

            // // Update term_agrement when No_Order changes
            // $('#No_Order').change(function() {
            //     var selectedOrder = $(this).find(':selected');
            //     var rekananId = selectedOrder.data('rekanan');
            //     $('#term_agrement').val(rekananId).change();
            // });
        });
    </script>

@endsection
