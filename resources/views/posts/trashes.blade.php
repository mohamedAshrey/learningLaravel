@extends('layouts.app');
@section('title', 'All Trashed Posts')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Posted by</th>
      <th scope="col">Created At</th>
      <th scope="col">Deleted At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>

        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user? $post->user->name: 'user not found' }}</td>
        <td>{{ $post->created_at->isoFormat('dddd, D/MM/YYYY') }}</td>
        <td>{{ $post->deleted_at->isoFormat('dddd, D/MM/YYYY') }}</td>
        <td>
            <form action="{{ route('trashes.restore',[ 'post'=> $post['id'] ]) }}" method="POST" style="display: inline-block" >
                @csrf
                <button type="submit" class="btn btn-primary ">Restore</button>
            </form>

            <form action="{{ route('trashes.force-delete', [ 'post' => $post['id'] ]) }}" method="post" style="display: inline-block">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger delete-confirm" >Force Delete</button>
            </form>
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
