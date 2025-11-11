@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Create New Post</h1>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label>Artist</label>
        <select name="artist_id" class="w-full border p-2">
            @foreach($artists as $artist)
                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Title</label>
        <input type="text" name="title" class="w-full border p-2" required>
    </div>

    <div>
        <label>Description</label>
        <textarea name="description" class="w-full border p-2" required></textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1">Image URL (optional)</label>
        <input type="url" name="image_url" value="{{ old('image_url', $post->image ?? '') }}" class="w-full border p-2 rounded" placeholder="https://example.com/image.jpg">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold mb-1">Spotify Link</label>
            <input type="url" name="spotify" class="w-full border p-2 rounded" placeholder="https://open.spotify.com/..." value="{{ old('spotify') }}">
        </div>
        <div>
            <label class="block font-semibold mb-1">Bandcamp Link</label>
            <input type="url" name="bandcamp" class="w-full border p-2 rounded" placeholder="https://bandcamp.com/..." value="{{ old('bandcamp') }}">
        </div>
        <div>
            <label class="block font-semibold mb-1">SoundCloud Link</label>
            <input type="url" name="soundcloud" class="w-full border p-2 rounded" placeholder="https://soundcloud.com/..." value="{{ old('soundcloud') }}">
        </div>
    </div>



    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Publish</button>
</form>
@endsection
