@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Leave Request Management') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Tabel Pengajuan Cuti -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <button id="btnTambahData" class="btn btn-primary mb-4">Ajukan Cuti</button>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cutis as $cuti)
                                    <tr>
                                        <td>{{ $cuti->id }}</td>
                                        <td>{{ $cuti->karyawan->name }}</td>
                                        <td>{{ $cuti->tanggal_mulai }}</td>
                                        <td>{{ $cuti->tanggal_akhir }}</td>
                                        <td>{{ $cuti->alasan }}</td>
                                        <td>{{ $cuti->status }}</td>
                                        {{-- <td>
                                            <a href="{{ route('pengajuan-cuti.edit', $cuti->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('pengajuan-cuti.destroy', $cuti->id) }}" method="POST" style="display: inline;">
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
            <!-- End Tabel Pengajuan Cuti -->

            <!-- Form Ajukan/Edit Cuti -->
            <div class="card shadow mb-4" id="formTambahData" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">Form Ajukan/Edit Cuti</h5>
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
            </div>
            <!-- End Form Ajukan/Edit Cuti -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle form visibility when button is clicked
            $('#btnTambahData').click(function() {
                $('#formTambahData').toggle('medium');
                $(this).text($(this).text() === 'Ajukan Cuti' ? 'Tutup Form' : 'Ajukan Cuti');
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
