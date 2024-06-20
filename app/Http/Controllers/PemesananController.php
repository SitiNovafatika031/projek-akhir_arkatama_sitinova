<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PemesananProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\DataTables\PemesananDataTable;

class PemesananController extends Controller
{
    public function index(PemesananDataTable $dataTable)
    {
        return $dataTable->render('admin.pemesanan.index');
    }

    public function create()
    {
        $produk = Produk::all();
        return view('admin.pemesanan.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ongkir_id' => 'required|integer',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'no_telp' => 'required|string|max:15',
            'status_bayar' => 'required|string|max:50',
            'produk.*.id' => 'required|integer|exists:produk,id',
            'produk.*.harga' => 'required|numeric',
            'produk.*.jumlah' => 'required|integer',
        ]);

        $pemesanan = Pemesanan::create($request->only('nama_penerima', 'alamat', 'ongkir_id', 'kota', 'kode_pos', 'no_telp', 'status_bayar'));

        foreach ($request->produk as $item) {
            PemesananProduk::create([
                'pemesanan_id' => $pemesanan->id,
                'produk_id' => $item['id'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
            ]);

            $produk = Produk::find($item['id']);
            $produk->stok -= $item['jumlah'];
            $produk->save();
        }

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::with('pemesananProduks')->findOrFail($id);
        $produk = Produk::all();
        return view('admin.pemesanan.edit', compact('pemesanan', 'produk'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ongkir_id' => 'required|integer',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'no_telp' => 'required|string|max:15',
            'status_bayar' => 'required|string|max:50',
            'produk.*.id' => 'required|integer|exists:produk,id',
            'produk.*.harga' => 'required|numeric',
            'produk.*.jumlah' => 'required|integer',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->only('nama_penerima', 'alamat', 'ongkir_id', 'kota', 'kode_pos', 'no_telp', 'status_bayar'));

        PemesananProduk::where('pemesanan_id', $id)->delete();

        foreach ($request->produk as $item) {
            PemesananProduk::create([
                'pemesanan_id' => $pemesanan->id,
                'produk_id' => $item['id'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
            ]);

            $produk = Produk::find($item['id']);
            $produk->stok -= $item['jumlah'];
            $produk->save();
        }

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil diperbarui.');
    }
}