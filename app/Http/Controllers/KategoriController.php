<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('admin.kategori.index');
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $input['gambar'] = $request->file('gambar')->store('kategori', 'public');
        }

        Kategori::create($input);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kategori = Kategori::findOrFail($id);
        $input = $request->only('nama');

        if ($request->hasFile('gambar')) {
            if ($kategori->gambar) {
                Storage::disk('public')->delete($kategori->gambar);
            }
            $input['gambar'] = $request->file('gambar')->store('kategori', 'public');
        }

        $kategori->update($input);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        if ($kategori->gambar) {
            Storage::disk('public')->delete($kategori->gambar);
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}