@extends('base')
@section('title', 'Stok Barang')
@section('content')
    <div class="my-3 text-center">
        <h3 class="fw-bold">Data Barang Masuk / Keluar</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Stok Barang</h5>
        </div>
        <div class="card-body">
            <div id="chart"></div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h5>QTY Pengeluaran Barang</h5>
        </div>
        <div class="card-body">
            <div id="chartPengeluaran"></div>
        </div>
    </div>
    <script>
        var options = {
            series: [{
                name: "QTY stok barang hari ini",
                data: [{{ $total }}]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Stok barang per hari',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                type: 'datetime',
                categories: @json(
                    $dataKeluar->pluck('created_at')->map(function ($tanggal) {
                        return \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
                    })),
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var options = {
            series: [{
                name: "Pengeluaran barang hari ini",
                data: [{{ $totalPengeluaran }}]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'QTY pengeluaran barang per hari',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                type: 'datetime',
                categories: @json(
                    $dataKeluar->pluck('created_at')->map(function ($tanggal) {
                        return \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
                    })),
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chartPengeluaran"), options);
        chart.render();
    </script>
@endsection
