@extends('layouts.user')

@section('content')
    @if ($carouselProducts->count() > 0)
        <div class="col-md">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <a href="{{ route('products.show', ['id' => $carouselProducts->first()->id]) }}"
                        class="carousel-item active">
                        <img class="d-block w-100" style="height:500px; object-fit: cover"
                            src="{{ asset('storage/' . $carouselProducts->first()->photo) }}" alt="First slide" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3>
                                {{ $carouselProducts->first()->product_name }}
                            </h3>
                            <p>
                                {{ $carouselProducts->first()->description }}
                            </p>
                        </div>
                    </a>
                    @for ($i = 1; $i < count($carouselProducts); $i++)
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('storage/' . $carouselProducts[$i]->photo) }}"
                                style="height:500px; object-fit: cover" alt="Second slide" />
                            <div class="carousel-caption d-none d-md-block">
                                <h3>
                                    {{ $carouselProducts[$i]->product_name }}
                                </h3>
                                <p>
                                    {{ $carouselProducts[$i]->description }}
                                </p>
                            </div>
                        </div>
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Selanjutnya</span>
                </a>
            </div>
        </div>
    @endif

    <div class="container my-5">
        <div class="card mb-4">
            <h5 class="card-header">
                Kategori Pilihan

            </h5>

            <div class="card-body demo-inline-spacing mb-5">
                <a href="{{ route('dashboard') }}" type="button" class="btn btn-outline-info">
                    <i class='bx bxs-category me-2'></i>
                    Semua Kategori
                    <span class="badge ms-1  rounded-pill">
                        {{ $categories->sum('products_count') }}
                    </span>
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('dashboard', ['category' => $category->name]) }}" type="button"
                        class="btn btn-outline-info">
                        {{ $category->name }}
                        <span class="badge ms-1 rounded-pill">
                            {{ $category->products_count }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
                    @forelse ($products as $product)
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" style="height: 250px; object-fit: cover;"
                                    src="{{ asset('storage/' . $product->photo) }}" alt="Card image cap" />
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0">
                                            <a class="text-info"
                                                href="{{ route('products.show', ['id' => $product->id]) }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </h6>
                                        <span class="badge rounded-sm bg-success">
                                            {{ \App\Models\CurrencyHelper::formatRupiah($product->price) }}
                                        </span>
                                        {{-- <button class="btn btn-outline-info btn-circle px-3 ">
                                    <i class='bx bxs-cart-add'></i>
                                </button> --}}
                                    </div>

                                    <a href="{{ route('dashboard', ['category' => $product->category]) }}">
                                        <span class="badge mt-2 rounded-pill bg-info">
                                            {{ $product->category }}
                                        </span>
                                    </a>

                                    <p class="card-text my-2">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>

                                    <span class="position-absolute top-0 end-0 m-2 badge rounded-md bg-info">
                                        Tersisa <strong>{{ $product->stock }}</strong> Produk
                                        <span class="visually-hidden">Sisa Stok</span>
                                    </span>

                                    <small class="fw-bold text-success d-block mb-1">
                                        Terjual
                                        {{ $product->sold ?? 0 }}</small>

                                    <small class="text-muted">
                                        <small class="text-muted text-sm">Diperbarui
                                            {{ \Carbon\Carbon::parse($product->updated_at)->diffForHumans() }}</small>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full alert alert-info">
                            Belum ada produk. Silahkan cek lagi nanti ya 😊
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
        <div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
