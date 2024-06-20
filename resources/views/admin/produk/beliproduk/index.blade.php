@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.partials.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="row">
                @foreach($produks as $produk)
                <div class="col-xl-2 col-lg-2 col-6">
                    <div class="product-box">
                        <div class="img-wrapper">
                            <a href="{{ route('admin.produk.beliproduk.detail', $produk->id) }}">
                                <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-100 bg-img blur-up lazyload" alt="{{ $produk->nama }}">
                            </a>
                            <span class="background-text">{{ $produk->kategori }}</span>
                            <div class="label-block">
                                <span class="label label-theme">30% Off</span>
                            </div>
                            <div class="cart-wrap">
                                <ul>
                                    <li>
                                        <a href="{{ route('admin.produk.beliproduk.detail', $produk->id) }}" class="view-icon">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-style-3 product-style-chair">
                            <div class="product-title d-block mb-0">
                                <a href="{{ route('admin.produk.beliproduk.detail', $produk->id) }}" class="font-default">
                                    <h5>{{ $produk->nama }}</h5>
                                </a>
                                <p class="font-light mb-sm-2 mb-0">{{ $produk->subkategori }}</p>
                                <div class="r-price">
                                    <div class="theme-color">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                </div>
                                <ul class="rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        <li>
                                            <img src="{{ asset('icons/star-solid.svg') }}" class="{{ $i < $produk->rating ? 'theme-color' : '' }}" alt="Star Icon">
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
@endpush