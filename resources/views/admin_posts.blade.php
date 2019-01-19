@extends('layouts.admin_template')

@section('table')

    {{--@section('table')--}}
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        {{--<div class="col-sm-8 blog-main">--}}
        <h1>Posts
            {{--
                <a href="{{ View::make('post/post_form')->with('category', $category) }}">
--}}

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
            <colgroup>
                <col width="">
                <col width="">
                <col width="">
                <col width="">
                <col width="">
                <col width="">
                <col width="">
                <col width="80">
                <col width="140">
                <col>
            </colgroup>

            <thead>
            <tr>
                <th>#(ID)</th>
                <th>Published</th>
                <th>Image</th>
                <th>URL</th>
                <th>Category</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>More details</th>
                <th>Created on</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <form action="{{route('index_posts')}}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <th>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Search</button>

                        </div>
                    </th>
                    <th>
                        <div class="form-group">
                            {{--<label for="publishedSearch" class="form-group" style="display:none"></label>--}}
                            <select id="Company" class="form-control" name="publishedSearch">
                                <option value="1" {{ old('publishedSearch') == 1 ? 'selected' : '' }}>true</option>
                                <option value="0" {{ old('publishedSearch') == 0 ? 'selected' : '' }}>false</option>
                            </select>
                        </div>
                    </th>
                    <th></th>
                    <th>
                        {{--{{ Form::select('size', array('L' => 'Large', 'S' => 'Small'))}};--}}
                    </th>
                    <th>
                        <div class="form-group">
                            <input type="text" class="form-control" name="catSearch" placeholder="Enter Category"
                                   value="{{ old('catSearch') }}">
                        </div>

                    </th>

                    <th>
                        <div class="form-group">
                            <input type="text" class="form-control" name="titleSearch" placeholder="Enter title"
                                   value="{{ old('titleSearch') }}">
                        </div>
                    </th>


                    <th>
                        <div class="form-group">
                            <input type="text" class="form-control" name="contentSearch" placeholder="Enter content"
                                   value="{{ old('contentSearch') }}">
                        </div>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>

                </form>


            </tr>
            {{--{{dump($data)}}--}}
            @if($posts)
                @foreach($posts as $post)
                    <tr>
                        {{--{{ dd($post->image) }}--}}
                        <div class=""
                             style="@if ($post->image)background-image: url({{ Storage::url($post->image) }})@endif"></div>

                        <th>{{ $loop->iteration }}({{ $post->postid }})</th>
                        <th>{{ $post->is_published ? 'true' : 'false' }}</th>

                        <td>
                            <img width="50" src="{{Storage::url($post->image)}}" alt="">
                        </td>
                        <td>{{ $post->postURL }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <div class=""
                                 style="
                                                 max-width:300px;
                                                 white-space: nowrap;
                                                 overflow: hidden;
                                                 text-overflow: ellipsis;

">
                                {{ $post->content }}
                            </div>

                        </td>
                        <td>{{ $post->authorNAME }}</td>
                        <td>
                            {{--<a href="{{ route('post.detail', ['id' => $post->postid]) }}">view more</a>--}}
                            <div>
                                <a href="{{ route('post.edit', ['id' => $post->postid]) }}">

                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                </a>
                                <a href="{{ route('post.delete', ['id' => $post->postid]) }}">
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            </div>
                        </td>
                        <td>{{ Carbon\Carbon::parse($post->published_at)->format('d-m-Y')  }}</td>
                    </tr>
                @endforeach
            @else
                <p class="text-center text-primary">No Posts created Yet!</p>
            @endif
        </table>
        <Br>

        <nav class="blog-pagination">
            {{ $posts->links() }}
        </nav>
    </main>
    {{--</div>--}}
    {{--@endsection--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection
