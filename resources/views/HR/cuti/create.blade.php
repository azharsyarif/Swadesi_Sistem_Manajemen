@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Create Rekanan</h1>
    <form method="POST" action="{{ route('pengajuan-cuti.store') }}">
        @csrf

        <div class="form-group">
            <label for="tanggal_mulai">{{ __('Tanggal Mulai') }}</label>
            <input id="tanggal_mulai" type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required autocomplete="tanggal_mulai" autofocus>

            @error('tanggal_mulai')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_akhir">{{ __('Tanggal Akhir') }}</label>
            <input id="tanggal_akhir" type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required autocomplete="tanggal_akhir">

            @error('tanggal_akhir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="alasan">{{ __('Alasan') }}</label>
            <textarea id="alasan" class="form-control @error('alasan') is-invalid @enderror" name="alasan" rows="4" required autocomplete="alasan">{{ old('alasan') }}</textarea>

            @error('alasan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Ajukan Cuti') }}
        </button>
    </form>
</div>
@endsection
