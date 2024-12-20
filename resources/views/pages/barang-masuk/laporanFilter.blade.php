<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Barang - Fadli Logistik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            color: #333;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 10px;
            color: #007bff;
        }

        h3 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            color: #6c757d;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d1ecf1;
        }
    </style>
</head>

<body>
    <h1>Fadli Logistik</h1>
    <h3>Data Barang Dari Tanggal {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} -
        {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h3>
    <p>Tanggal: {{ date('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Seri</th>
                <th>Kode Barang</th>
                <th>QTY</th>
                <th>Asal</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomorSeri }}</td>
                    <td>{{ $item->kodeBarang }}</td>
                    <td>{{ $item->qty }}</td>
                    @php
                        $toDate = \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
                    @endphp
                    <td>{{ $item->origin }}</td>
                    <td>{{ $toDate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
