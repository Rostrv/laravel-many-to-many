@extends('layouts.admin')

@section('content')

<h2>Edit {{$post->title}}</h2>
@include('partials.errors')
<form action="{{route('admin.posts.update', $post->id)}}" method="post" >
    @csrf
@method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="TitleHelper" value="{{old('title', $post->title)}}" placeholder="php article" >
        <small id="TitleHelper" class="text-muted">type post title</small>
    </div>
    
    <div class="form-group">
        <label for="category_id">Categories</label>
        <select class="form-control" name="category_id" id="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}" {{$category->id == old('category_id',$post->category ? $post->category_id : '') ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex">
        <div class="media">
            <img width="150px" src="{{$post->cover_image}}" alt="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="cover_image">Image</label>
            <input type="text" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" value="{{old('cover_image', $post->cover_image)}}" placeholder="insert image url">
            <small id="cove_imageHelper" class="text-muted">Insert image</small>
        </div>
    </div>
    <div class="form-group">
        <label for="Content">content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="4">{{old('content', $post->content)}}</textarea>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
@endsection