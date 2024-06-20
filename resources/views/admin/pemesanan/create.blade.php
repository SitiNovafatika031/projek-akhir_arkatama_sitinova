@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.partials.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <div class="card">
                    <div class="card-header">{{ __('Create Pemesanan') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pemesanan.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>

                            <div class="form-group">
                                <label for="ongkir_id">Ongkir ID</label>
                                <input type="number" class="form-control" id="ongkir_id" name="ongkir_id" required>
                            </div>

                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" required>
                            </div>

                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                            </div>

                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                            </div>

                            <div class="form-group">
                                <label for="status_bayar">Status Bayar</label>
                                <select class="form-control" id="status_bayar" name="status_bayar" required>
                                    <option value="lunas">Lunas</option>
                                    <option value="belum_bayar">Belum Bayar</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <div id="produk-container">
                                    <div class="produk-item">
                                        <select class="form-control" name="produk[0][id]" required>
                                            @foreach($produk as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control mt-2" name="produk[0][harga]" placeholder="Harga" required>
                                        <input type="number" class="form-control mt-2" name="produk[0][jumlah]" placeholder="Jumlah" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-produk">Tambah Produk</button>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.getElementById('add-produk').addEventListener('click', function() {
        var container = document.getElementById('produk-container');
        var index = container.children.length;
        var div = document.createElement('div');
        div.className = 'produk-item mt-2';
        div.innerHTML = `
            <select class="form-control" name="produk[${index}][id]" required>
                @foreach($produk as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <input type="number" class="form-control mt-2" name="produk[${index}][harga]" placeholder="Harga" required>
            <input type="number" class="form-control mt-2" name="produk[${index}][jumlah]" placeholder="Jumlah" required>
            <button type="button" class="btn btn-danger mt-2 remove-produk">Hapus Produk</button>
        `;
        container.appendChild(div);

        div.querySelector('.remove-produk').addEventListener('click', function() {
            div.remove();
        });
    });
</script>
@endsection
