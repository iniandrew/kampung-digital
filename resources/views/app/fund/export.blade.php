<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <style>
        html {
            font-size: 12px;
        }

        .table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 0.5rem;
            border: 1px solid black !important;
        }
    </style>
</head>
<body>
    <h1>Laporan Dana Warga</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kategori</th>
                <th>Rincian Dana</th>
                <th>Total</th>
                <th>Tanggal transaksi</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funds as $index => $fund)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $fund->category }}</td>
                    <td>{{ $fund->body }}</td>
                    <td>Rp. {{number_format($fund->amount,2,',','.')}}</td>
                    <td>{{ date('d M, Y', strtotime($fund->transaction_date)) }}</td>
                    <td>
                        <img src="{{ public_path('storage/dana/'. $fund->attachment) }}" alt="bukti nota" style="width: 150px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <h4>Informasi Saldo Saat Ini</h4>
        <p>Total Pemasukan : Rp. {{number_format($inflow,2,',','.')}}</p>
        <p>Total Pengeluaran : Rp. {{number_format($outlay,2,',','.')}}</p>
        <h4>Total Sisa Saldo : Rp. {{number_format($inflow - $outlay,2,',','.')}}</h4>
        <p style="font-style: italic; margin-top: 30px">Dicetak pada {{ date('Y-m-d H:i:s') }}</p>
    </div>
</body>
</html>
