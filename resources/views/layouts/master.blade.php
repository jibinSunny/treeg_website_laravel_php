<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name').' | ' }} @yield('title')</title>

    <!-- Scripts -->
    @include('includes.css')
</head>

<body>
<div id="wrapper">
    @include('includes.nav')
    <div id="page-wrapper" class="gray-bg">
        @include('includes.top_bar')
        @yield('content')
    </div>

    @include('includes.right_bar')

</div>
    <!-- Mainly scripts -->
    @include('includes.js')
    @yield('scripts')
</body>
</html>
