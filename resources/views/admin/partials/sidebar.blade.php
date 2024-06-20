<div class="col-md-3 col-lg-2 d-md-block bg-light sidebar shadow-sm">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard.index') }}">
                    <img src="{{ asset('icons/house-chimney-solid.svg') }}" alt="Home Icon" class="icon" style="width: 20px; height: 15px;"> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#produkSubmenu" data-toggle="collapse" aria-expanded="false">
                    <img src="{{ asset('icons/file-lines-solid.svg') }}" alt="Produk Icon" class="icon" style="width: 20px; height: 15px;" > Produk
                </a>
                <ul class="collapse list-unstyled" id="produkSubmenu">
                    <li class="nav-item submenu-item">
                        <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                            <img src="{{ asset('icons/folder-solid.svg') }}" alt="Kategori Produk Icon" class="icon" style="width: 20px; height: 15px;"> Kategori Produk
                        </a>
                    </li>
                    <li class="nav-item submenu-item">
                        <a class="nav-link" href="{{ route('admin.produk.beliproduk.index') }}">
                            <img src="{{ asset('icons/basket-shopping-solid.svg') }}" alt="Produk Icon" class="icon" style="width: 20px; height: 15px;"> Produk
                        </a>
                    </li>
                    <li class="nav-item submenu-item">
                        <a class="nav-link" href="{{ route('admin.produk.index') }}">
                            <img src="{{ asset('icons/gear-solid.svg') }}" alt="Kelola Produk Icon" class="icon" style="width: 20px; height: 15px;"> Kelola Produk
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pemesanan.index') }}">
                    <img src="{{ asset('icons/cart-shopping-solid.svg') }}" alt="Pemesanan Icon" class="icon" style="width: 20px; height: 15px;"> Pemesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pembayaran.index') }}">
                    <img src="{{ asset('icons/money-bill-1-wave-solid.svg') }}" alt="Pembayaran Icon" class="icon" style="width: 20px; height: 15px;"> Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <img src="{{ asset('icons/user-solid.svg') }}" alt="User Management Icon" class="icon" style="width: 20px; height: 15px;"> User Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.slider.index') }}">
                    <img src="{{ asset('icons/sliders-solid.svg') }}" alt="Slider Icon" class="icon" style="width: 20px; height: 15px;"> Slider
                </a>
            </li>
        </ul>
    </div>
</div>