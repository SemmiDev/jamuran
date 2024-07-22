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
                                            <div class="d-flex gap-2 align-middle flex-wrap">
                                                <a href="{{ route('users.orders.detail', ['id' => $products->id]) }}"
                                                    class="btn btn-sm btn-success">
                                                    Detail Pesanan
                                                </a>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="{{ '#basicModal' . $products->id }}">
                                                        Bayar Sekarang
                                                    </button>
                                                    <div class="modal fade" id="{{ 'basicModal' . $products->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form method="post"
                                                                action="{{ route('users.orders.pay', ['id' => $products->id]) }}"
                                                                enctype="multipart/form-data" class="modal-content">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel1">
                                                                        Bayar Pesanan
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="photo"
                                                                                class="form-label">Silahkan Transfer ke
                                                                                Salah Satu Bank</label>
                                                                            <div class="demo-inline-spacing mt-3">
                                                                                <ul class="list-group">
                                                                                    @foreach ($bankAccounts as $bank)
                                                                                        <li
                                                                                            class="list-group-item d-flex gap-3 align-items-center">
                                                                                            {{ $bank->name }}
                                                                                            <span class="badge bg-info">
                                                                                                {{ $bank->account_number }}
                                                                                            </span>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="payment_proof"
                                                                                class="form-label">Upload Bukti
                                                                                Pembayaran</label>
                                                                            <input class="form-control" type="file"
                                                                                accept="image/*" id="payment_proof"
                                                                                name="payment_proof" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form method="post"
                                                    action="{{ route('users.orders.cancel', ['id' => $products->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Batalkan Pesanan
                                                    </button>
                                                </form>
                                            </div>
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
                                            <a href="{{ route('users.orders.detail', ['id' => $products->id]) }}"
                                                class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </a>
                                            <a href="{{ asset('storage/' . $products->payment_proof) }}" target="_blank"
                                                target="_blank" class="btn btn-sm btn-info">
                                                Lihat Bukti Pembayaran
                                            </a>
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
                                            <a href="{{ route('users.orders.detail', ['id' => $products->id]) }}"
                                                class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </a>
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
                    <h5 class="card-header">Sedang Dikirim</h5>
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
                                            <div class="flex gap-2 items-baseline flex-wrap">

                                                <a href="{{ route('users.orders.detail', ['id' => $products->id]) }}"
                                                    class="btn btn-sm btn-success">
                                                    Detail Pesanan
                                                </a>
                                                <form method="post"
                                                    action="{{ route('users.orders.accept', ['id' => $products->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-info">
                                                        Selesaikan Pesanan
                                                    </button>
                                                </form>

                                            </div>
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
                    <h5 class="card-header">Selesai</h5>
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
                                            <a href="{{ route('users.orders.detail', ['id' => $products->id]) }}"
                                                class="btn btn-sm btn-success">
                                                Detail Pesanan
                                            </a>
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
