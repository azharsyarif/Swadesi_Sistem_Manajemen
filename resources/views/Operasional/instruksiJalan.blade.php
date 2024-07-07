@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Instruksi Jalan') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <!-- Tabel Instruksi Jalan -->
            <div class="card shadow mb-4">
                
                <div class="card-body">
                    <button id="btnTambahData" class="btn btn-primary mb-4">Tambah Data</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No Surat Jalan</th>
                                    <th>Order</th>
                                    <th>Driver</th>
                                    <th>Kenek</th>
                                    <th>No Pol</th>
                                    <th>Tanggal Jalan</th>
                                    <th>Estimasi Waktu ke Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intruksiJalans as $ij)
                                    <tr>
                                        <td>{{ $ij->no_surat_jalan }}</td>
                                        <td>{{ $ij->order->No_Order }}</td>
                                        <td>{{ $ij->driver->name }}</td>
                                        <td>{{ $ij->kenek->name ?? '-' }}</td>
                                        <td>{{ $ij->nopol }}</td>
                                        <td>{{ $ij->tanggal_jalan }}</td>
                                        <td>{{ $ij->estimasi_waktu_ke_tujuan }} Jam</td>
                                        {{-- <td>
                                            <a href="{{ route('instruksi_jalan.edit', $ij->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('instruksi_jalan.destroy', $ij->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Tabel Instruksi Jalan -->

            <!-- Form Tambah/Edit Instruksi Jalan -->
            <div class="card shadow mb-4" id="formTambahData" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah/Edit Instruksi Jalan</h5>
                    <form action="{{ route('instruksi_jalan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="order_id">No Order</label>
                            <select class="form-control @error('order_id') is-invalid @enderror" id="order_id" name="order_id" required>
                                <option value="">Pilih No Order</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->No_Order }}</option>
                                @endforeach
                            </select>
                            @error('order_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="driver_id">Driver</label>
                            <select class="form-control @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id" required>
                                <option value="">Pilih Driver</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kenek_id">Kenek</label>
                            <select class="form-control @error('kenek_id') is-invalid @enderror" id="kenek_id" name="kenek_id">
                                <option value="">Pilih Kenek</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('kenek_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nopol">Nopol</label>
                            <select class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" required>
                                <option value="">Pilih Nopol</option>
                                @foreach ($kendaraans as $kendaraan)
                                    <option value="{{ $kendaraan->nopol }}">{{ $kendaraan->nopol }}</option>
                                @endforeach
                            </select>
                            @error('nopol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_jalan">Tanggal Jalan</label>
                            <input type="date" class="form-control @error('tanggal_jalan') is-invalid @enderror" id="tanggal_jalan" name="tanggal_jalan" value="{{ old('tanggal_jalan') }}" required>
                            @error('tanggal_jalan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_stuffing">Tanggal Stuffing (Muat)</label>
                            <input type="date" class="form-control @error('tanggal_stuffing') is-invalid @enderror" id="tanggal_stuffing" name="tanggal_stuffing" value="{{ old('tanggal_stuffing') }}">
                            @error('tanggal_stuffing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_stripping">Tanggal Stripping (Bongkar)</label>
                            <input type="date" class="form-control @error('tanggal_stripping') is-invalid @enderror" id="tanggal_stripping" name="tanggal_stripping" value="{{ old('tanggal_stripping') }}">
                            @error('tanggal_stripping')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="estimasi_waktu_ke_tujuan">Estimasi Waktu Ke Tujuan</label>
                            <input type="text" class="form-control @error('estimasi_waktu_ke_tujuan') is-invalid @enderror" id="estimasi_waktu_ke_tujuan" name="estimasi_waktu_ke_tujuan" value="{{ old('estimasi_waktu_ke_tujuan') }}" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Jam</div>
                            </div>
                            @error('estimasi_waktu_ke_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- End Form Tambah/Edit Instruksi Jalan -->
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
        });
    </script>
@endsection
