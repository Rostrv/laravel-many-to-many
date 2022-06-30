@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between py-4">
    <h1>All Tags</h1>
    <form action="" method="post" class="d-flex align-items-center">
      @csrf
      <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="add Tag" aria-label="add Category" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add</button>
      </div>
  </form>
  </div>
  @if (session('message'))
  <div class="alert alert-success">
      {{ session('message') }}
  </div>
  @endif
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
          <tr>
            <th>ID</th>
            <th>Slug</th> 
            <th>Name</th>
            <th>Posts count</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tags as $tag)
          <tr>
            <td scope="row">{{$tag->id}}</td>
            <td>
              <form id="category-{{$tag->id}}" action="{{route('admin.tags.update', $tag->slug)}}" method="post">
                @csrf
                @method('PATCH')
                <input class="border-0 bg-transparent" type="text" name="name" value="{{$tag->name}}">
            </form>
            </td>
            <td>{{$tag->slug}}</td>
                        <td><span class="badge badge-info bg-light">{{count($tag->posts)}}</span></td>
            
            <td class="d-flex">
              
              <button form="category-{{$tag->id}}" type="submit" class="btn btn-primary">Update</button>  

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-tag-{{$tag->id}}">Delete</button>

              <div class="modal" tabindex="-1" id="delete-tag-{{$tag->id}}" aria-labelledby="modelTitle-{{$tag->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete tag</h5>
                      <button type="button" class="close" data-dismiss="modal" data-target aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{route('admin.tags.destroy', $tag->slug)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


            </td>
          </tr>
          @empty
          <tr>
            <td scope="row">No ciccios! Create your ciccio. <a href="#">Create ciccio</a></td>
            
          </tr>
          @endforelse
        </tbody>
      </table>


</div>
@endsection