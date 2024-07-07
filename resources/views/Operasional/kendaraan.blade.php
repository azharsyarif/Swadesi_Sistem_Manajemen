@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Kendaraan') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <!-- Tabel Kendaraan -->
            <div class="card shadow mb-4">
                
                <div class="card-body">
                    <button id="btnTambahData" class="btn btn-primary mb-4">Tambah Data</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nomor Polisi</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Panjang</th>
                                    <th>Lebar</th>
                                    <th>Tinggi</th>
                                    <th>Berat Maksimal</th>
                                    <th>No Rangka</th>
                                    <th>Tanggal Pajak Plat</th>
                                    <th>Tanggal Pajak STNK</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraans as $kendaraan)
                                    <tr>
                                        <td>{{ $kendaraan->id }}</td>
                                        <td>{{ $kendaraan->nopol }}</td>
                                        <td>{{ $kendaraan->jenis_kendaraan }}</td>
                                        <td>{{ $kendaraan->panjang }} Meter</td>
                                        <td>{{ $kendaraan->lebar }} Meter</td>
                                        <td>{{ $kendaraan->tinggi }} Meter</td>
                                        <td>{{ $kendaraan->berat_maksimal }} KG</td>
                                        <td>{{ $kendaraan->no_rangka }}</td>
                                        <td>{{ $kendaraan->tanggal_pajak_plat }}</td>
                                        <td>{{ $kendaraan->tanggal_pajak_stnk }}</td>
                                        {{-- <td>
                                            <a href="{{ route('kendaraans.edit', $kendaraan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('kendaraans.destroy', $kendaraan->id) }}" method="POST" style="display: inline;">
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
            <!-- End Tabel Kendaraan -->

            <!-- Form Tambah/Edit Kendaraan -->
            <div class="card shadow mb-4" id="formTambahData" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah/Edit Kendaraan</h5>
                    <form action="{{ route('kendaraan.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nopol">Nomor Polisi</label>
                                    <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" value="{{ old('nopol') }}" required>
                                    @error('nopol')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                    <input type="text" class="form-control @error('jenis_kendaraan') is-invalid @enderror" id="jenis_kendaraan" name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}" required>
                                    @error('jenis_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="panjang">Panjang (meter)</label>
                                    <input type="number" step="0.01" class="form-control @error('panjang') is-invalid @enderror" id="panjang" name="panjang" value="{{ old('panjang') }}" required>
                                    @error('panjang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lebar">Lebar (meter)</label>
                                    <input type="number" step="0.01" class="form-control @error('lebar') is-invalid @enderror" id="lebar" name="lebar" value="{{ old('lebar') }}" required>
                                    @error('lebar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tinggi">Tinggi (meter)</label>
                                    <input type="number" step="0.01" class="form-control @error('tinggi') is-invalid @enderror" id="tinggi" name="tinggi" value="{{ old('tinggi') }}" required>
                                    @error('tinggi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="berat_maksimal">Berat Maksimal (kg)</label>
                                    <input type="number" step="0.01" class="form-control @error('berat_maksimal') is-invalid @enderror" id="berat_maksimal" name="berat_maksimal" value="{{ old('berat_maksimal') }}" required>
                                    @error('berat_maksimal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_rangka">Nomor Rangka</label>
                                    <input type="text" class="form-control @error('no_rangka') is-invalid @enderror" id="no_rangka" name="no_rangka" value="{{ old('no_rangka') }}" required>
                                    @error('no_rangka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_pajak_plat">Tanggal Pajak Plat</label>
                                    <input type="date" class="form-control @error('tanggal_pajak_plat') is-invalid @enderror" id="tanggal_pajak_plat" name="tanggal_pajak_plat" value="{{ old('tanggal_pajak_plat') }}" required>
                                    @error('tanggal_pajak_plat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_pajak_stnk">Tanggal Pajak STNK</label>
                                    <input type="date" class="form-control @error('tanggal_pajak_stnk') is-invalid @enderror" id="tanggal_pajak_stnk" name="tanggal_pajak_stnk" value="{{ old('tanggal_pajak_stnk') }}" required>
                                    @error('tanggal_pajak_stnk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
            <!-- End Form Tambah/Edit Kendaraan -->
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
