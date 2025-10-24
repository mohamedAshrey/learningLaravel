@extends('layouts.app');
@section('title', $post->title)
@section('content')
<div class="card">
  <div class="card-header">
    Post info
  </div>
    <div class="card-body">

      <h5 class="card-title"><strong>Title</strong>: {{ $post->title}}</h5>
      <p class="card-text"><strong>Description</strong>: {{ $post->description}}</p>
      <p class="card-text"><strong>Created At</strong>: {{ $post->created_at->format('l jS \o\f F Y h:i:s A')}}</p>
      <p class="card-text"><strong>Updated At</strong>: {{ $post->updated_at ? $post->updated_at->format('l jS \o\f F Y h:i:s A') : 'Not updated yet'}}</p>
    </div>
</div>
<br>
<div class="card">
  <div class="card-header">
    Post creator info
  </div>
  @if($post->user)
    <div class="card-body">
      <h5 class="card-title"><strong>Name</strong>: {{ $post->user->name}}</h5>
      <p class="card-text"><strong>Email</strong>: {{ $post->user->email}}</p>
      <p class="card-text"><strong>Created At</strong>: {{ $post->user->created_at->format('l jS \o\f F Y h:i:s A')}}</p>
    </div>
  @else
    <div class="card-body">
      <h5 class="card-title">User info not available</h5>
  @endif
</div>
<br>
    <a href="{{route ('posts.index')}}" class="btn btn-primary">Go All Posts</a>

@endsection

