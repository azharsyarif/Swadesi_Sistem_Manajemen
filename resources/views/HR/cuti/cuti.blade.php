@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Leave Request Management') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="/create-cuti" class="btn btn-primary mb-4">Ajukan Cuti</a>
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'pending' ? 'active' : '' }}" href="{{ route('pengajuan.cuti.index', ['tab' => 'pending']) }}">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'history' ? 'active' : '' }}" href="{{ route('pengajuan.cuti.index', ['tab' => 'history']) }}">History</a>
                        </li>
                    </ul>
                    <div class="d-flex table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Karyawan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Sisa Cuti</th>
                                    <th>Dibuat Pada</th>
                                    <th>Approved/Rejected By</th>
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
                                        <td>
                                            @if($cuti->status == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($cuti->status == 'Diterima')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($cuti->status == 'Ditolak')
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{ $cuti->karyawan->jatah_cuti }}</td>
                                        <td>{{ $cuti->created_at->format('d-m-Y H:i') }}</td>
                                        <td>{{ $cuti->approved_by ? $cuti->approvedBy->name : '-' }}</td>
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
