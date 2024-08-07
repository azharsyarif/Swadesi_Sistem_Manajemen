@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit PO Customer') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('marketing.po.update', $poCustomer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="no_po">No PO <small>(No Po tidak bisa diperbaiki)</small></label>
                            <input type="text" class="form-control" id="no_po" name="no_po" value="{{ $poCustomer->no_po }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama_pt">Nama PT</label>
                            <select class="form-control" id="nama_pt" name="nama_pt" required>
                                @foreach($rekanans as $rekanan)
                                    <option value="{{ $rekanan->id }}" {{ $poCustomer->nama_pt == $rekanan->id ? 'selected' : '' }}>{{ $rekanan->nama_pt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $poCustomer->alamat }}" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="PICCustomer">PIC Customer</label>
                                <select class="form-control" id="PICCustomer" name="PICCustomer" required>
                                    @foreach($picCustomers as $picCustomer)
                                        <option value="{{ $picCustomer->id }}" {{ $poCustomer->pic_customer_id == $picCustomer->id ? 'selected' : '' }}>{{ $picCustomer->nama }}</option>
                                    @endforeach
                                </select>
                            </div>                                                      
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('marketing.po.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
