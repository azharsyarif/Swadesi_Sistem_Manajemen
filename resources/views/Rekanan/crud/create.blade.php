@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Create Rekanan</h1>
    <form action="{{ route('rekanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card mb-4">
            <div class="card-header">Form Data Rekanan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_pt">Nama PT</label>
                    <input type="text" class="form-control @error('nama_pt') is-invalid @enderror" id="nama_pt" name="nama_pt" value="{{ old('nama_pt') }}" required>
                    @error('nama_pt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="npwp">NPWP</label>
                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" value="{{ old('npwp') }}" required>
                    @error('npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="upload_npwp">Upload NPWP</label>
                    <input type="file" class="form-control-file @error('upload_npwp') is-invalid @enderror" id="upload_npwp" name="upload_npwp" value="{{ old('upload_npwp') }}" required>
                    @error('upload_npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_tlp">No Tlp</label>
                    <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" id="no_tlp" name="no_tlp" value="{{ old('no_tlp') }}" required>
                    @error('no_tlp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_usaha">Jenis Usaha</label>
                    <input type="text" class="form-control @error('jenis_usaha') is-invalid @enderror" id="jenis_usaha" name="jenis_usaha" value="{{ old('jenis_usaha') }}" required>
                    @error('jenis_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="term_agrement">Term Agreement</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control @error('term_agrement') is-invalid @enderror" id="term_agrement" name="term_agrement" value="{{ old('term_agrement') }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Hari</div>
                        </div>
                        @error('term_agrement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol submit -->
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
