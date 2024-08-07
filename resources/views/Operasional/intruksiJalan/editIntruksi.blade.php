@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Intruksi Jalan
            </div>
            <div class="card-body">
                <form action="{{ route('instruksi_jalan.update', $intruksiJalan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="order_id">No Order</label>
                        <select class="form-control @error('order_id') is-invalid @enderror" id="order_id" name="order_id" required>
                            <option value="">Pilih No Order</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}" {{ $intruksiJalan->order_id == $order->id ? 'selected' : '' }}>{{ $order->formattedOrder() }}</option>
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
                                <option value="{{ $user->id }}" {{ $intruksiJalan->driver_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
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
                                <option value="{{ $user->id }}" {{ $intruksiJalan->kenek_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
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
                                <option value="{{ $kendaraan->nopol }}" {{ $intruksiJalan->nopol == $kendaraan->nopol ? 'selected' : '' }}>{{ $kendaraan->nopol }}</option>
                            @endforeach
                        </select>
                        @error('nopol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_jalan">Tanggal Jalan</label>
                        <input type="date" class="form-control @error('tanggal_jalan') is-invalid @enderror" id="tanggal_jalan" name="tanggal_jalan" value="{{ $intruksiJalan->tanggal_jalan }}" required>
                        @error('tanggal_jalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_stuffing">Tanggal Stuffing (Muat)</label>
                        <input type="date" class="form-control @error('tanggal_stuffing') is-invalid @enderror" id="tanggal_stuffing" name="tanggal_stuffing" value="{{ $intruksiJalan->tanggal_stuffing }}">
                        @error('tanggal_stuffing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_stripping">Tanggal Stripping (Bongkar)</label>
                        <input type="date" class="form-control @error('tanggal_stripping') is-invalid @enderror" id="tanggal_stripping" name="tanggal_stripping" value="{{ $intruksiJalan->tanggal_stripping }}">
                        @error('tanggal_stripping')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estimasi_waktu_ke_tujuan">Estimasi Waktu Ke Tujuan</label>
                        <input type="text" class="form-control @error('estimasi_waktu_ke_tujuan') is-invalid @enderror" id="estimasi_waktu_ke_tujuan" name="estimasi_waktu_ke_tujuan" value="{{ $intruksiJalan->estimasi_waktu_ke_tujuan }}" required>
                        @error('estimasi_waktu_ke_tujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estimasi_jarak">Estimasi Jarak</label>
                        <input type="text" class="form-control @error('estimasi_jarak') is-invalid @enderror" id="estimasi_jarak" name="estimasi_jarak" value="{{ $intruksiJalan->estimasi_jarak }}" required>
                        @error('estimasi_jarak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
