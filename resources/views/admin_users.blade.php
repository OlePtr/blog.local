{{--@extends('layouts.app')--}}
@extends('layouts.admin_template')

@section('table')

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        {{--<div class="col-sm-8 blog-main">--}}
        <h1>Admins
            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-primary btn-sm">Create admin</button>
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
                <th>login</th>
                <th>email</th>
                <th>actions</th>

            </tr>
            </thead>
            <tbody>
            @if($users)
                @foreach($users as $user)
                    <tr>
                        <div class="">
                        </div>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                            @if ($user->name != $currentuser->name)
                                <a href="{{ route('user.delete', ['id' => $user->id]) }}">
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <p class="text-center text-primary">No Posts created Yet!</p>
            @endif
        </table>
        <Br>
    </main>
@endsection
