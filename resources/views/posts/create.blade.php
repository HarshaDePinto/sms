@extends('layouts.app')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="container">


<div class="card card-default">
    <div class="card-header">
        {{isset($post)?'Edit Post':'Create Post'}}
        </div>
    <div class="card-body">

@if($errors->any())

<div class="alert alerr-danger">

<ul class="list-group">
    @foreach ($errors->all() as $error)

<li class="list-group-item text-danger">{{$error}}</li>

    @endforeach

</ul>

</div>


@endif

    <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            @if (isset($post))
            @method('PATCH')

            @endif

            <div class="form-group">
                <label for="title">Title</label>
            <input id="title" name="title" type="text" class="form-control" value="{{isset($post)?$post->title:''}}">
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control"    >{{isset($post)?$post->description:''}}</textarea>

            </div>

            <div class="form-group">
                <label for="content">Content</label>

                <input id="content" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
                 <trix-editor input="content"></trix-editor>


            </div>

            <div class="form-group">
                <label for="published_at">Published at</label>
            <input id="published_at" name="published_at" type="text" class="form-control" value="{{isset($post)?$post->published_at:''}}" >
            </div>
            @if (isset($post))
            <div class="form-group">
                <img src="{{asset('storage/'.$post->image)}}" style="width:100%" alt="">
            </div>

            @endif
            <div class="form-group">
                <label for="image">Image</label>
            <input id="image" name="image" type="file" class="form-control" >
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">

                    @foreach ($categories as $category)
                    <option value="{{$category->id}}"

                        @if (isset($post))

                        @if ($category->id==$post->category_id)
                        selected

                        @endif

                        @endif

                        >{{$category->name}}</option>
                    @endforeach

                </select>
            </div>

            @if ($tags->count()>0)
            <div class="form-group">
                <label for="tags">Tags</label>


                <select name="tags[]" id="tags" class="form-control tag-selector" multiple>

                    @foreach ($tags as $tag)
                    <option value="{{$tag->id}}"

                        @if (isset($post))

                        @if ($post->hasTag($tag->id))
                        selected

                        @endif

                        @endif

                        >{{$tag->name}}</option>
                    @endforeach

                </select>


                            </div>

                            @endif

            <div class="form-group">
                 <button class="btn btn-success">{{isset($post)?'Update Post':'Add Post'}}</button>
            </div>

        </form>

    </div>

</div>

</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>

flatpickr('#published_at',{
    enableTime:true
})

$(document).ready(function() {
    $('.tag-selector').select2();
});
</script>
@endsection
