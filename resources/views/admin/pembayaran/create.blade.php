@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Pembayaran</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pembayaran.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="pemesanan_id" class="col-md-4 col-form-label text-md-right">Pemesanan ID</label>
                            <div class="col-md-6">
                                <select id="pemesanan_id" class="form-control @error('pemesanan_id') is-invalid @enderror" name="pemesanan_id" required>
                                    @foreach($pemesanan as $item)
                                        <option value="{{ $item->id }}">{{ $item->id }}</option>
                                    @endforeach
                                </select>
                                @error('pemesanan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_pelanggan" class="col-md-4 col-form-label text-md-right">Nama Pelanggan</label>
                            <div class="col-md-6">
                                <input id="nama_pelanggan" type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" required>
                                @error('nama_pelanggan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah_transfer" class="col-md-4 col-form-label text-md-right">Jumlah Transfer</label>
                            <div class="col-md-6">
                                <input id="jumlah_transfer" type="number" step="0.01" class="form-control @error('jumlah_transfer') is-invalid @enderror" name="jumlah_transfer" required>
                                @error('jumlah_transfer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_bank" class="col-md-4 col-form-label text-md-right">Nama Bank</label>
                            <div class="col-md-6">
                                <input id="nama_bank" type="text" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank" required>
                                @error('nama_bank')
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
                            <label for="tanggal" class="col-md-4 col-form-label text-md-right">Tanggal</label>
                            <div class="col-md-6">
                                <input id="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" required>
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="struk_pembayaran" class="col-md-4 col-form-label text-md-right">Struk Pembayaran</label>
                            <div class="col-md-6">
                                <input id="struk_pembayaran" type="file" class="form-control-file @error('struk_pembayaran') is-invalid @enderror" name="struk_pembayaran" accept="image/*">
                                @error('struk_pembayaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection