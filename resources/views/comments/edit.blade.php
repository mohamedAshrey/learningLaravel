@extends('layouts.app')
@section('title', 'update comment')
@section('content')
<form method="POST" action="{{route('comments.update',['comment'=>$comment->id ]) }}">
    @csrf
    @method('PUT')
  <div class="mb-3">
    <label for="comment" class="form-label">Comment</label>
    <input type="comment" class="form-control" id="comment" name = "content" value="{{$comment->content}}" required>
  </div>
  <div class="mb-3">
    <label for="user_id" class="form-label">Posted By</label>
    <select class="form-control" name="user_id" required>
      <option value="">Choose your username</option>
    @foreach ($users as $user)
        <option value="{{$user->id}}"{{$comment->user_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
    @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection