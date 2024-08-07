@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create Order
            </div>
            <div class="card-body">
                <form action="{{ route('marketing.order.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-4">
                        <div class="card-header">Form Data Order</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="no_po">No PO Customer</label>
                                <select class="form-control @error('no_po') is-invalid @enderror" id="no_po" name="no_po" required>
                                    <option value="">Pilih No PO Customer</option>
                                    @foreach ($pOCustomers as $poCustomer)
                                        <option value="{{ $poCustomer->id }}" data-rekanan-id="{{ $poCustomer->rekanan_id }}" {{ old('no_po') == $poCustomer->id ? 'selected' : '' }}>{{ $poCustomer->no_po }}</option>
                                    @endforeach
                                </select>                                
                                @error('no_po')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="asal">Asal</label>
                                <select class="form-control select2 @error('asal') is-invalid @enderror" id="asal" name="asal" required>
                                    <option value="">Pilih Kota Asal</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['city_id'] }}" {{ old('asal') == $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('asal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <select class="form-control select2 @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['city_id'] }}" {{ old('tujuan') == $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>                            
                            
                            <div class="form-group">
                                <label for="total_km">Total KM</label>
                                <input type="text" class="form-control @error('total_km') is-invalid @enderror" id="total_km" name="total_km" value="{{ old('total_km') }}" required>
                                @error('total_km')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="total_koli">Total Koli</label>
                                <input type="text" class="form-control @error('total_koli') is-invalid @enderror" id="total_koli" name="total_koli" value="{{ old('total_koli') }}" required>
                                @error('total_koli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="total_berat">Total Berat</label>
                                <input type="text" class="form-control @error('total_berat') is-invalid @enderror" id="total_berat" name="total_berat" value="{{ old('total_berat') }}">
                                @error('total_berat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deskripsi_barang">Deskripsi Barang</label>
                                <textarea class="form-control @error('deskripsi_barang') is-invalid @enderror" id="deskripsi_barang" name="deskripsi_barang" rows="3" required>{{ old('deskripsi_barang') }}</textarea>
                                @error('deskripsi_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="term_agrement">Term Agreement</label>
                                <input type="text" class="form-control @error('term_agrement') is-invalid @enderror" id="term_agrement" name="term_agrement" value="{{ old('term_agrement', $term_agreement) }}" readonly>
                                @error('term_agrement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                                
                            </div>

                            <div class="form-group">
                                <label for="layanan">Layanan</label>
                                <select class="form-control @error('layanan') is-invalid @enderror" id="layanan" name="layanan" required>
                                    <option value="">Pilih Layanan</option>
                                    <option value="darat">Darat</option>
                                    <option value="laut">Laut</option>
                                    <option value="udara">Udara</option>
                                    <option value="mobil">Mobil</option>
                                </select>
                                @error('layanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group" id="kendaraan-container" style="display: none;">
                                <label for="kendaraan_id">Kendaraan</label>
                                <select class="form-control @error('kendaraan_id') is-invalid @enderror" id="kendaraan_id" name="kendaraan_id">
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach ($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id }}">{{ $kendaraan->nopol }}</option>
                                    @endforeach
                                </select>
                                @error('kendaraan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <div class="form-group">
                                <label for="harga_deal">Harga Deal</label>
                                <input type="text" class="form-control @error('harga_deal') is-invalid @enderror" id="harga_deal" name="harga_deal" value="{{ old('harga_deal') }}">
                                @error('harga_deal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                                                        
                            <div class="form-group">
                                <label for="total_harga_deal">Total Harga Deal</label>
                                <input type="text" class="form-control @error('total_harga_deal') is-invalid @enderror" 
                                    id="total_harga_deal" 
                                    name="total_harga_deal" 
                                    value="@currency(old('total_harga_deal'))" 
                                    readonly>
                                @error('total_harga_deal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <div class="form-group">
                                <label for="upload_harga_deal">Upload Harga Deal</label>
                                <input type="file" class="form-control @error('upload_harga_deal') is-invalid @enderror" id="upload_harga_deal" name="upload_harga_deal">
                                @error('upload_harga_deal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch cities and populate select options
        function fetchCities() {
        $.ajax({
            url: '/cities',
            type: 'GET',
            success: function(response) {
                var asalSelect = $('#asal');
                var tujuanSelect = $('#tujuan');
                asalSelect.empty();
                tujuanSelect.empty();
                asalSelect.append('<option value="">Pilih Kota Asal</option>');
                tujuanSelect.append('<option value="">Pilih Kota Tujuan</option>');
                $.each(response, function(index, city) {
                    asalSelect.append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                    tujuanSelect.append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    fetchCities();

            $('#no_po').change(function() {
            var selectedOption = $(this).find('option:selected');
            var rekananId = selectedOption.data('rekanan-id');

            // Fetch the term agreement based on the rekananId
            var termAgreement = '';
            @foreach($rekanans as $rekanan)
                if (rekananId == {{ $rekanan->id }}) {
                    termAgreement = "{{ $rekanan->term_agrement }}";
                }
            @endforeach

            $('#term_agrement').val(termAgreement);
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#layanan').change(function() {
            var selectedLayanan = $(this).val();
            if (selectedLayanan == 'mobil') {
                $('#kendaraan-container').show();
            } else {
                $('#kendaraan-container').hide();
                $('#kendaraan_id').val(''); // Clear the selected value if not 'mobil'
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function calculateTotalHargaDeal() {
            var hargaDeal = parseFloat($('#harga_deal').val().replace(/,/g, '')) || 0;
            var totalBerat = parseFloat($('#total_berat').val().replace(/,/g, '')) || 0;
            var totalHargaDeal = hargaDeal * totalBerat;
            $('#total_harga_deal').val(totalHargaDeal.toFixed(2));
        }

        // Event listeners for changes in harga_deal and total_berat
        $('#harga_deal, #total_berat').on('input', function() {
            calculateTotalHargaDeal();
        });

        // Initial calculation on page load
        calculateTotalHargaDeal();
    });
</script>
