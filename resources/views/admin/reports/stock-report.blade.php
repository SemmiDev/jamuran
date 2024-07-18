@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Laporan Stok</div>
        <div class="card-body">
            <p><strong>Tanggal Mulai:</strong> {{ $startDate->format('d M Y') }}</p>
            <p><strong>Tanggal Akhir:</strong> {{ $endDate->format('d M Y') }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Nama Pemilik</th>
                        <th>Jumlah Awal</th>
                        <th>Terjual</th>
                        <th>Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData as $data)
                        <tr>
                            <td>{{ $data['product_name'] }}</td>
                            <td>{{ $data['owner_name'] }}</td>
                            <td>{{ $data['jumlah_awal'] }}</td>
                            <td>{{ $data['terjual'] }}</td>
                            <td>{{ $data['sisa_stok'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
