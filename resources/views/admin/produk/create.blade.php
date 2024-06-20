@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Produk</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="kategori_id" class="col-md-4 col-form-label text-md-right">Kategori ID</label>
                            <div class="col-md-6">
                                <input id="kategori_id" type="text" class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id" required>
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
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required>
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
                                <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" required>
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
                                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" required>
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
                                <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"></textarea>
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
                                <input id="gambar" type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar" accept="gambar/*" required>
                                @error('gambar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">
                                    Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection