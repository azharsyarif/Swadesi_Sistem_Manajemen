@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengajuan Izin Sakit') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Karyawan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Alasan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinSakits as $izinsakit)
                            <tr>
                                <td>{{ $izinsakit->id }}</td>
                                <td>{{ $izinsakit->karyawan->name }}</td>
                                <td>{{ $izinsakit->tanggal_mulai }}</td>
                                <td>{{ $izinsakit->tanggal_akhir }}</td>
                                <td>{{ $izinsakit->alasan }}</td>
                                <td>{{ $izinsakit->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">Form Pengajuan Izin Sakit</h5>
                    <form action="{{ route('pengajuan-izin-sakit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required>
                            @error('tanggal_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" rows="3" required>{{ old('alasan') }}</textarea>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bukti_dokumen">Bukti Dokumen (opsional)</label>
                            <input type="file" class="form-control-file @error('bukti_dokumen') is-invalid @enderror" id="bukti_dokumen" name="bukti_dokumen">
                            @error('bukti_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Ajukan Izin Sakit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
