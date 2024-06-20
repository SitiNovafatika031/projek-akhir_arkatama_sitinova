<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <style>
        .product-detail-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .product-detail-card img {
            width: 100%;
            max-height: 400px; 
            object-fit: contain; 
            border-bottom: 1px solid #ddd;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
        }
        .quantity-controls button {
            margin: 0 5px;
        }
        .subtotal {
            font-size: 1.2rem;
            font-weight: bold;
            color: #FF9800;
            margin-top: 10px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #FF9800">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('storage/gambar/logo3.png') }}" alt="Logo" width="100" height="60" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        @auth
                        <li class="nav-item cart-menu">
                            <a class="nav-link" href="{{ route('pengguna.cart.index') }}">
                                <img src="{{ asset('icons/cart-shopping-solid.svg') }}" alt="Cart Icon" style="width: 20px; height: 20px;">
                                <span class="cart-count">{{ \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <img src="{{ asset('icons/arrow-right-from-bracket-solid.svg') }}" alt="Logout Icon" style="width: 20px; height: 20px;">
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Tentang Kami</h5>
                    <p>Selamat datang di Bakul Gombal, destinasi utama Anda untuk semua kebutuhan fashion pria. Kami menyediakan berbagai macam pakaian berkualitas tinggi, mulai dari kaos, kemeja, hingga jaket dan aksesoris. Tujuan kami adalah memberikan pengalaman belanja yang menyenangkan dan memuaskan, dengan produk-produk yang selalu mengikuti tren terbaru.</p>
                </div>
                <div class="col-md-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('index') }}"class="text-white">Beranda</a></li>
                        <li><a href="#" class="text-white">Shop</a></li>
                        <li><a href="#" class="text-white">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Email: bakulgombal@gmail.com</a></li>
                        <li><a href="#" class="text-white">Ponsel: +623 456 7890</a></li>
                        <li><a href="#" class="text-white">Alamat: Dusun Tinggang, Kec.Ngraho, Kab.Bojonegoro, Jawa Timur 62165</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-3">
                &copy; {{ date('Y') }} Bakul Gombal. All Rights Reserved.
            </div>
        </div>
    </footer>
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    @stack('scripts')
</body>