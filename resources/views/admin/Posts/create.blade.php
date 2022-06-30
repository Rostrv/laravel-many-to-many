@extends('layouts.admin')

@section('content')

<h2>Create a new post</h2>
@include('partials.errors')

<form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data" >
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
        <label for="tags">Tags</label>
        <select multiple class="form-control" name="tags[]" id="tags">
            @if($tags)
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            @endif
        </select>
        </div>
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    <div class="form-group">
        <label for="cover_image">Image</label>
        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="insert image">
        <small id="cove_imageHelper" class="text-muted">Insert image</small>
    </div>
    <div class="form-group">
        <label for="Content">content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="" id="" rows="4">{{old('content')}}</textarea>
        <button type="submit" class="btn btn-primary">Add post</button>
    </div>
</form>
@endsection