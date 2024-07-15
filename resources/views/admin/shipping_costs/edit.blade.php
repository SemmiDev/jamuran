@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Biaya Pengiriman</h5>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST"
                        action="{{ route('admin.shipping_costs.update', ['id' => $shipping_cost->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="kota" class="form-label">Nama Kota</label>
                                    <input class="form-control" type="text" id="kota" name="kota"
                                        value="{{ $shipping_cost->kota }}" placeholder="Pekanbaru" required autofocus />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="shipping_cost" class="form-label">Biaya Pengiriman</label>
                                    <input class="form-control" type="number" id="shipping_cost" name="shipping_cost"
                                        value="{{ $shipping_cost->shipping_cost }}" placeholder="10000" required />
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    <a href="{{ route('admin.shipping_costs') }}"
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
