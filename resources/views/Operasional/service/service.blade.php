@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Service Kendaraan') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card-body">
                <a href="/op-service-kendaraan/create" class="btn btn-primary mb-4">Tambah Data</a>

                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>No Service</th>
                                <th>Nomor Polisi</th>
                                <th>Driver</th>
                                <th>Total Service</th>
                                <th>Upload Dokumen</th>
                                <th>Dibuat pada Tanggal</th>
                                <th>Di update pada tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->no_service }}</td>
                                    <td>{{ $service->kendaraan->nopol }}</td>
                                    <td>{{ $service->driver->name }}</td>
                                    <td>{{ $service->total_service }}</td>
                                    <td>
                                        @if($service->upload_dokumen)
                                            <a href="{{ asset('storage/' . $service->upload_dokumen) }}" target="_blank">Lihat Dokumen</a>
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </td>
                                    <td>{{ $service->created_at->format('d-m-Y H:i:s')}}</td>
                                    <td>{{ $service->updated_at->format('d-m-Y H:i:s')}}</td>
                                    <td>
                                        <td>
                                            <a href="{{ route('service.viewEdit', $service->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            {{-- <form action="{{ route('kendaraan.delete', $kendaraan->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form> --}}
                                        </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Tambah/Edit Service Kendaraan -->
            <div class="card shadow mb-4" id="formTambahData" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah/Edit Service Kendaraan</h5>
                    
                </div>
            </div>
            <!-- End Form Tambah/Edit Service Kendaraan -->
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

            // Add dynamic item condition fields
            var nextItemNumber = 1;
            $('#btnTambahItem').click(function() {
                var newItem = `
                <div class="row mb-2" id="item_${nextItemNumber}">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="item_name[]" placeholder="Nama Komponen" required>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="item_value[]" required onchange="showDescription(this)">
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="desc[]" placeholder="Deskripsi" style="display:none;">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusItem(${nextItemNumber})">X</button>
                    </div>
                </div>
            `;
                $('#item_conditions').append(newItem);
                nextItemNumber++;
            });

            // Function to remove item condition field
            window.hapusItem = function(id) {
                $('#item_' + id).remove();
            };

            // Function to show/hide description based on item condition
            window.showDescription = function(select) {
                var descInput = $(select).closest('.row').find('input[name="desc[]"]');
                if (select.value === 'Rusak') {
                    descInput.show();
                } else {
                    descInput.hide();
                }
            };
        });
    </script>
@endsection
