@extends('layouts.app')
@section('title', 'Create Post')
@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="title" class="form-control" id="title" name = "title" required>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="description" class="form-control" id="description" name = "description" required>
  </div>
  <div class="mb-3">
    <label for="user_id" class="form-label">Posted By</label>
    <select class="form-control" name="user_id" required>
      <option value="">Choose your username</option>
    @foreach ($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection