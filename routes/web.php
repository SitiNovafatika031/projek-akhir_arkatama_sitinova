<?php

use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranPenggunaController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

Route::get('/', [SliderController::class, 'showSliders'])->name('index');
Auth::routes();

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/', [SliderController::class, 'showSliders'])->name('index');
    Route::get('/product/{id}', [ProdukController::class, 'show'])->name('pengguna.produk.detail');
    Route::get('cart', [CartController::class, 'index'])->name('pengguna.cart.index');
    Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout'); 
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order-success', [PembayaranPenggunaController::class, 'create'])->name('ordersuccess');
    Route::get('/pembayaran/create', [PembayaranPenggunaController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranPenggunaController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/success', [PembayaranPenggunaController::class, 'success'])->name('pembayaran.success');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/admin/produk/store', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/admin/produk/{id}/update', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/admin/produk/{id}/delete', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
    Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.slider.index');
    Route::get('/admin/sliders/create', [SliderController::class, 'create'])->name('admin.slider.create');
    Route::post('/admin/sliders', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::get('/admin/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::put('/admin/sliders/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('/admin/sliders/{id}/delete', [SliderController::class, 'destroy'])->name('admin.slider.destroy');
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/{kategori}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy'); 
    Route::get('/admin/produk/beliproduk', [ProdukController::class, 'beliprodukIndex'])->name('admin.produk.beliproduk.index');
    Route::get('/admin/produk/beliproduk/{id}', [ProdukController::class, 'beliprodukDetail'])->name('admin.produk.beliproduk.detail');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin.users/{id}/delete', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan.index');
    Route::get('/admin/pemesanan/create', [PemesananController::class, 'create'])->name('admin.pemesanan.create');
    Route::post('/admin/pemesanan', [PemesananController::class, 'store'])->name('admin.pemesanan.store');
    Route::get('/admin/pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('admin.pemesanan.edit');
    Route::put('/admin/pemesanan/{id}', [PemesananController::class, 'update'])->name('admin.pemesanan.update');
    Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::get('/admin/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
    Route::post('/admin/pembayaran/store', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
    Route::get('/admin/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('admin.pembayaran.edit');
    Route::put('/admin/pembayaran/{id}/update', [PembayaranController::class, 'update'])->name('admin.pembayaran.update');
    Route::get('/admin/pembayaran/{id}/delete/confirmation', [PembayaranController::class, 'showDeleteConfirmation'])->name('admin.pembayaran.delete');
    Route::delete('/admin/pembayaran/{id}/delete', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');
});