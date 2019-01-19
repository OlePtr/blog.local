@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>Create admin</h1>
                <div class="col-md-4">
                    <form method="post" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="id_name" name="name"
                                   aria-describedby="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" class="form-control" id="id_email" name="email"
                                   aria-describedby="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="pass">password</label>
                            <input type="text" class="form-control" id="id_pass" name="pass"
                                   aria-describedby="pass" placeholder="Enter password">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection