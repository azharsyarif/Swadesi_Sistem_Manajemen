@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h2>Create Invoice</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="no_po_customer">PO Customer Number</label>
            <select name="no_po_customer" id="no_po_customer" class="form-control">
                <option value="">Select PO Customer</option>
                @foreach($po_customers as $po_customer)
                    <option value="{{ $po_customer->id }}">{{ $po_customer->no_po }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>No Order</label>
            <div class="form-group" id="order_ids_container">
                <!-- Orders will be loaded here -->
            </div>
        </div>
        <div class="form-group">
            <label for="term_agreement">Term Agreement</label>
            <div class="input-group mb-2">
                <input type="text" name="term_agreement" id="term_agreement" class="form-control" disabled>
                <div class="input-group-prepend">
                    <div class="input-group-text">Hari</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="tanggal_kirim_inv">Tanggal Pengiriman Invoice</label>
            <input type="date" name="tanggal_kirim_inv" id="tanggal_kirim_inv" class="form-control">
        </div>
        <div class="form-group">
            <label for="biaya_operasional">Biaya Operasional</label>
            <input type="text" name="biaya_operasional" id="biaya_operasional" class="form-control">
        </div>
        <div class="form-group">
            <label for="revenue">Revenue</label>
            <input type="text" name="revenue" id="revenue" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="net_income">Net Income</label>
            <input type="text" name="net_income" id="net_income" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#no_po_customer').change(function() {
            var poCustomerId = $(this).val();

            if (!poCustomerId) {
                $('#order_ids_container').empty(); // Clear if no PO selected
                $('#term_agreement').val(''); // Clear term agreement
                $('#revenue').val(''); // Clear revenue
                updateNetIncome(); // Update net income
                return;
            }

            $.ajax({
                url: '{{ route('api.get-orders') }}',
                type: 'GET',
                data: { po_customer_id: poCustomerId },
                success: function(response) {
                    console.log('Orders Response:', response); // Debugging line
                    $('#order_ids_container').empty();
                    if (response.orders.length > 0) {
                        $.each(response.orders, function(key, order) {
                            console.log('Order:', order); // Debugging line
                            var checkbox = '<div class="form-check">' +
                                '<input class="form-check-input order-checkbox" type="checkbox" value="' + order.id + '" data-harga-deal="' + order.harga_deal + '" name="order_ids[]">' +
                                '<label class="form-check-label">' + order.no_order + ' - ' + order.tujuan + '</label>' +
                                '</div>';
                            $('#order_ids_container').append(checkbox);
                        });
                        $('#term_agreement').val(response.term_agreement); // Set term agreement
                    } else {
                        $('#order_ids_container').append('<p>No orders found for this PO Customer.</p>');
                        $('#term_agreement').val(''); // Clear term agreement
                    }
                    updateNetIncome(); // Update net income
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', xhr.responseText); // Debugging line
                }
            });
        });

        $(document).on('change', '.order-checkbox', function() {
            var totalRevenue = 0;
            $('.order-checkbox:checked').each(function() {
                var hargaDeal = $(this).data('harga-deal');
                console.log('Checked Order:', hargaDeal); // Debugging line
                if (hargaDeal) {
                    // Replace comma with dot if necessary and convert to float
                    hargaDeal = parseFloat(hargaDeal.toString().replace(',', '.'));
                    if (!isNaN(hargaDeal)) {
                        totalRevenue += hargaDeal;
                    }
                }
            });
            console.log('Total Revenue:', totalRevenue); // Debugging line
            $('#revenue').val(formatRupiah(totalRevenue.toFixed(2)));
            updateNetIncome(); // Update net income
        });

        $('#biaya_operasional').on('input', function() {
            $(this).val(formatRupiah($(this).val()));
            updateNetIncome();
        });

        function updateNetIncome() {
            var revenue = parseFloat($('#revenue').val().replace(/[^0-9.-]+/g,"")) || 0;
            var operationalCost = parseFloat($('#biaya_operasional').val().replace(/[^0-9.-]+/g,"")) || 0;
            var netIncome = revenue - operationalCost;
            $('#net_income').val(formatRupiah(netIncome.toFixed(2)));
        }

        function formatRupiah(value, prefix = 'Rp ') {
            var number_string = value.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }

    });
</script>
