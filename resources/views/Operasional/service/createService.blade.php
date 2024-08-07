@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create Order
            </div>
            <div class="card-body">
                <form action="{{ route('service-kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="kendaraan_id">Nomor Polisi Kendaraan</label>
                        <select class="form-control @error('kendaraan_id') is-invalid @enderror" id="kendaraan_id" name="kendaraan_id" required>
                            <option value="">Pilih Nomor Polisi</option>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>{{ $kendaraan->nopol }}</option>
                            @endforeach
                        </select>
                        @error('kendaraan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Driver</label>
                        <select class="form-control @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id" required>
                            <option value="">Pilih Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        @error('driver_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_service">Total Service</label>
                        <input type="number" step="0.01" class="form-control @error('total_service') is-invalid @enderror" id="total_service" name="total_service" value="{{ old('total_service') }}" required>
                        @error('total_service')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="upload_dokumen">Upload Dokumen</label>
                        <input type="file" class="form-control-file @error('upload_dokumen') is-invalid @enderror" id="upload_dokumen" name="upload_dokumen">
                        @error('upload_dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <h5>Kondisi Item</h5>
                    <p>Isi dengan kondisi-kondisi barang kendaraan yang terkait dengan service ini.</p>

                    <div id="item_conditions">
                        <!-- Dynamic item conditions fields -->
                    </div>

                    <button type="button" id="btnTambahItem" class="btn btn-success btn-sm mb-3">Tambah Kondisi Item</button>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Add dynamic item condition fields
            var nextItemNumber = 1;
            $('#btnTambahItem').click(function() {
                var newItem = `
                <div class="row mb-2" id="item_${nextItemNumber}">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="item_name[]" placeholder="Nama Komponen" required>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="item_value[]" required onchange="showDescription(this)">
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="desc[]" placeholder="Deskripsi" style="display:none;">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusItem(${nextItemNumber})">X</button>
                    </div>
                </div>
            `;
                $('#item_conditions').append(newItem);
                nextItemNumber++;
            });

            // Function to remove item condition field
            window.hapusItem = function(id) {
                $('#item_' + id).remove();
            };

            // Function to show/hide description based on item condition
            window.showDescription = function(select) {
                var descInput = $(select).closest('.row').find('input[name="desc[]"]');
                if (select.value === 'Rusak') {
                    descInput.show();
                } else {
                    descInput.hide();
                }
            };
        });
    </script>
@endsection
