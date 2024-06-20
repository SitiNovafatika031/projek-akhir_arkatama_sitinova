<?php
namespace App\Http\Controllers;

use App\Models\Ongkir;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranPenggunaController extends Controller
{
    public function create()
    {
        $pemesanan = Pemesanan::latest()->first();

        if (!$pemesanan) {
            return redirect()->route('ordersuccess')->with('error', 'Tidak ada pemesanan yang ditemukan.');
        }

        $ongkir = Ongkir::find($pemesanan->ongkir_id);
        $biayaOngkir = $ongkir ? $ongkir->biaya : 0;

        $jumlahPembayaran = $pemesanan->subtotal + $biayaOngkir;
        return view('pengguna.pemesanan.ordersuccess', compact('pemesanan', 'jumlahPembayaran'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'pemesanan_id' => 'required|exists:pemesanan,id',
        'jumlah_transfer' => 'required|numeric',
        'nama_bank' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'struk_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'nama_pelanggan' => 'required|string',
    ]);

    $pembayaran = new Pembayaran();
    $pembayaran->pemesanan_id = $request->pemesanan_id;
    $pembayaran->jumlah_transfer = $request->jumlah_transfer;
    $pembayaran->nama_bank = $request->nama_bank;
    $pembayaran->tanggal = $request->tanggal;
    $pembayaran->nama_pelanggan = $request->nama_pelanggan;

    if ($request->hasFile('struk_pembayaran')) {
        $image = $request->file('struk_pembayaran');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $filePath = $image->storeAs('images', $fileName, 'public');
        $pembayaran->struk_pembayaran = $filePath;
    }

    $pembayaran->save();

    return redirect()->route('pembayaran.success')->with('success', 'Anda berhasil melakukan pembayaran, mohon tunggu konfirmasi dari seller');
    }

    public function success()
    {
    return view('pengguna.pemesanan.pembayaran-success');
    }

}