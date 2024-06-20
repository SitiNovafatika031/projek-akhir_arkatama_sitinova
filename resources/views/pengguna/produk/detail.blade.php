@extends('layouts.apppengguna')

@section('title', 'Detail Produk - ' . $product->nama)

@section('content')
<main class="container">
    <div class="product-detail-card" data-price="{{ $product->harga }}" data-stok="{{ $product->stok }}">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->nama }}</h2>
                <p class="text-muted">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p>{{ $product->keterangan }}</p>
                <p>Stok: {{ $product->stok }}</p>

                <div class="quantity-controls my-3">
                    <button class="btn btn-outline-secondary" id="decrease-qty">-</button>
                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->stok }}" class="form-control" style="width: 60px;">
                    <button class="btn btn-outline-secondary" id="increase-qty">+</button>
                </div>

                <div class="form-group">
                    <label for="note">Catatan:</label>
                    <textarea id="note" class="form-control" rows="3"></textarea>
                </div>

                <p class="subtotal">Subtotal: Rp <span id="subtotal">{{ number_format($product->harga, 0, ',', '.') }}</span></p>

                <div class="d-flex">
                    <button class="btn btn-warning me-2" id="add-to-cart">Tambah ke Keranjang</button>
                    <button class="btn btn-success" id="buy-now">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Checkout -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('checkout') }}" id="checkout-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="produk_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                        <input type="hidden" name="subtotal" id="hidden-subtotal" value="{{ $product->harga }}">
                        <input type="hidden" name="note" id="hidden-note" value="">

                        <div class="mb-3">
                            <label for="nama_penerima" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="ongkir_id" class="form-label">Ongkir</label>
                            <select class="form-control" id="ongkir_id" name="ongkir_id" required>
                                @foreach($ongkir as $ongkir)
                                    <option value="{{ $ongkir->id }}">{{ $ongkir->dari }} - {{ $ongkir->tujuan }}: Rp {{ number_format($ongkir->biaya, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" required>
                        </div>
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productDetailCard = document.querySelector('.product-detail-card');
    const productPrice = parseInt(productDetailCard.getAttribute('data-price'));
    const productStok = parseInt(productDetailCard.getAttribute('data-stok'));
    const decreaseQtyButton = document.getElementById('decrease-qty');
    const increaseQtyButton = document.getElementById('increase-qty');
    const quantityInput = document.getElementById('quantity');
    const subtotalElement = document.getElementById('subtotal');

    function updateSubtotal() {
        const quantity = parseInt(quantityInput.value);
        const subtotal = quantity * productPrice;
        subtotalElement.textContent = new Intl.NumberFormat('id-ID').format(subtotal);
        document.getElementById('hidden-subtotal').value = subtotal;
    }

    decreaseQtyButton.addEventListener('click', function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
            updateSubtotal();
        }
    });

    increaseQtyButton.addEventListener('click', function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity < productStok) {
            quantity++;
            quantityInput.value = quantity;
            updateSubtotal();
        }
    });

    quantityInput.addEventListener('change', function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity < 1) {
            quantityInput.value = 1;
        } else if (quantity > productStok) {
            quantityInput.value = productStok;
        }
        updateSubtotal();
    });

    document.getElementById('add-to-cart').addEventListener('click', function() {
        const quantity = quantityInput.value;
        const note = document.getElementById('note').value;

        fetch("{{ route('cart.add', $product->id) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: '{{ $product->id }}',
                quantity: quantity,
                note: note,
                subtotal: quantity * productPrice
            })
        })
        .then(response => {
            if (response.ok) {
                alert('Produk ditambahkan ke keranjang!');
                window.location.href = "{{ route('pengguna.cart.index') }}";
            } else {
                alert('Gagal menambahkan produk ke keranjang.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.getElementById('buy-now').addEventListener('click', function() {
        const quantity = quantityInput.value;
        const note = document.getElementById('note').value;

        document.getElementById('hidden-quantity').value = quantity;
        document.getElementById('hidden-note').value = note;
        const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    });
});
</script>
@endsection