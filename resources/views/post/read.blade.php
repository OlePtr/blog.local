@extends('layouts.master')

@section('title')
    Welcome Laravel Blog Tutorial
@endsection

@section('content')
    <main role="main" class="container"  style="margin-top: 5px">

        <div class="row">

            <div class="col-sm-8 blog-main">
                <div class="blog-post">
                    <div>
                        {{$post->category}}
                    </div>
                    <h2 class="blog-post-title">{{  $post->title }}</h2>
                    <div class="container" style="display:flex">

                        <div class="container col-sm-4" style="margin:1px">


                        <div class="card-img-top product-image"
                             style="@if ($post->image)background-image: url({{ Storage::url($post->image) }})@endif"></div>

                        <div class="blog-post-meta">
                            <p>{!! \Illuminate\Support\Str::words($post->description, 30, '...') !!}</p>
                            <p class="blog-post-meta"><small><i>{{ Carbon\Carbon::parse($post->published_at)->format('d-m-Y')  }} by <a href="#">{{ $post->authorNAME }}</a></i></small></p>
                            <blockquote>
                                <p>
                                    <a href="{{ route('post.read', ['post_id' => $post->postid]) }}"
                                       class="btn btn-primary btn-sm">Like it</a></p>
                            </blockquote>
                        </div>



                    </div><!-- /.blog-post -->
                        <div class="container style="margin:1px">
                        {{$post->content}}
                    </div>
                    </div>

                </div>



            </div><!-- /.blog-main -->




            <aside class="col-sm-3 ml-sm-auto blog-sidebar">
                <div class="sidebar-module">
                </div>
            </aside><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection