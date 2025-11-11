@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Manage Artists</h1>

<a href="{{ route('admin.artists.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">New Artist</a>

<table class="w-full mt-4 border">
    <tr class="bg-gray-200 text-left">
        <th class="p-2">Name</th>
        <th class="p-2">Bio</th>
        <th class="p-2">Actions</th>
    </tr>
    @foreach($artists as $artist)
    <tr class="border-t">
        <td class="p-2 font-semibold">{{ $artist->name }}</td>
        <td class="p-2">{{ Str::limit($artist->bio, 100) }}</td>
        <td class="p-2">
            <a href="{{ route('admin.artists.edit', $artist) }}" class="text-blue-600 mr-2">Edit</a>

            <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" class="inline" onsubmit="return confirm('Delete this artist?');">
                @csrf @method('DELETE')
                <button class="text-red-600">Delete</button>
            </form>
        </td>

    </tr>
    @endforeach
</table>
@endsection
