@extends('layouts.app')

@section('title')
    Blog system
@endsection

@section('content')
    {{--<main role="main" class="container" style="margin-top: 5px">--}}
    <div class="container-fluid">
        <div class="row wrapper">
            <div class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Categories <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                        <ol class="list-unstyled">
                            <a href="/">All News
                                ({{ ($archives->count() ) }})
                            </a>
                            @foreach($postincategorycount as $item)
                                {{--({{dump($item)}})--}}
                            @endforeach
                        </ol>
                    </li>
                    @if($category)
                        {{--TODO: STRANGE DUMP--}}
                        {{--{{dump($postincategorycount)}}--}}
                        {{--                        {{dump($postincategorycount->$category)}}--}}
                        @foreach($postincategorycount as $item)
                            <li class="nav-item">
                                <ol class="list-unstyled pt-2">
                                    <li>
                                        <a href="{{ route('index', ['id' => $item->categoryURL]) }}">{{$item->category, 60, '...'}}
                                            ({{$item->cnt}})
                                            {{--@foreach($posts as $post)--}}
                                            {{--@if(($post->category_categoryID) == ($selectedcat))--}}
                                            {{--@endif--}}
                                            {{--@endforeach--}}
                                        </a>
                                    </li>
                                </ol>

                            </li>
                            <tr>
                                <td>
                                    {{--<a href="{{ route('post.detail', ['id' => $item->categoryID]) }}">Details</a>--}}
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </ul>
            </div>


            {{--<div class="row">--}}
            <div class="blog-main col-sm-6 col-md-6 pt-3">
                {{--<div class="blog-main col-sm-6 col-md-8">--}}
                @if($posts)

                    @foreach($posts as $post)
                        <div class="card">
                            <div>
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
                                <b>{!! \Illuminate\Support\Str::words($post->description, 10, '...') !!}</b>
                            </div>
                            <div>
                                {!! \Illuminate\Support\Str::words($post->content, 50, '...') !!}
                            </div>
                            <div>
                                <blockquote>
                                    <p>
                                        <a href="{{
                                    route('post.read', ['post_id' => $post->postURL])
                                    }}"
                                           class="btn btn-outline-primary btn-sm">Learn more</a></p>

                                </blockquote>
                            </div>

                        </div>
                        {{--<h2 >There is no records</h2>--}}
                    @endforeach
                    {{--{{dd($posts)}}--}}
                @else

                @endif
                {{--{{dump($posts->count() )}}--}}
                @if($posts->count() === 0)
                    <div class="card">
                        {{--<h2 class="blog-post-title">{{ $post->title }}</h2>--}}
                        <h2>There is no records</h2>
                    </div>

                @else
                    {{--selectedcat{{dd($category->offsetGet($selectedcat)->categoryDESCRIPTION)}}--}}
                    @if($selectedcat != 0)
                        <div class="card">
                            @if($posts->hasMorePages() === false)
                                {{--{{dump($posts->currentPage())}}--}}
                                {{--{{dump($posts->hasMorePages())}}--}}
                                No more news for
                                {{--{{dump($selectedcatDesk)}}--}}
                                <b>"{{($selectedcatDesk)}}"</b>
                                category
                                {{--<h2 >{{ $category->items[0] }}</h2>--}}
                                {{--{{$category[]}}--}}
                            @endif
                        </div>
                    @endif
                @endif

                <nav class="blog-pagination">
                    {{ $posts->links() }}
                </nav>

                <!-- /.blog-main -->
                <!-- disqus service -->
                <div id="disqus_thread"></div>
                <script>

                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    var disqus_config = function () {
                        this.page.url = '{{ Request::url() }}';  // Replace PAGE_URL with your page's canonical URL variable
                        {{--this.page.identifier = '{{$posts->postID}}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable--}}
                    };
                    (function () { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://none-e6kqadrpfr.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                        powered by Disqus.</a></noscript>
                <!-- /.disqus service -->

                <!-- yandex social buttons -->
                <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                <script src="//yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir"></div>
                <!-- /.yandex social buttons -->

                <!-- /.blog-sidebar -->
            </div>
            {{--</div>--}}
            <div class="col-sm-4  blog-sidebar">
                <div class="sidebar-module">
                    <h4>Latest Posts</h4>
                    @foreach($archives as $archive)
                        <ol class="list-unstyled">
                            <li>
                                {{--<a href="{{ route('post.read', ['post_id' => $archive->postid]) }}">{!! \Illuminate\Support\Str::words($archive->title, 6, '...') !!}</a>--}}
                                <a href="{{ route('post.read', ['post_id' => $archive->postURL]) }}">{{$archive->title, 6, '...'}}</a>
                            </li>
                        </ol>
                    @endforeach
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    {{--$post->postURL--}}
    </main><!-- /.container -->
@endsection