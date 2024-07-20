@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Profil')

@section('content')
    @yield('content')
    @yield('scripts')
@endsection
