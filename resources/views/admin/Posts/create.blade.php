@extends('layouts.admin')

@section('content')

<h2>Create a new post</h2>
@include('partials.errors')

<form action="{{route('admin.posts.store')}}" method="post" >
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="TitleHelper" value="{{old('title')}}" placeholder="php article" >
        <small id="TitleHelper" class="text-muted">type post title</small>
    </div>
    <div class="form-group">
        <label for="category_id">Categories</label>
        <select class="form-control" name="category_id" id="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="cover_image">Image</label>
        <input type="text" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" value="{{old('cover_image')}}" placeholder="insert image url">
        <small id="cove_imageHelper" class="text-muted">Insert image</small>
    </div>
    <div class="form-group">
        <label for="Content">content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="" id="" rows="4">{{old('content')}}</textarea>
        <button type="submit" class="btn btn-primary">Add post</button>
    </div>
</form>
@endsection