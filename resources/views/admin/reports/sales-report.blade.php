@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            Laporan Penjualan
            <a href="{{ route('admin.reports.print', [
                'report-type' => 'SALES_REPORT',
                'start-date' => $startDateOld,
                'end-date' => $endDateOld,
            ]) }}"
                class="btn btn-primary">
                Cetak
            </a>
        </div>
        <div class="card-body">
            <p><strong>Tanggal Mulai:</strong> {{ $startDate->format('d M Y') }}</p>
            <p><strong>Tanggal Akhir:</strong> {{ $endDate->format('d M Y') }}</p>
            <table class="table table-striped">
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
@endsection
