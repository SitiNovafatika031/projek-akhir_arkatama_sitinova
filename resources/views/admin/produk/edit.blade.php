@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Produk</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.produk.update', $produk->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="kategori_id" class="col-md-4 col-form-label text-md-right">Kategori ID</label>
                            <div class="col-md-6">
                                <input id="kategori_id" type="text" class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id" value="{{ $produk->kategori_id }}" required>
                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $produk->nama }}" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label text-md-right">Harga</label>
                            <div class="col-md-6">
                                <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $produk->harga }}" required>
                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stok" class="col-md-4 col-form-label text-md-right">Stok</label>
                            <div class="col-md-6">
                                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ $produk->stok }}" required>
                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-right">Keterangan</label>
                            <div class="col-md-6">
                                <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ $produk->keterangan }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gambar" class="col-md-4 col-form-label text-md-right">Gambar</label>
                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar" accept="image/*">
                                @error('gambar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($produk->gambar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" height="100">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection