@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Kendaraan
            </div>
            <div class="card-body">
                <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nopol">Nomor Polisi</label>
                                <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" value="{{ old('nopol', $kendaraan->nopol) }}" required>
                                @error('nopol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <input type="text" class="form-control @error('jenis_kendaraan') is-invalid @enderror" id="jenis_kendaraan" name="jenis_kendaraan" value="{{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) }}" required>
                                @error('jenis_kendaraan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="panjang">Panjang (meter)</label>
                                <input type="number" step="0.01" class="form-control @error('panjang') is-invalid @enderror" id="panjang" name="panjang" value="{{ old('panjang', $kendaraan->panjang) }}" required>
                                @error('panjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lebar">Lebar (meter)</label>
                                <input type="number" step="0.01" class="form-control @error('lebar') is-invalid @enderror" id="lebar" name="lebar" value="{{ old('lebar', $kendaraan->lebar) }}" required>
                                @error('lebar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tinggi">Tinggi (meter)</label>
                                <input type="number" step="0.01" class="form-control @error('tinggi') is-invalid @enderror" id="tinggi" name="tinggi" value="{{ old('tinggi', $kendaraan->tinggi) }}" required>
                                @error('tinggi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="berat_maksimal">Berat Maksimal (kg)</label>
                                <input type="number" step="0.01" class="form-control @error('berat_maksimal') is-invalid @enderror" id="berat_maksimal" name="berat_maksimal" value="{{ old('berat_maksimal', $kendaraan->berat_maksimal) }}" required>
                                @error('berat_maksimal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_rangka">Nomor Rangka</label>
                                <input type="text" class="form-control @error('no_rangka') is-invalid @enderror" id="no_rangka" name="no_rangka" value="{{ old('no_rangka', $kendaraan->no_rangka) }}" required>
                                @error('no_rangka')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pajak_plat">Tanggal Pajak Plat</label>
                                <input type="date" class="form-control @error('tanggal_pajak_plat') is-invalid @enderror" id="tanggal_pajak_plat" name="tanggal_pajak_plat" value="{{ old('tanggal_pajak_plat', $kendaraan->tanggal_pajak_plat) }}" required>
                                @error('tanggal_pajak_plat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pajak_stnk">Tanggal Pajak STNK</label>
                                <input type="date" class="form-control @error('tanggal_pajak_stnk') is-invalid @enderror" id="tanggal_pajak_stnk" name="tanggal_pajak_stnk" value="{{ old('tanggal_pajak_stnk', $kendaraan->tanggal_pajak_stnk) }}" required>
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
    </div>
@endsection
