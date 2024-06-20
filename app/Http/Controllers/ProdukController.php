<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\DataTables\ProdukDataTable;
use App\Models\Ongkir;

class ProdukController extends Controller
{
    public function index(ProdukDataTable $dataTable)
    {
        return $dataTable->render('admin.produk.index');
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'required|image',
        ]);

        $path = $request->file('gambar')->store('public/produk');

        Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'sometimes|image',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/produk');
            $data['gambar'] = $path;
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function beliprodukIndex()
    {
        $produks = Produk::all();
        return view('admin.produk.beliproduk.index', compact('produks'));
    }

    public function beliprodukDetail($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.beliproduk.detail', compact('produk'));
    }

    public function show($id)
    {
        $product = Produk::findOrFail($id);
        $ongkir = Ongkir::all();
        return view('pengguna.produk.detail', compact('product', 'ongkir'));
    }

}