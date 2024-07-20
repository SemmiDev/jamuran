@extends('layouts/blankLayout')

@section('title', 'Daftar')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <img src="{{ asset('logo-jamur.png') }}" style="max-width: 100%; height: auto;" />
                                <span
                                    class="app-brand-text demo text-body fw-bold">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Selamat Datang di Jamur Nagari Limau Manis 👋</h4>
                        <p class="mb-4">
                            Silahkan membuat akun terlebih dahulu
                        </p>
                        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama
                                    <span style="color: red;">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    placeholder="Masukkan nama" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username
                                    <span style="color: red;">*</span>
                                </label>
                                <input type="text" class="form-control" id="username" name="username" required
                                    placeholder="Masukkan username" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Alamat
                                    <span style="color: red;">*</span>
                                </label>
                                <textarea class="form-control" id="address" name="address" required placeholder="Masukkan alamat" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email
                                    <span style="color: red;">*</span>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    placeholder="Masukkan email">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password
                                    <span style="color: red;">*</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" required
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required id="terms-conditions"
                                        name="terms">
                                    <label class="form-check-label" for="terms-conditions">
                                        Saya setuju dengan
                                        <a href="javascript:void(0);">kebijakan privasi & ketentuan</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">
                                Daftar
                            </button>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun?</span>
                            <a href="{{ route('login') }}">
                                <span>Masuk</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection
