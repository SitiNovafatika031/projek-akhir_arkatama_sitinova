@extends('layouts.apppengguna')

@section('title', 'Pemesanan Berhasil')

@section('content')
<main class="container">
    <div class="alert alert-success">
        <h1>Pemesanan Berhasil!</h1>
        <p>Terima kasih telah melakukan pemesanan. Kami akan memproses pesanan Anda secepatnya. Mohon Lakukan Pembayaran !!</p>
        <p>Total Pembayaran: Rp {{ number_format($jumlahPembayaran, 0, ',', '.') }}</p>
        <button id="show-payment-form" class="btn btn-primary">Lakukan Pembayaran</button>
        <div id="payment-form" style="display: none; margin-top: 20px;">
            <form method="POST" action="{{ route('pembayaran.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <div class="form-group row">
                    <label for="jumlah_transfer" class="col-md-4 col-form-label text-md-right">Jumlah Transfer</label>
                    <div class="col-md-6">
                        <input id="jumlah_transfer" type="number" step="0.01" class="form-control @error('jumlah_transfer') is-invalid @enderror" name="jumlah_transfer" value="{{ $jumlahPembayaran }}" readonly>
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
                        <select id="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank" required>
                            <option value="BRI">BRI (1876900764347890)</option>
                            <option value="BCA">BCA (1128854568900)</option>
                            <option value="BNI">BNI (6446787544677)</option>
                        </select>
                        @error('nama_bank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 col-form-label text-md-right"></div>
                    <div class="col-md-6">
                        <img id="bank-image" src="" alt="Bank Image" style="display: none; width: 100px; height: auto;"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_pelanggan" class="col-md-4 col-form-label text-md-right">Nama Pelanggan</label>
                    <div class="col-md-6">
                        <input id="nama_pelanggan" type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" value="{{ $pemesanan->nama_pelanggan }}" required>
                        @error('nama_pelanggan')
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    document.getElementById('show-payment-form').addEventListener('click', function() {
        document.getElementById('payment-form').style.display = 'block';
        this.style.display = 'none';
    });

    document.getElementById('nama_bank').addEventListener('change', function() {
        var bankImages = {
            'BRI': 'storage/gambar/bri.jpeg',
            'BCA': 'storage/gambar/bca.jpeg', 
            'BNI': 'storage/gambar/bni.jpeg'
        };
        var selectedBank = this.value;
        var bankImage = document.getElementById('bank-image');
        if (bankImages[selectedBank]) {
            bankImage.src = bankImages[selectedBank];
            bankImage.style.display = 'block';
        } else {
            bankImage.style.display = 'none';
        }
    });
</script>
@endsection