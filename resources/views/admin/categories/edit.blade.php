@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Kategori</h5>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST"
                        action="{{ route('admin.categories.update', ['id' => $category->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nama Kategori</label>
                                <input class="form-control" type="text" id="name" value="{{ $category->name }}"
                                    name="name" placeholder="Makanan" required autofocus />
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <a href="{{ route('admin.categories') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
