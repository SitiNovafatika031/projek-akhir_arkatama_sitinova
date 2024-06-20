@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.partials.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Products</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalProducts }}</h5>
                            <img src="{{ asset('icons/cart-shopping-solid.svg') }}" alt="Total Products Icon" class="icon" style="width: 30px; height: 30px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Customers</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalCustomers }}</h5>
                            <img src="{{ asset('icons/users-solid.svg') }}" alt="Total Customers Icon" class="icon" style="width: 30px; height: 30px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Orders</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalOrders }}</h5>
                            <img src="{{ asset('icons/file-lines-solid.svg') }}" alt="Total Orders Icon" class="icon" style="width: 30px; height: 30px;">
                        </div>
                    </div>
                </div>
            </div>

            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    feather.replace();
    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Monthly Sales',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    const config = {
        type: 'line',
        data: data,
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
@endpush