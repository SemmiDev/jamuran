<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}"
    data-base-url="{{ url('/') }}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | Jamur Nagari Limau Manis </title>
    <meta name="description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords"
        content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />


    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    </style> --}}

    <!-- Include Styles -->
    @include('layouts/sections/styles')

    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('layouts/sections/scriptsIncludes')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <style>
        /* Your custom CSS for DataTables "Show Entries" button */
        .dataTables_length label {
            display: flex;
            align-items: center;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .dataTables_length select {
            margin-left: 5px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            outline: none;
            margin-right: 5px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .dataTables_length select:focus {
            border-color: #007bff;
        }

        .dataTables_length select {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f9fa;
        }

        .dataTables_length select:hover {
            border-color: #007bff;
            background-color: #e9ecef;
        }

        .dataTables_length {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    @include('sweetalert::alert')

    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->

    <!-- Include Scripts -->
    @include('layouts/sections/scripts')
    @stack('scripts')

</body>

</html>
