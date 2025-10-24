@extends('layouts.app');
@section('title', 'Comments for Post: ' . $post->title)
@section('content')
<div class="center my-5 text-center">
    <a href="{{route('comments.create', ['post'=> $post->id])}}" class= "btn btn-success">Create Comment</a>
</div>

@if($comments->isEmpty())
    <div class="alert alert-info" role="alert">
        No comments found for this post.
    </div>
@else
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Comment</th>
      <th scope="col">Commented by</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($comments as $comment)
    <tr>
        <th scope="row">{{ $comment->id }}</th>
        <td>{{ $comment->content }}</td>
        <td>{{ $comment->user? $comment->user->name: 'user not found' }}</td>
        <td>{{ $comment->created_at->isoFormat('dddd, D/MM/YYYY') }}</td>
        <td>
            <a href="{{route('comments.edit', ['comment'=>$comment->id]) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('comments.destroy', $comment->id )}}" method="POST" style="display:inline-block;" >
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger delete-confirm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $comments->onEachSide(1)->links('pagination::bootstrap-5') }}
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-confirm');

        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                if (confirm('Are you sure you want to delete this post?')) {
                    btn.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
