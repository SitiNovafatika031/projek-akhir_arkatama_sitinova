@extends('layouts.app')

@section('title', 'Keranjang Anda')

@section('content')
<div class="container">
    <h1 class="my-4">Keranjang Anda</h1>

    <table id="cart-table" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    <div class="cart-total my-4">
        Total: <span id="total"></span>
    </div>

    <button class="btn btn-success" id="checkout-btn">Proceed to Checkout</button>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cart-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pengguna.cart.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_name', name: 'product_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'subtotal', name: 'subtotal' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api(), data;

                total = api.column(3, { page: 'current' }).data().reduce(function (a, b) {
                    return parseInt(a) + parseInt(b.replace(/\D/g,''));
                }, 0);

                $('#total').html('Rp ' + total.toLocaleString('id-ID'));
            }
        });
    });
</script>
@endpush