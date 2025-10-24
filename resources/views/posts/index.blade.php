@extends('layouts.app')
@section('title', 'All Posts')
@section('content')
<div class="center my-5 text-center">
    <a href="{{route('posts.create')}}" class= "btn btn-success">Create Post</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Posted by</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
      <th scope="col">Comments</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user? $post->user->name: 'user not found' }}</td>
        <td>{{ $post->human_readable_date }}</td>
        <td>
            <a href="{{ route('posts.show',[ 'post'=> $post['id'] ]) }}" class="btn btn-primary">View</a>
            <a href="{{ route('posts.edit', [ 'post' => $post['id'] ]) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('posts.destroy', ['post' => $post['id'] ]) }}?page={{request()->page ?? 1 }}" method="POST" style="display:inline-block;" >
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger delete-confirm">Delete</button>
            </form>
        </td>
        <td>
            <a href="{{route('comments.index', ['post'=>$post['id'] ]) }}" class="badge bg-info text-dark" >{{$post->comments->isEmpty()? 'not commented yet' : $post->comments->count()}}</a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}

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
