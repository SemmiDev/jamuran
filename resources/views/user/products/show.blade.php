@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img h-full card-img-left" src="{{ asset('storage/' . $product->photo) }}"
                                alt="Card image" />
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">

                                <span class="badge rounded-sm bg-success">
                                    {{ $product->category->name }}
                                </span>

                                <span class="badge rounded-sm bg-info">
                                    Tersisa <strong>{{ $product->stock }}</strong> Produk
                                </span>

                                <h5 class="card-title mt-3 fw-bolder">{{ $product->product_name }}</h5>

                                <span class="fw-bolder" style="font-size: 30px; color: black">
                                    {{ \App\Models\CurrencyHelper::formatRupiah($product->price) }}
                                </span>

                                <p class="card-text">
                                    {{ $product->description }}
                                </p>
                                <p class="card-text"><small class="text-muted">
                                        {{ \Carbon\Carbon::parse($product->updated_at)->diffForHumans() }}
                                    </small>
                                </p>

                                <div class="row">
                                    <div class="col-xxl">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="quantity">Jumlah</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" value="1" min="1"
                                                            max="{{ $product->stock }}" class="form-control" required
                                                            id="quantity" oninput="calculateSubtotal()" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="total_price">Subtotal</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" readonly
                                                            value="{{ \App\Models\CurrencyHelper::formatRupiah($product->price) }}"
                                                            class="form-control" id="total_price" />
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-10">
                                                        <div class="modal fade" id="exLargeModal" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <form
                                                                    action="{{ route('products.checkout', ['id' => $product->id]) }}"
                                                                    method="post" class="modal-content">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel4">
                                                                            Masukkan Detail Pesanan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="number" hidden name="quantity"
                                                                            value="1" class="form-control"
                                                                            id="quantity_modal" />

                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="address"
                                                                                    class="form-label">Subtotal
                                                                                    Produk</label>
                                                                                <input type="text" readonly
                                                                                    value="{{ \App\Models\CurrencyHelper::formatRupiah($product->price) }}"
                                                                                    class="form-control"
                                                                                    id="total_price_modal" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="address"
                                                                                    class="form-label">Pilih
                                                                                    Alamat</label>
                                                                                <select class="form-control" id="address"
                                                                                    name="address" required>
                                                                                    @foreach ($addresses as $address)
                                                                                        <option
                                                                                            value="{{ $address->address }}">
                                                                                            {{ $address->address }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="shippingCost"
                                                                                    class="form-label">Ongkos Kirim</label>
                                                                                <select class="form-control"
                                                                                    id="shippingCost" name="shippingCost"
                                                                                    required>
                                                                                    @foreach ($shippingCosts as $cost)
                                                                                        <option
                                                                                            value="{{ $cost->id }}">
                                                                                            {{ $cost->kota . ' ' . \App\Models\CurrencyHelper::formatRupiah($cost->shipping_cost) }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="notes"
                                                                                    class="form-label">Catatan</label>
                                                                                <textarea class="form-control w-full" id="notes" name="notes" rows="4" placeholder="Catatan"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Checkout</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="demo-inline-spacing">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal" data-bs-target="#exLargeModal">
                                                                Beli Langsung
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function formatRupiah(angka, prefix) {
                                                    var numberString = angka.replace(/[^,\d]/g, '').toString(),
                                                        split = numberString.split(','),
                                                        sisa = split[0].length % 3,
                                                        rupiah = split[0].substr(0, sisa),
                                                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                                    if (ribuan) {
                                                        separator = sisa ? '.' : '';
                                                        rupiah += separator + ribuan.join('.');
                                                    }

                                                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                                                }

                                                function calculateSubtotal() {
                                                    var quantity = document.getElementById('quantity').value;
                                                    var price = {{ $product->price }};
                                                    var subtotal = quantity * price;

                                                    document.getElementById('total_price').value = formatRupiah(subtotal.toString(), 'Rp. ');
                                                    document.getElementById('total_price_modal').value = formatRupiah(subtotal.toString(), 'Rp. ');
                                                    document.getElementById('quantity_modal').value = quantity;
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
