@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Manage Posts</h1>
<a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">New Post</a>

<table class="w-full mt-4 border">
    <tr class="bg-gray-200 text-left">
        <th class="p-2">Title</th>
        <th class="p-2">Artist</th>
        <th class="p-2">Actions</th>
    </tr>
    @foreach($posts as $post)
    <tr class="border-t">
        <td class="p-2">{{ $post->title }}</td>
        <td class="p-2">{{ $post->artist->name }}</td>
        <td class="p-2">
            <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 mr-2">Edit</a>

            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Delete this post?');">
                @csrf @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
