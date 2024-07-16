@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Produk</h5>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formEditProduct" method="POST"
                        action="{{ route('admin.products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input class="form-control" type="text" id="product_name"
                                    value="{{ $product->product_name }}" name="product_name" placeholder="Nama Produk"
                                    required autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="price" class="form-label">Harga</label>
                                <input class="form-control" type="number" id="price" value="{{ $product->price }}"
                                    name="price" placeholder="Harga" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="stock" class="form-label">Stok</label>
                                <input class="form-control" type="number" id="stock" value="{{ $product->stock }}"
                                    name="stock" placeholder="Stok" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Deskripsi Produk">{{ $product->description }}</textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="photo" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="photo" name="photo" />
                                @if ($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto Produk"
                                        class="img-fluid mt-2" style="max-height: 150px;">
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="owner_name" class="form-label">Nama Pemilik</label>
                                <input class="form-control" type="text" id="owner_name"
                                    value="{{ $product->owner_name }}" name="owner_name" placeholder="Nama Pemilik"
                                    required />
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Product -->
            </div>
        </div>
    </div>
@endsection
