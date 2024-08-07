@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Approval Cuti & Izin Sakit') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Karyawan</th>
                                    <th>Jenis</th> <!-- Added column for jenis -->
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->karyawan->name }}</td>
                                        <td>
                                            @if($item instanceof App\Models\PengajuanCuti)
                                                Cuti
                                            @elseif($item instanceof App\Models\PengajuanIzinSakit)
                                                Izin Sakit
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $item->tanggal_mulai }}</td>
                                        <td>{{ $item->tanggal_akhir }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @if($item->status == 'Pending')
                                                <div class="d-flex flex-column flex-md-row">
                                                    @if($item instanceof App\Models\PengajuanCuti)
                                                        <form action="{{ route('cuti.approve', $item->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm mb-2 mb-md-0 mr-md-2">Approve</button>
                                                        </form>
                                                        <form action="{{ route('cuti.reject', $item->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @elseif($item instanceof App\Models\PengajuanIzinSakit)
                                                        <form action="{{ route('izin-sakit.approve', $item->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm mb-2 mb-md-0 mr-md-2">Approve</button>
                                                        </form>
                                                        <form action="{{ route('izin-sakit.reject', $item->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="badge badge-{{ $item->status == 'Diterima' ? 'success' : 'danger' }}">{{ ucfirst($item->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
