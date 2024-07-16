@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Produk</h5>
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <p class="form-control-static">{{ $product->product_name }}</p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Harga</label>
                            <p class="form-control-static">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Stok</label>
                            <p class="form-control-static">{{ $product->stock }}</p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Kategori</label>
                            <p class="form-control-static">{{ $product->category->name }}</p>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Deskripsi</label>
                            <p class="form-control-static">{{ $product->description }}</p>
                        </div>
                        <div class="mb-3 col-md-6">
                            @if ($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto Produk"
                                    class="img-fluid mt-2" style="max-height: 150px;">
                            @else
                                <p class="form-control-static">Tidak ada foto</p>
                            @endif
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Pemilik</label>
                            <p class="form-control-static">{{ $product->owner_name }}</p>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">Kembali</a>
                            <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}"
                                class="btn btn-primary me-2">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
