@extends('layouts.user')

@section('content')
    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                    data-bs-target="#belum-membayar" aria-controls="belum-membayar" aria-selected="true"><i
                        class='bx bx-time-five me-1'></i>
                    <span class="d-none d-sm-block">
                        Belum Membayar</span><span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-info ms-1">
                        {{ $totalBelumMembayar }}
                    </span></button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#sudah-membayar"
                    aria-controls="sudah-membayar" aria-selected="false"><i class='bx bx-wallet me-1'></i><span
                        class="d-none d-sm-block">
                        Sudah Membayar</span>
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-info ms-1">
                        {{ $totalSudahMembayar }}
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#verifikasi"
                    aria-controls="verifikasi" aria-selected="false"><i class='bx bx-credit-card-front me-1'></i><span
                        class="d-none d-sm-block">
                        Verifikasi</span>
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-info ms-1">
                        {{ $totalVerifikasi }}
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#sedang-dikirim"
                    aria-controls="sedang-dikirim" aria-selected="false"><i class='bx bxs-car-garage me-1'></i></i><span
                        class="d-none d-sm-block">
                        Sedang Dikirim</span>
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-info ms-1">
                        {{ $totalDikirim }}
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#selesai"
                    aria-controls="selesai" aria-selected="false"><i class='bx bxs-hand me-1'></i><span
                        class="d-none d-sm-block">
                        Selesai</span>
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-info ms-1">
                        {{ $totalSelesai }}
                    </span>
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="belum-membayar" role="tabpanel">
                <div class="card">
                    <h5 class="card-header">Belum Membayar</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Detail Pesanan</th>
                                    <th>Ongkir</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($belumMembayar as $products)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>
                                            @foreach ($products->items as $item)
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('products.show', ['id' => $item->product->id]) }}">
                                                                        {{ $item->product->product_name }}
                                                                    </a>
                                                                </td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->shipping_cost) }}
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->total_price) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </button>
                                            <button class="btn btn-sm btn-info">
                                                Bayar Sekarang
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                Batalkan Pesanan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="sudah-membayar" role="tabpanel">
                <div class="card">
                    <h5 class="card-header">Sudah Membayar</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Detail Pesanan</th>
                                    <th>Ongkir</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($sudahMembayar as $products)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>
                                            @foreach ($products->items as $item)
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('products.show', ['id' => $item->product->id]) }}">
                                                                        {{ $item->product->product_name }}
                                                                    </a>
                                                                </td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->shipping_cost) }}
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->total_price) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </button>
                                            <button class="btn btn-sm btn-info">
                                                Lihat Bukti Pembayaran
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="verifikasi" role="tabpanel">
                <div class="card">
                    <h5 class="card-header">Verifikasi</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Detail Pesanan</th>
                                    <th>Ongkir</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($verifikasi as $products)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>
                                            @foreach ($products->items as $item)
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('products.show', ['id' => $item->product->id]) }}">
                                                                        {{ $item->product->product_name }}
                                                                    </a>
                                                                </td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->shipping_cost) }}
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->total_price) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="sedang-dikirim" role="tabpanel">
                <div class="card">
                    <h5 class="card-header">Verifikasi</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Detail Pesanan</th>
                                    <th>Ongkir</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($dikirim as $products)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>
                                            @foreach ($products->items as $item)
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('products.show', ['id' => $item->product->id]) }}">
                                                                        {{ $item->product->product_name }}
                                                                    </a>
                                                                </td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->shipping_cost) }}
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->total_price) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="selesai" role="tabpanel">
                <div class="card">
                    <h5 class="card-header">Verifikasi</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Detail Pesanan</th>
                                    <th>Ongkir</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($selesai as $products)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>
                                            @foreach ($products->items as $item)
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('products.show', ['id' => $item->product->id]) }}">
                                                                        {{ $item->product->product_name }}
                                                                    </a>
                                                                </td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->shipping_cost) }}
                                        </td>
                                        <td>
                                            {{ \App\Models\CurrencyHelper::formatRupiah($products->total_price) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
