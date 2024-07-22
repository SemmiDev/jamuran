{{-- resources/views/admin/customers/show.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Customer</h5>
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="name" value="{{ $customer->name }}"
                                readonly />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" id="email" value="{{ $customer->email }}"
                                readonly />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="total_orders" class="form-label">Total Pesanan</label>
                            <input class="form-control" type="text" id="total_orders"
                                value="{{ $customer->orders->count() }}" readonly />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Daftar Pesanan</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alamat</th>
                                <th>Total Qty</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                                <th>Dibuat Pada</th>
                                <th>Diperbarui Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer->orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->total_qty }}</td>
                                    <td>{{ 'Rp. ' . number_format($order->total_price, 2, ',', '.') }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $order->status)) }}</td>
                                    <td>
                                        @if ($order->payment_proof)
                                            <a href="{{ asset('storage/' . $order->payment_proof) }}"
                                                target="_blank">Lihat</a>
                                        @else
                                            Tidak Ada
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
