@extends('layouts.admin')

@section('content')
    <div class="row row-cols-1 row-cols-md-4 g-3">
        <div class="col">
            <div class="card border-danger border shadow-lg h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <i class='bx bxs-hourglass-top bx-lg text-danger'></i>
                    <h5 class="card-title mt-3">Menunggu Pembayaran</h5>
                    <p class="card-text fw-bold text-danger" style="font-size: 30px">
                        {{ $waitingPaymentCount }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            {{ $lastTimeWaitingPayment ?? \Carbon\Carbon::parse($lastTimeWaitingPayment)->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-warning border shadow-lg h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <i class='bx bx-wallet bx-lg text-warning'></i>
                    <h5 class="card-title mt-3">Pembayaran Selesai</h5>
                    <p class="card-text fw-bold text-warning" style="font-size: 30px">
                        {{ $paymentCompletedCount }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            {{ $lastTimePaymentCompleted ?? \Carbon\Carbon::parse($lastTimePaymentCompleted)->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-primary border shadow-lg h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <i class='bx bxl-telegram bx-lg text-primary'></i>
                    <h5 class="card-title mt-3">Sedang Dikirim</h5>
                    <p class="card-text fw-bold text-primary" style="font-size: 30px">
                        {{ $shippingCount }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            {{ $lastTimeShipping ?? \Carbon\Carbon::parse($lastTimeShipping)->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-success border shadow-lg h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <i class='bx bx-calendar-check bx-lg text-success'></i>
                    <h5 class="card-title mt-3">Transaksi Selesai</h5>
                    <p class="card-text fw-bold text-success" style="font-size: 30px">
                        {{ $transactionCompletedCount }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            {{ $lastTimeCompleted ?? \Carbon\Carbon::parse($lastTimeCompleted)->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="card mb-3">
        <div class="card-header">Total Produk</div>
        <div class="card-body">
            <h5 class="card-title">{{ $totalProducts }}</h5>
            <p class="card-text">Jumlah total produk yang terdaftar.</p>
        </div>
    </div> --}}
@endsection
