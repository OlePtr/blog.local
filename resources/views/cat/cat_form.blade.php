@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>Create category</h1>
                <div class="col-md-4">
                    <form method="post" action="{{ route('cat.form') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="cat_title">category title</label>
                            <input type="text" class="form-control" id="id_title" name="cat_title"
                                   aria-describedby="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="cat_description">Description</label>
                            <textarea class="form-control" id="id_description" rows="3" name="cat_description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">cat_url</label>
                            <textarea class="form-control" id="id_url" rows="3" name="cat_url" placeholder="URL"></textarea>
                        </div>


                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection