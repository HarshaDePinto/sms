@extends('layouts.app')

@section('content')
<div class="container">


<div class="card card-default">
    <div class="card-header">
        {{isset($tag)?'Edit Tag':'Add Tags'}}
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

    <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store')}}" method="POST">
            @csrf
            @if (isset($tag))
                @method('PATCH')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{isset($tag)?$tag->name:''}}">
            </div>

            <div class="form-group">
                 <button class="btn btn-success">{{isset($tag)?'Update Tag':'Add Tags'}}</button>
            </div>

        </form>

    </div>

</div>

</div>
@endsection
