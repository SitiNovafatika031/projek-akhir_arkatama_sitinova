<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Produk::count();
        $totalCustomers = User::where('type', 'user')->count();
        $totalOrders = Pemesanan::count();

        return view('admin.dashboard.index', [
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders
        ]);
    }
}