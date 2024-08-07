@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create PO Customer
            </div>
            <div class="card-body">
                <form action="{{ route('marketing.po.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_pt">Nama PT</label>
                        <select name="nama_pt" id="nama_pt" class="form-control" required>
                            <option value="">Select PT</option>
                            @foreach ($rekanans as $rekanan)
                                <option value="{{ $rekanan->id }}">{{ $rekanan->nama_pt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="PICCustomer">PIC Customer</label>
                        <select name="PICCustomer" id="PICCustomer" class="form-control" required>
                            <option value="">Select PIC</option>
                            @foreach ($pics as $pic)
                                <option value="{{ $pic->id }}">{{ $pic->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
