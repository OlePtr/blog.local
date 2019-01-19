{{--@extends('layouts.app')--}}
@extends('layouts.admin_template')

@section('table')

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        {{--<div class="col-sm-8 blog-main">--}}
        <h1>Classification
            <a href="{{ route('cat.form') }}">
                <button type="button" class="btn btn-primary btn-sm">Create Classification</button>
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
                <th>URL</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{--{{dd($posts)}}--}}
            @if($category)
                @foreach($category as $cat)
                    <tr>
                        <div class="">
                        </div>

                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $cat->category }}</td>

                        <td>{{ $cat->categoryURL }}</td>

                        <td>{{ $cat->categoryDESCRIPTION }}</td>
                        <td>
                            {{--                                    {{dd($cat)->count()}}--}}
                            {{--{{$cnt= (DB::table('category')->count())}}--}}
                            <a href="{{ route('cat.edit', ['id' => $cat->categoryID]) }}">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                            @php $haverecord=false @endphp
                            @foreach($postincategorycount as $c)
                                @if ($cat->category == $c->category)
                                    {{--{{dump($c->cnt)}}--}}
                                    @php $haverecord=true @endphp
                                @endif
                            @endforeach

                            @if ($haverecord == false )
                                <a href="{{ route('cat.delete', ['id' => $cat->categoryID]) }}">
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
