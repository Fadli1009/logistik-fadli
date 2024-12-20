<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengeluaran Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>


<body>
    <h1>Fadli Logistik</h1>
    <h2>Data Barang Keluar Dari Tanggal {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} -
        {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h2>
    <p>Tanggal: {{ date('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Seri</th>
                <th>Kode Barang</th>
                <th>QTY</th>
                <th>Dikirim ke</th>
                <th>Tanggal Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataBarangKeluar as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->barang->nomorSeri }}</td>
                    <td>{{ $item->barang->kodeBarang }}</td>
                    <td>{{ $item->qty }}</td>
                    @php
                        $toDate = \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
                    @endphp
                    <td>{{ $item->barang->origin }} - {{ $item->destination }}</td>
                    <td>{{ $toDate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
