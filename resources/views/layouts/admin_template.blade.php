{{--@extends('layouts.app')--}}
@extends('layouts.master')

@section('content')

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row">


            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                {{--<ul class="nav nav-pills flex-column">--}}
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link active" href="#">A dd<span class="sr-only">(current)</span></a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/posts">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/classification">Classification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/admins">Admins</a>
                    </li>

                </ul>
            </nav>
            @yield('table')
        </div>


    </div>
    </div>

@endsection
