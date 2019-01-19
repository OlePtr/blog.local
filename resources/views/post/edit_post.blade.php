@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row">

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>Edit Post</h1>
                <div class="col-md-6">
                    {{--TODO: The error is that there was no ecntype="multipart/form-data" ..............................--}}
                    {{--<form method="post" action="{{ route('post.update', ['id' => $post->postid]) }}">--}}
                    <form method="post" action="{{ route('post.update', ['id' => $post->postid]) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="id_title" name="title"
                                   aria-describedby="title" value="{{ $post->title }}">
                        </div>
                        @php
                            $itemlist = \App\Category::all('categoryID', 'category');
                            compact('$itemlist', $itemlist);
                        @endphp

                        <?php

                        ?>


                        <select name="category" id="id_category" class="form-control" name="category">
                            @foreach($itemlist as $item)
                                {{dump($item->category)}}
                                <option value="{{ $item->categoryID }}">{{ $item->category }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="id_description" rows="1"
                                      name="description">{{ $post->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="postURL">URL part</label>
                            <input type="text" class="form-control" id="id_postURL" name="postURL"
                                   aria-describedby="title" value="{{ $post->postURL }}">
                        </div>
                        <div class="form-group">
                            <label for="isPublished">Is published</label>
                            <input type="text" class="form-control" id="id_isPublished" name="isPublished"
                                   aria-describedby="title" value="{{ $post->is_published }}">
                        </div>
                        <div class="form-group">
                            <label for="description">content</label>
                            <textarea class="form-control" id="id_content" rows="5"
                                      name="content">{{ $post->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="imageUpload">File input</label>
                            <input
                                    id="imageUpload"
                                    name="imageUpload"
                                    type="file"
                            >

                        </div>
                        @isset ($post)
                            <div class="mb-4">
                                <img class="img-fluid" src="{{ Storage::url($post->image) }}" alt="">
                            </div>

                        @endisset
                        <input type="hidden" name="urlp" value="{{URL::previous()}}" }}>
                        <button type="submit" class="btn btn-primary">update post</button>

                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
