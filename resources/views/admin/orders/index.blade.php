@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Manajemen Pemesanan
            <span class="fw-bold text-info">
                {{ ucwords(str_replace('_', ' ', request()->get('status'))) }}
            </span>

        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
