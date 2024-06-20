<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\DataTables\PembayaranDataTable;
use App\Models\Pemesanan;

class PembayaranController extends Controller
{
    public function index(PembayaranDataTable $dataTable)
    {
        return $dataTable->render('admin.pembayaran.index');
    }

    public function create()
    {
        $pemesanan = Pemesanan::all();
        return view('admin.pembayaran.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'nama_pelanggan' => 'required|string|max:255',
            'jumlah_transfer' => 'required|numeric',
            'nama_bank' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'struk_pembayaran' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('struk_pembayaran')) {
            $data['struk_pembayaran'] = $request->file('struk_pembayaran')->store('public/struk');
        }

        Pembayaran::create($data);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
    $pembayaran = Pembayaran::findOrFail($id);
    $pemesanan = Pemesanan::all();
    return view('admin.pembayaran.edit', compact('pembayaran', 'pemesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'nama_pelanggan' => 'required|string|max:255',
            'jumlah_transfer' => 'required|numeric',
            'nama_bank' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'struk_pembayaran' => 'sometimes|image',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('struk_pembayaran')) {
            $data['struk_pembayaran'] = $request->file('struk_pembayaran')->store('public/struk');
        }

        $pembayaran->update($data);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function showDeleteConfirmation($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('admin.pembayaran.delete', compact('pembayaran'));
    }

    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}