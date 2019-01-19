@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>Edit Category</h1>
                <div class="col-md-6">
                    {{--TODO: The error is that there was no ecntype="multipart/form-data" ..............................--}}
                    {{--<form method="post" action="{{ route('post.update', ['id' => $post->postid]) }}">--}}
                    <form method="post" action="{{ route('cat.update', ['id' => $cat->categoryID]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">categoryName</label>
                            <input type="text" class="form-control" id="id_title" name="categoryName"
                                   aria-describedby="title" value="{{ $cat->category }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="id_description" rows="5" name="description">{{ $cat->categoryDESCRIPTION  }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="catURL">URL part</label>
                            <input type="text" class="form-control" id="id_postURL" name="catURL"
                                   aria-describedby="title" value="{{ $cat->categoryURL }}">
                        </div>

                        <button type="submit" class="btn btn-primary">update</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
