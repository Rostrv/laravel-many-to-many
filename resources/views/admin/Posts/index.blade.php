@extends('layouts.admin')
Lato Admin
@section('content')
<div class="container">
  <div class="d-flex justify-content-between py-4">
    <h1>All Posts</h1>
    <div><a href="{{route('admin.posts.create')}}" class="btn btn-primary">Add post</a></div>
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
            <th>TITLE</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Cover Image</th>
            <th>Actions</th>

          </tr>
        </thead>
        <tbody>
          @forelse ($posts as $post)
          <tr>
            <td scope="row">{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>Category: {{ $post->category ? $post->category->name : 'Uncategorized'}}</td>
            <td>{{$post->slug}}</td>
            <td><img width ="150px"src="{{$post->cover_image}}" alt="Cover image {{$post->title}}"></td>
            <td class="d-flex">
              <a class="btn btn-primary" href="{{route('admin.posts.show', $post->id)}}">View</a>
              <a class="btn btn-secondary" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>  

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post-{{$post->id}}">Delete</button>

              <div class="modal" tabindex="-1" id="delete-post-{{$post->id}}" aria-labelledby="modelTitle-{{$post->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete post</h5>
                      <button type="button" class="close" data-dismiss="modal" data-target aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
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
            <td scope="row">No Posts! Create your post. <a href="#">Create post</a></td>
            
          </tr>
          @endforelse
        </tbody>
      </table>


</div>
@endsection