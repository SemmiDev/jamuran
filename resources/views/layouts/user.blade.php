@php
    $isMenu = false;
    $navbarHideToggle = false;
    $isNavbar = true;
    $isUserNavbar = true;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Produk')

@section('content')
    @yield('content')
    @yield('scripts')
@endsection
