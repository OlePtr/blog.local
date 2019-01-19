<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/dashboard.css') }}">
    @yield('styles')
</head>
<body>
@include('partials.header')
@yield('content')

<script type="text/javascript" src="{{ URL::to('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/bootstrap.min.js') }}"></script>
<style>
    .product-image {
        background: #cecece center / cover;
        height: 200px;
        width: 200px;
    }

    .product-price {
        font-size: 18px;
        font-weight: bold;
    }

    .product-window {
        max-width: 680px;
    }

    .cart {
        position: fixed;
        background: #333;
        color: #fff;
        top: 0;
        right: 0;
        padding: 25px;
        z-index: 10;
    }

</style>

@yield('scripts')
</body>
</html>