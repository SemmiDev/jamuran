@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Pemesanan</h5>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formOrderEdit" method="POST"
                        action="{{ route('admin.orders.update', ['id' => $order->id, 'status' => request('status')]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="buyer_name" class="form-label">Nama Pembeli</label>
                                <input class="form-control" type="text" id="buyer_name" value="{{ $order->user->name }}"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="total_qty" class="form-label">Total Kuantitas</label>
                                <input class="form-control" type="number" id="total_qty" value="{{ $order->total_qty }}"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="total_price" class="form-label">Total Harga</label>
                                <input class="form-control" type="text" id="total_price"
                                    value="{{ $order->total_price }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Alamat</label>
                                <input class="form-control" type="text" id="address" name="address"
                                    value="{{ $order->address }}" required autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="belum_membayar"
                                        {{ $order->status == 'belum_membayar' ? 'selected' : '' }}>Belum Membayar</option>
                                    <option value="sudah_membayar"
                                        {{ $order->status == 'sudah_membayar' ? 'selected' : '' }}>Sudah Membayar</option>
                                    <option value="verifikasi" {{ $order->status == 'verifikasi' ? 'selected' : '' }}>
                                        Verifikasi</option>
                                    <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim
                                    </option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="created_at" class="form-label">Tanggal Order</label>
                                <input class="form-control" type="text" id="created_at" value="{{ $order->created_at }}"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="payment_proof" class="form-label">Bukti Pembayaran</label>
                                @if ($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">Lihat Bukti
                                        Pembayaran</a>
                                @else
                                    <input class="form-control" type="text" value="Belum ada bukti pembayaran"
                                        readonly />
                                @endif
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <a href="{{ route('admin.orders', ['status' => request('status')]) }}"
                                    class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
