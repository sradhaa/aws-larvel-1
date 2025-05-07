

@extends('layouts.app')
@section('title' , 'Blog Post Lists')

@section('content')
@forelse($posts as $key=>$post)

<h3><a href="{{ route('posts.show',['post'=>$post->id])}}">{{$post->id}} {{$post->title}} {{$post->cotent}}</a></h3>
@if($post->comments_count)
<p>{{$post->comments_count}} comments</p>
@else
<p>No Comment Found</p>
@endif
<div class="mb-3">
<a href="{{ route('posts.edit',['post' => $post->id])}}" class="btn btn-primary">Edit</a>
<form class="d-inline" action="{{ route('posts.destroy',['post'=>$post->id])}}" method="POST">
@csrf
@method('DELETE')
<input type="submit" value="Delete"  class="btn btn-danger">
</form>
</div>
@empty
    <h1>No posts found</h1>
@endforelse
@endsection