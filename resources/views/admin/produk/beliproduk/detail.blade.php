@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="detail-product-card">
                <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                <div class="detail-product-body">
                    <h5 class="detail-product-title">{{ $produk->nama }}</h5>
                    <p class="detail-product-text detail-product-price">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="detail-product-text">Keterangan: {{ $produk->keterangan }}</p>
                    <p class="detail-product-text">Stok: {{ $produk->stok }}</p>
                    <a href="{{ route('admin.produk.beliproduk.index') }}" class="detail-product-back-btn">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection