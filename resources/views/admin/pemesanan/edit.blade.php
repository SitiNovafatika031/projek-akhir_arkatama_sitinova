@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Pemesanan') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pemesanan.update', $pemesanan->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_penerima">Nama Penerima</label>
                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" value="{{ $pemesanan->nama_penerima }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pemesanan->alamat }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ongkir_id">Ongkir ID</label>
                            <input type="number" class="form-control" id="ongkir_id" name="ongkir_id" value="{{ $pemesanan->ongkir_id }}" required>
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" value="{{ $pemesanan->kota }}" required>
                        </div>

                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $pemesanan->kode_pos }}" required>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $pemesanan->no_telp }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status_bayar">Status Bayar</label>
                            <select class="form-control" id="status_bayar" name="status_bayar" required>
                                <option value="lunas" {{ $pemesanan->status_bayar === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="belum_bayar" {{ $pemesanan->status_bayar === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="produk">Produk</label>
                            @foreach($pemesanan->pemesananProduks as $index => $item)
                                <div class="input-group mb-3">
                                    <input type="hidden" name="produk[{{ $index }}][id]" value="{{ $item->produk_id }}">
                                    <input type="text" class="form-control" value="{{ $item->produk->nama }}" readonly>
                                    <input type="number" class="form-control" name="produk[{{ $index }}][harga]" value="{{ $item->harga }}" required>
                                    <input type="number" class="form-control" name="produk[{{ $index }}][jumlah]" value="{{ $item->jumlah }}" required>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection