@php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} shadow-none navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
            <span class="app-brand-text demo menu-text fw-bold">{{ config('variables.templateName') }}</span>
        </a>
    </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->

    @if (auth()->user()->role == 'Admin')
        <a href="{{ route('dashboard') }}" class="navbar-nav align-items-center text-light">
            Kampung Jamur Limau Manis
        </a>
    @else
        <div>
            <form method="get" action="{{ route('dashboard') }}" class="input-group  input-group-merge"
                onsubmit="return handleEnter(event)">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" name="q" class="form-control" placeholder="Cari Produk..."
                    aria-label="Cari Produk..." aria-describedby="basic-addon-search31"
                    onkeydown="submitOnEnter(event)" />
            </form>
        </div>

        <script>
            function submitOnEnter(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent the default form submission
                    event.target.form.submit(); // Submit the form
                }
            }
        </script>
    @endif


    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <div class="d-none d-md-block">
            {{ ucwords(auth()->user()->username) }}
        </div>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    @if (auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt
                            class="w-px-40 h-48 rounded-circle">
                    @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-48 rounded-circle">
                    @endif
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    @if (auth()->user()->photo)
                                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt
                                            class="w-px-40 h-48 rounded-circle">
                                    @else
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-48 rounded-circle">
                                    @endif
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-medium d-block">
                                    {{ ucwords(auth()->user()->name) }}
                                </span>
                                <small class="text-muted">
                                    {{ ucwords(auth()->user()->role) }}
                                </small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Informasi Profil</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'User')
                    <li>
                        <a class="dropdown-item" href="{{ route('users.orders') }}">
                            <i class="bx bx-cart me-2"></i>
                            <span class="align-middle">Pesanan Anda</span>
                        </a>
                    </li>
                @endif
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class='bx bx-power-off me-2'></i>
                            <span class="align-middle">Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>

@if (!isset($navbarDetached))
    </div>
@endif
</nav>
<!-- / Navbar -->
