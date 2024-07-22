@extends('layouts.user')

@section('content')
    <div class="card">
        <div class="card-header">Informasi Pemesanan</div>
        <div class="card-body">
            <p><strong>Nama Pembeli:</strong> {{ $order->user->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>Total Harga + Ongkos Kirim:</strong>
                {{ \App\Models\CurrencyHelper::formatRupiah($order->total_price) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Bukti Pembayaran:</strong>
                @if ($order->payment_proof)
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a>
                @else
                    Belum ada bukti pembayaran
                @endif
            </p>
            <p><strong>Tanggal Pemesanan:</strong>
                @php \Carbon\Carbon::setLocale('id'); @endphp
                {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l, j F Y H:i') }}
            </p>

            <h5 class="mt-5">Daftar Produk Pesanan</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama produk</th>
                        <th>Total</th>
                        <th>Harga Per Produk</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price) }}</td>
                            <td>{{ \App\Models\CurrencyHelper::formatRupiah($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Ongkos Kirim</strong></td>
                        <td>{{ \App\Models\CurrencyHelper::formatRupiah(
                            $order->total_price -
                                $order->items->sum(function ($item) {
                                    return $item->price * $item->quantity;
                                }),
                        ) }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" class="text-right"><strong>Total Keseluruhan:</strong></td>
                        <td>{{ \App\Models\CurrencyHelper::formatRupiah($order->total_price) }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
