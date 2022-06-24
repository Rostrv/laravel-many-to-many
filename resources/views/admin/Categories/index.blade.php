@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between py-4">
    <h1>All Categories</h1>
    <form action="" method="post" class="d-flex align-items-center">
      @csrf
      <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="add Category" aria-label="add Category" aria-describedby="button-addon2">
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
          @forelse ($ciccios as $ciccio)
          <tr>
            <td scope="row">{{$ciccio->id}}</td>
            <td>
              <form id="category-{{$ciccio->id}}" action="{{route('admin.categories.update', $ciccio->slug)}}" method="post">
                @csrf
                @method('PATCH')
                <input class="border-0 bg-transparent" type="text" name="name" value="{{$ciccio->name}}">
            </form>
            </td>
            <td>{{$ciccio->slug}}</td>
                        <td><span class="badge badge-info bg-light">{{count($ciccio->posts)}}</span></td>
            
            <td class="d-flex">
              
              <button form="category-{{$ciccio->id}}" type="submit" class="btn btn-primary">Update</button>  

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-ciccio-{{$ciccio->id}}">Delete</button>

              <div class="modal" tabindex="-1" id="delete-ciccio-{{$ciccio->id}}" aria-labelledby="modelTitle-{{$ciccio->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete ciccio</h5>
                      <button type="button" class="close" data-dismiss="modal" data-target aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{route('admin.categories.destroy', $ciccio->slug)}}" method="post">
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