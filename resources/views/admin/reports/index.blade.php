@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Laporan</div>
        <div class="card-body">
            <form method="POST" id="reportForm" action="{{ route('admin.reports.generate') }}">
                @csrf
                <div class="mb-3">
                    <label for="report-type" class="form-label">Jenis Laporan</label>
                    <select class="form-control" id="report-type" name="report-type" required>
                        <option value="">Pilih Jenis Laporan</option>
                        <option value="STOCK_REPORT">Laporan Stok</option>
                        <option value="SALES_REPORT">Laporan Penjualan</option>
                    </select>
                </div>


                @php
                    $firstDateInThisMonth = \Carbon\Carbon::now()->startOfMonth()->toDateString();
                    $currentDateInThisMonth = \Carbon\Carbon::now()->toDateString();
                @endphp

                <div class="mb-3">
                    <label for="start-date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" value="{{ $firstDateInThisMonth }}" id="start-date"
                        name="start-date" required>
                </div>
                <div class="mb-3">
                    <label for="end-date" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" value="{{ $currentDateInThisMonth }}" id="end-date"
                        name="end-date" required>
                </div>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
