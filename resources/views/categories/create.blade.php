@extends('layouts.app')

@section('content')
<div class="container">


<div class="card card-default">
    <div class="card-header">
        {{isset($category)?'Edit Category':'Add Categories'}}
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

    <form action="{{isset($category)?route('categories.update',$category->id):route('categories.store')}}" method="POST">
            @csrf
            @if (isset($category))
                @method('PATCH')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{isset($category)?$category->name:''}}">
            </div>

            <div class="form-group">
                 <button class="btn btn-success">{{isset($category)?'Update Category':'Add Categories'}}</button>
            </div>

        </form>

    </div>

</div>

</div>
@endsection
