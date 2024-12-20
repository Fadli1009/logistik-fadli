<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengeluaran Barang</title>
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #475569;
            --accent: #f97316;
            --light: #f8fafc;
            --dark: #1e293b;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 20px;
            color: var(--dark);
            background-color: var(--light);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            color: var(--primary);
        }

        .company-name {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .report-title {
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 20px;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            color: var(--secondary);
            font-size: 14px;
        }

        .report-period {
            padding: 8px 16px;
            background-color: var(--primary);
            color: white;
            border-radius: 4px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tr:hover {
            background-color: #f1f5f9;
        }

        .quantity {
            font-weight: bold;
            color: var(--accent);
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            color: var(--secondary);
        }

        .signature-space {
            margin-top: 80px;
            border-top: 2px solid var(--primary);
            width: 200px;
            display: inline-block;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
                background-color: white;
            }

            .table {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="company-name">FADLI LOGISTIK</h1>
        <div class="report-title">Laporan Pengeluaran Barang</div>
    </div>

    <div class="report-info">
        <div>
            <strong>Tanggal Cetak:</strong> {{ date('d/m/Y') }}
            <br>
            <strong>Waktu Cetak:</strong> {{ date('H:i:s') }}
        </div>
        <div class="report-period">
            Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d
            {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Nomor Seri</th>
                <th width="15%">Kode Barang</th>
                <th width="10%">QTY</th>
                <th width="35%">Dikirim ke</th>
                <th width="20%">Tanggal Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataBarangKeluar as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->barang->nomorSeri }}</td>
                    <td>{{ $item->barang->kodeBarang }}</td>
                    <td class="quantity">{{ $item->qty }}</td>
                    <td>{{ $item->barang->origin }} -> {{ $item->destination }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right"><strong>Total Barang Keluar:</strong></td>
                <td class="quantity">{{ $dataBarangKeluar->sum('qty') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak oleh: Admin</p>
        <div class="signature-space"></div>
        <p>( ........................... )</p>
    </div>
</body>

</html>
