@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kategori</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $kategori->nama }}" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gambar" class="col-md-4 col-form-label text-md-right">Gambar</label>
                            <div class="col-md-6">
                                @if($kategori->gambar)
                                    <img src="{{ asset('storage/' . $kategori->gambar) }}" alt="Gambar Kategori" class="img-thumbnail mb-2" style="width: 150px;">
                                @endif
                                <input id="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">
                                @error('gambar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit Kategori
                                </button>
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection