@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="/admin/orders?status=belum_membayar">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-medium d-block mb-1 mt-2">Menunggu Pembayaran</span>
                        <h3 class="card-title mb-2">{{ $waitingPaymentCount }}</h3>
                        <small
                            class="text-success fw-medium">{{ $lastTimeWaitingPayment != '-' ? \Carbon\Carbon::parse($lastTimeWaitingPayment)->diffForHumans() : 'Belum Ada' }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                    <a class="dropdown-item" href="/admin/orders?status=sudah_membayar">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-medium d-block mb-1 mt-2">Pembayaran Selesai</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $paymentCompletedCount }}</h3>
                        <small
                            class="text-info fw-medium">{{ $lastTimePaymentCompleted != '-' ? \Carbon\Carbon::parse($lastTimePaymentCompleted)->diffForHumans() : 'Belum Ada' }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/cc-warning.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="/admin/orders?status=dikirim">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-medium d-block mb-1 mt-2">Sedang Dikirim</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $shippingCount }}</h3>
                        <small
                            class="text-warning fw-medium">{{ $lastTimeShipping != '-' ? \Carbon\Carbon::parse($lastTimeShipping)->diffForHumans() : 'Belum Ada' }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="/admin/orders?status=selesai">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-medium d-block mb-1 mt-2">Transaksi Selesai</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $transactionCompletedCount }}</h3>
                        <small
                            class="text-info fw-medium">{{ $lastTimeCompleted != '-' ? \Carbon\Carbon::parse($lastTimeCompleted)->diffForHumans() : 'Belum Ada' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
