<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Barang - Fadli Logistik</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 5px;
            color: #4CAF50;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            color: #555;
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d1e7dd;
        }

        tfoot {
            font-weight: bold;
            background-color: #4CAF50;
            color: white;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <h1>Fadli Logistik</h1>
    <h2>Data Barang</h2>
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
        <tfoot>
            <tr>
                <td colspan="3">Total Barang</td>
                <td colspan="3">{{ $data->sum('qty') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Fadli Logistik. All rights reserved.
    </div>
</body>

</html>
