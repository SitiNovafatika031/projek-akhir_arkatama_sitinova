@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hapus Pembayaran</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pembayaran.destroy', $pembayaran->id) }}">
                        @csrf
                        @method('DELETE')

                        <p>Anda yakin ingin menghapus pembayaran ini?</p>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection