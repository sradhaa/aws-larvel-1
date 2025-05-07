@extends('layouts.app')
@section('title' , $post->title)

@section('content')
<h1>Blog post details</h1>
<h2>Blog Id {{$post->id}}</h2>
<h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    <p>Added {{ $post->created_at->diffForHumans() }}</p>
    @if (now()->diffInMinutes($post->created_at) < 5 )
        <strong>New!</strong>
    @endif
@endsection