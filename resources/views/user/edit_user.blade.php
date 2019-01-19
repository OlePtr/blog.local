@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>Edit administrator</h1>
                <div class="col-md-6">
                    {{--TODO: The error is that there was no ecntype="multipart/form-data" ..............................--}}
                    {{--<form method="post" action="{{ route('post.update', ['id' => $post->postid]) }}">--}}
                    <form method="post" action="{{ route('user.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="id_name" name="name"
                                   aria-describedby="title" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" class="form-control" id="id_email" name="email"
                                    aria-describedby="title" value="{{ $user->email  }}">
                        </div>
                        <div class="form-group">
                            <label for="pass">password</label>
                            <input type="text" class="form-control" id="id_pass" name="pass"
                            aria-describedby="title" value="">
                        </div>


                        {{--<div class="form-group">--}}
                            {{--<label for="catURL">URL part</label>--}}
                            {{--<input type="text" class="form-control" id="id_postURL" name="catURL"--}}
                                   {{--aria-describedby="title" value="{{ $cat->categoryURL }}">--}}
                        {{--</div>--}}

                        <button type="submit" class="btn btn-primary">update</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
