@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Create PIC Customer</h1>
    <form action="{{ route('pic_customer.store') }}" method="POST">
        @csrf

        <div class="card mb-4">
            <div class="card-header">Form Data PIC Customer</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_pt">Nama PT</label>
                    <select class="form-control @error('nama_pt') is-invalid @enderror" id="nama_pt" name="nama_pt" required>
                        <option value="">Pilih Nama PT</option>
                        @foreach($rekanans as $rekanan)
                            <option value="{{ $rekanan->id }}" {{ old('nama_pt') == $rekanan->id ? 'selected' : '' }}>{{ $rekanan->nama_pt }}</option>
                        @endforeach
                    </select>
                    @error('nama_pt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama')
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
                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control @error('posisi') is-invalid @enderror" id="posisi" name="posisi" value="{{ old('posisi') }}" required>
                    @error('posisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cabang">Cabang</label>
                    <input type="text" class="form-control @error('cabang') is-invalid @enderror" id="cabang" name="cabang" value="{{ old('cabang') }}" required>
                    @error('cabang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
