<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\PemesananProduk;
use App\Models\Ongkir;

class OrderController extends Controller
{
    public function checkout(Request $request)
{
    $validatedData = $request->validate([
        'produk_id' => 'required|exists:produk,id',
        'quantity' => 'required|integer|min:1',
        'subtotal' => 'required|numeric|min:0',
        'note' => 'nullable|string',
        'nama_penerima' => 'required|string',
        'alamat' => 'required|string',
        'kota' => 'required|string',
        'kode_pos' => 'required|string',
        'no_telp' => 'required|string',
        'ongkir_id' => 'required|exists:ongkir,id',
    ]);

    $pemesanan = Pemesanan::create([
        'nama_penerima' => $validatedData['nama_penerima'],  
        'alamat' => $validatedData['alamat'],      
        'ongkir_id' => $validatedData['ongkir_id'], 
        'kota' => $validatedData['kota'],  
        'kode_pos' => $validatedData['kode_pos'], 
        'no_telp' => $validatedData['no_telp'], 
        'subtotal' => $validatedData['subtotal'],
        'status_bayar' => 'pending',
    ]);

    PemesananProduk::create([
        'pemesanan_id' => $pemesanan->id,
        'produk_id' => $validatedData['produk_id'],
        'harga' => $validatedData['subtotal'] / $validatedData['quantity'],
        'jumlah' => $validatedData['quantity'],
    ]);

    return redirect()->route('ordersuccess')->with('success', 'Pemesanan berhasil dilakukan!');
}
}
