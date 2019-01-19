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
                <h1>Create Post</h1>
                <div class="col-md-4">
                    <form method="post" action="{{ route('post.formUP') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="id_title" name="title"
                                   aria-describedby="title" value="{{ old("title", isset($post) ? $post->title : "") }}">
                        </div>
                        <div>
                            @php
                                $itemlist = \App\Category::all('categoryID', 'category');
                                compact('$itemlist', $itemlist);

                            @endphp

                            <?php
                            //Use Illuminate\Html\FormFacade;
                            ?>

                            <label for="category">Category</label>
                            <select name="category" id="id_category" class="form-control" name="category">Category
                                {{--{!! Form::select('status', $itemlist, array('class' => 'form-control')) !!}--}}
                                @foreach($itemlist as $item)
                                    {{dump($item->category)}}
                                    <option value="{{ $item->categoryID }}">{{ $item->category }}</option>
                                    {{--<option value="{{ old("category", isset($post) ? $item->categoryID : "") }}">{{ old("category", isset($post) ? $item->category : "") }}</option>--}}
                                @endforeach
                            </select>

                            <div class="form-group">
                                {{--{!! Form::label('item', 'Item:') !!}--}}
                                {{--{!! Form::select('item_id', $items, null, ['class' => 'form-control']) !!}--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="id_description" rows="2" name="description">{{ old("description", isset($post) ? $post->description : "") }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="postURL">URL part</label>
                            <input type="text" class="form-control" id="id_postURL" name="postURL"
                                   aria-describedby="title" value="{{ old("postURL", isset($post) ? $post->postURL : "") }}">
                        </div>

                        <div class="form-group">
                            <label for="isPublished">Is published</label>
                            <input type="text" class="form-control" id="id_isPublished" name="isPublished"
                                   aria-describedby="Is published" value="{{ old("isPublished", isset($post) ? $post->is_published : "") }}">
                        </div>

                        <div class="form-group">
                            <label for="content">content</label>
                            <textarea class="form-control" id="id_content" rows="5" name="content">{{ old("content", isset($post) ? $post->content : "") }}</textarea>
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
                                <img class="img-fluid" src="" alt="">
                            </div>

                        @endisset


                        <input type="hidden" name="urlp" value="{{ old('redirect_to', URL::previous())}}"  }}>
                        <button type="submit" class="btn btn-primary">Create post</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection