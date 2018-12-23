@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Post <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item again</a>
                    </li>
                    @if($category)
                        {{dump($category)}}
                        @foreach($category as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="#">Nav item again</a>
                            </li>

                            <tr>
                                {{--<td>{{ $item->category }}</td>--}}
                                <td>
                                    {{--<a href="{{ route('post.detail', ['id' => $item->categoryID]) }}">Details</a>--}}
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </ul>
            </nav>
            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            {{--<div class="col-sm-8 blog-main">--}}
                <h1>Posts
                    <a href="{{ route('post.form') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Post</button>
                    </a>
                </h1>
                @if(Session::has('success'))
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                            <div id="message" class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>More details</th>
                        <th>Created on</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($posts)
                        @foreach($posts as $post)
                            <tr>

                                     {{--{{ dd($post->image) }}--}}
                                <div class=""
                                     style="@if ($post->image)background-image: url({{ Storage::url($post->image) }})@endif"></div>


                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $post->category }}</td>

                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td>{{ $post->authorNAME }}</td>
                                <td>
                                    <a href="{{ route('post.detail', ['id' => $post->postid]) }}">view more</a>
                                </td>
                               <td>{{ Carbon\Carbon::parse($post->published_at)->format('d-m-Y')  }}</td>
                            </tr>
                        @endforeach
                    @else
                        <p class="text-center text-primary">No Posts created Yet!</p>
                    @endif
                </table><Br>
            {{--</div>--}}
        </div>

        </div>
    </div>
@endsection
