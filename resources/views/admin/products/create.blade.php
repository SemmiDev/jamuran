@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Produk</h5>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formAddProduct" method="POST" action="{{ route('admin.products.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input class="form-control" type="text" id="product_name" name="product_name"
                                    placeholder="Nama Produk" required autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="price" class="form-label">Harga</label>
                                <input class="form-control" type="number" id="price" name="price" placeholder="Harga"
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="stock" class="form-label">Stok</label>
                                <input class="form-control" type="number" id="stock" name="stock" placeholder="Stok"
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Deskripsi Produk"></textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="photo" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="photo" name="photo" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="owner_name" class="form-label">Nama Pemilik</label>
                                <input list="merchants" class="form-control" placeholder="Masukkan nama pemilik produk"
                                    id="owner_name" name="owner_name">
                                <datalist id="merchants">
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
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
