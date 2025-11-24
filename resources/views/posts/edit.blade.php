@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
<form method="POST" action="{{ route('posts.update', ['post' => $post->id] )}}">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name = "title" value="{{$post->title}}"   >
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="description" class="form-control" id="description" name = "description" value="{{$post->description}}" >
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">Posted By</label>
    <select class="form-control" name="user_id" >
        <option value="">Choose your username</option>x
    @foreach ($users as $user)
        <option value="{{$user->id}}" {{ $post->user_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
    @endforeach
    </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
