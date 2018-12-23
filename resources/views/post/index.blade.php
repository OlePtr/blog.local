@extends('layouts.master')

@section('title')
   Blog
@endsection

@section('content')
    {{--<main role="main" class="container" style="margin-top: 5px">--}}

        <div class="container-fluid">
        <div class="row wrapper">
            <div class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Post <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">All News</a>
                    </li>
                    @if($category)
                        {{dump($category)}}
                        @foreach($category as $item)
                            <li class="nav-item">

                                <ol class="list-unstyled">
                                    <li>
                                        {{--<a class="nav-link" href="#">{{$item->category}}</a>--}}
                                        {{--<a href="{{ route('post.read', ['post_id' => $archive->postid]) }}">{!! \Illuminate\Support\Str::words($archive->title, 6, '...') !!}</a>--}}
                                        <a href="{{ route('index', ['id' => $item->categoryID]) }}">{{$item->category, 6, '...'}}</a>
                                    </li>
                                </ol>

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
            </div>
            {{--<main role="main" class="col-sm-8 ml-sm-auto col-md-5 pt-3">--}}
            {{--<div class="blog-main col-sm-5 ml-sm-auto col-md-10 pt-3">--}}
            <div class="blog-main col-sm-6 col-md-6 pt-3">
                @if($posts)

                @foreach($posts as $post)
                    <div class="card">
                        <div>
                            {{--{{dd($post)}}--}}
                            <h2 class="blog-post-title">{{ $post->title }}</h2>
                            <p class="blog-post-meta">
                                <small><i>{{ Carbon\Carbon::parse($post->published_at)->format('d-m-Y')  }} by <a
                                                href="#">{{ $post->authorNAME }}</a></i></small>
                            </p>

                        </div>

                        {{--{{ dump(Storage::url($post->image)) }}--}}
                        <div class="card-img-top product-image"

                             style="@if ($post->image)background-image: url({{ Storage::url($post->image) }})@endif">

                        </div>
                        <div>
                            <p>{!! \Illuminate\Support\Str::words($post->description, 30, '...') !!}</p>
                            <blockquote>
                                <p>
                                    {{--route('post.read', ['post_id' => $post->postid])--}}
                                    {{--route('post.read', ['post_id' => $post->postid])--}}
                                    {{--route (('/post/read/{post_id}', 'PostController@getFullPost')->name('post.read'))--}}

                                    <a href="{{

                                    route('post.read', ['post_id' => $post->postid])


                                    }}"
                                       class="btn btn-primary btn-sm">Learn more</a></p>
                            </blockquote>
                        </div>

                    </div>
                @endforeach
                @endif
                <nav class="blog-pagination">
                    {{ $posts->links() }}
                </nav>

            <!-- /.blog-main -->

            <!-- /.blog-sidebar -->
            </div>
            <div class="col-sm-4  blog-sidebar">
                <div class="sidebar-module">
                    <h4>Latest Posts</h4>
                    @foreach($archives as $archive)
                        <ol class="list-unstyled">
                            <li>
                                {{--<a href="{{ route('post.read', ['post_id' => $archive->postid]) }}">{!! \Illuminate\Support\Str::words($archive->title, 6, '...') !!}</a>--}}
                                <a href="{{ route('post.read', ['post_id' => $archive->postid]) }}">{{$archive->title, 6, '...'}}</a>
                            </li>
                        </ol>
                    @endforeach
                </div>
            </div>

        </div>
            <!-- /.row -->

        </div>



    </main><!-- /.container -->
@endsection