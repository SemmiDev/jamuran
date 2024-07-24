<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
        }

        .card-header {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin-left: 10px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <span>Laporan Penjualan</span>
        </div>
        <div class="card-body">
            <p><strong>Tanggal Mulai:</strong> {{ $startDate->format('d M Y') }}</p>
            <p><strong>Tanggal Akhir:</strong> {{ $endDate->format('d M Y') }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Pemilik</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Terjual</th>
                        <th>Harga Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData as $data)
                        <tr>
                            <td>{{ $data->product->owner_name }}</td>
                            <td>{{ $data->product->product_name }}</td>
                            <td>{{ $data->jumlah_terjual }}</td>
                            <td>{{ App\Models\CurrencyHelper::formatRupiah($data->harga_terjual) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
