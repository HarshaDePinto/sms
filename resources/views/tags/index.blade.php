@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex justify-content-end mb-2">
<a href="{{route('tags.create')}}" class="btn btn-success">Add Tags</a>
</div>

<div class="card card-default">
    <div class="card-header">Tags</div>
    <div class="card-body">
    <table class="table">
        <thead>
        <th>Name</th>
        <th>Post Count</th>
        <th></th>

        </thead>
        <tbody>

            @foreach ($tags as $tag)
            <tr>
        <td>{{$tag->name}}</td>
            <td>{{$tag->posts->count()}} </td>
            <td><a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm">Edit</a>

                <a href="" class="btn btn-danger btn-sm"  onclick="handleDelete({{$tag->id}})" data-toggle="modal" data-target="#deleteModal">Delete</a>

            </td>


    </tr>
            @endforeach

        </tbody>

    </table>

<form action="" method="POST" id="deleteTag">

    @csrf
    @method('DELETE')

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are You Sure To Delete?</p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No Go Back</button>
              <button type="submit" class="btn btn-danger">Yes Delete</button>
            </div>
          </div>
        </div>
      </div>



</form>



    </div>
</div>

</div>
@endsection

@section('scripts')
<script>
function handleDelete(id){

    var form = document.getElementById('deleteTag')
    form.action='/tags/'+id

}

</script>
@endsection
