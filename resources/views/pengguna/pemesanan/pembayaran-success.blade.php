@extends('layouts.apppengguna')

@section('title', 'Pembayaran Berhasil')

@section('content')
<main class="container">
    <div class="alert alert-success">
        <h1>Pembayaran Berhasil!</h1>
        <p>Anda berhasil melakukan pembayaran. Mohon tunggu konfirmasi dari seller.</p>
        <a href="{{ route('index') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</main>
@endsection