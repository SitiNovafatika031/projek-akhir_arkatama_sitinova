@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.partials.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Produk</h2>
                    <a href="{{ route('admin.produk.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>
                {!! $dataTable->table(['class' => 'table table-bordered', 'id' => 'produk-table']) !!}
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush