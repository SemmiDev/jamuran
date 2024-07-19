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
                                <input class="form-control border-none" type="text" id="created_at"
                                    value="{{ $order->created_at }}" readonly />
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <a href="{{ route('admin.orders', ['status' => request('status')]) }}"
                                    class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
