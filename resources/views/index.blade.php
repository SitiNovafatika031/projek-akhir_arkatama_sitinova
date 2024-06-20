<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakul Gombal</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .category-card {
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .category-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .category-card img {
        width: 100%;
        max-height: 100px;
        object-fit: contain; 
        border-radius: 8px;
    }
    .product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .product-card img {
        width: 100%;
        max-height: 200px; 
        object-fit: contain; 
        border-bottom: 1px solid #ddd;
    }
    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .product-card .card-body {
        text-align: center;
    }
    .product-card .card-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    .product-card .card-text {
        font-size: 1rem;
        color: #FF9800;
    }
</style>

</head>
<body>
    <main>
    <header>
        <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #FF9800">
            <div class="container">
                <img src="{{ asset('storage/gambar/logo3.png') }}" alt="Logo" width="100" height="60" class="d-inline-block align-text-top">
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
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </div>
            </div>
        </nav>
    </header>
        <header>
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($sliders as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="5000">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>
    <header>
    <div class="container my-4">
    <h3 class="text-center mb-4">Kategori</h3>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach($kategori as $kategori)
            <div class="col">
                <div class="category-card">
                <img src="{{ asset('storage/' . $kategori->gambar) }}" alt="Kategori Gambar" class="img-fluid">
                    <h5 class="card-title">{{ $kategori->nama }}</h5>
                </div>
            </div>
        @endforeach
    </div>
    </div>
    </header>
    <header>
    <div class="container my-4">
        <h3 class="text-center mb-4">Produk Kami</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($produks as $produk)
                <div class="col">
                    <div class="product-card" data-id="{{ $produk->id }}">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama }}</h5>
                            <p class="card-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </header>
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
                        <li><a href="{{ route('index') }}" class="text-white">Beranda</a></li>
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
    <script>
        document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('dblclick', function() {
            let id = this.getAttribute('data-id');
            goToDetailPage(id);
            });
        });
        function goToDetailPage(id) {
            window.location.href = `/product/${id}`;
        }
    </script>
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
</html>