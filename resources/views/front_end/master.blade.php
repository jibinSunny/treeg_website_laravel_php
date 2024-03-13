<!DOCTYPE html>
<html lang="en">

<head>

<title>treeG</title>
<link rel='icon' href='images/logo.png' type='image/x-icon'/ >
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/font-awesome.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/lightbox.min.css') }}">  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/owl.theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/style.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('/front_css/imgareaselect-default.css') }}">  -->
</head>

<body>

    @include('front_end.partials.header')
    @yield('content')
    @include('front_end.partials.footer')
    <!-- <script src="{{ URL::asset('/front_js/app.js') }}"></script> -->

    <!-- <script src="{{ URL::asset('/front_js/bootstrap.bundle.js') }}"></script> -->
    <script src="{{ URL::asset('/front_js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/front_js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('/front_js/jquery-3.4.1.min.js') }}"></script>
    <!-- <script src="{{ URL::asset('/front_js/lightbox.min.js') }}"></script> -->
    <script src="{{ URL::asset('/front_js/owl.carousel.min.js') }}"></script>
    <!-- <script src="{{ URL::asset('/front_js/popper.min.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('/assets/js/jquery.imgareaselect.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('/assets/js/jquery.imgareaselect.pack.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('/assets/js/jquery.Jcrop.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('/assets/js/popper.min.js') }}"></script> -->


</body>
</html>
