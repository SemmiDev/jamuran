@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Nomor Rekening</h5>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('admin.bank_accounts.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nama Rekening</label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="BNI"
                                    required autofocus />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="account_number" class="form-label">Nomor Rekening</label>
                                <input class="form-control" type="number" id="account_number" name="account_number"
                                    placeholder="123132323121" required autofocus />
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('admin.bank_accounts') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
