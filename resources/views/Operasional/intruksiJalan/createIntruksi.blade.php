@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create Instruksi Jalan
            </div>
            <div class="card-body">
                <form action="{{ route('instruksi_jalan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="order_id">No Order</label>
                        <select class="form-control @error('order_id') is-invalid @enderror" id="order_id" name="order_id"
                            required>
                            <option value="">Pilih No Order</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->formattedOrder() }}</option>
                            @endforeach
                        </select>
                        @error('order_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Driver</label>
                        <select class="form-control @error('driver_id') is-invalid @enderror" id="driver_id"
                            name="driver_id" required>
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
                        <select class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol"
                            required>
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
                        <input type="date" class="form-control @error('tanggal_jalan') is-invalid @enderror"
                            id="tanggal_jalan" name="tanggal_jalan" value="{{ old('tanggal_jalan') }}" required>
                        @error('tanggal_jalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_stuffing">Tanggal Stuffing (Muat)</label>
                        <input type="date" class="form-control @error('tanggal_stuffing') is-invalid @enderror"
                            id="tanggal_stuffing" name="tanggal_stuffing" value="{{ old('tanggal_stuffing') }}">
                        @error('tanggal_stuffing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_stripping">Tanggal Stripping (Bongkar)</label>
                        <input type="date" class="form-control @error('tanggal_stripping') is-invalid @enderror"
                            id="tanggal_stripping" name="tanggal_stripping" value="{{ old('tanggal_stripping') }}">
                        @error('tanggal_stripping')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estimasi_waktu_ke_tujuan">Estimasi Jarak</label>
                        <div class="input-group mb-2">
                            <input type="text"
                                class="form-control @error('estimasi_waktu_ke_tujuan') is-invalid @enderror"
                                id="estimasi_waktu_ke_tujuan" name="estimasi_waktu_ke_tujuan"
                                value="{{ old('estimasi_waktu_ke_tujuan') }}" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">KM</div>
                            </div>
                            @error('estimasi_waktu_ke_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                <div class="form-group">
                    <label for="estimasi_jarak">Estimasi Jarak</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control @error('estimasi_jarak') is-invalid @enderror"
                            id="estimasi_jarak" name="estimasi_jarak" value="{{ old('estimasi_jarak') }}" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">KM</div>
                        </div>
                        @error('estimasi_jarak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
