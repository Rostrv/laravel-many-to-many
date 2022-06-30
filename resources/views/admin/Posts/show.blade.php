@extends('layouts.admin')
@section('content')

<img src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}}">
<h1>{{$post->title}}</h1>
<div class="content">{{$post->content}}</div>
<div>Category: {{ $post->category ? $post->category->name : 'Uncategorized'}}</div>
<div class="tags">
    tags:
    @if(count($post->tags) > 0) 
        @foreach($post->tags as $tag)
            {{$tag->name}}
        @endforeach
    @else 
        <span>No tags</span>

    @endif

</div>
@endsection