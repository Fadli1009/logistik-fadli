@extends('base')
@section('title', 'Dashboard')
@section('content')
    <div class="my-3">
        <h3>Dashboard</h4>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Jumlah Barang</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $data->count() }}</h5>
                    <p class="card-text">Total barang yang tersedia di sistem.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Keluar Barang</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $dataKeluar->count() }}</h5>
                    <p class="card-text">Total barang yang telah keluar.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Stok Barang</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $stok }}</h5>
                    <p class="card-text">Total stok barang yang tersedia.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Data Barang</h4>
            </div>
            <div class="card-body">
                <div id="chart"></div>
            </div>
        </div>
    </div>

    <script>
        var options = {
            series: [{
                name: 'Barang Masuk',
                data: @json($finalBarangMasukData)
            }, {
                name: 'Barang Keluar',
                data: @json($finalBarangKeluarData)
            }],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: @json($finalTanggal),
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
