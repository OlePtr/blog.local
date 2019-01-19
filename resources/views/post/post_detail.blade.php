@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>{{ $post->title }}</h1>
                <div class="col-sm-8 blog-main">
                    <p>{{ $post->description }}</p>
                    {{--{{dump($category)}}--}}
                    <a href="{{ route('post.edit', ['id' => $post->postid]) }}">

                        <button type="button" class="btn btn-primary btn-sm">Edit Post</button>
                    </a>
                    <a href="{{ route('post.delete', ['id' => $post->postid]) }}">
                        <button type="button" class="btn btn-danger btn-sm">Delete Post</button>
                    </a>
                </div>
            </main>
        </div>
    </div>
@endsection
