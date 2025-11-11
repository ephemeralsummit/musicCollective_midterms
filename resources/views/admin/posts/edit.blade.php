@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Edit Post</h1>

<form action="{{ route('admin.posts.update', $post) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    {{-- Artist --}}
    <div>
        <label class="block font-semibold mb-1">Artist</label>
        <select name="artist_id" class="w-full border p-2 rounded">
            @foreach($artists as $artist)
                <option value="{{ $artist->id }}" {{ $artist->id == $post->artist_id ? 'selected' : '' }}>
                    {{ $artist->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Title --}}
    <div>
        <label class="block font-semibold mb-1">Title</label>
        <input 
            type="text" 
            name="title" 
            value="{{ old('title', $post->title) }}" 
            class="w-full border p-2 rounded" 
            required
        >
    </div>

    {{-- Description --}}
    <div>
        <label class="block font-semibold mb-1">Description</label>
        <textarea 
            name="description" 
            class="w-full border p-2 rounded" 
            required
        >{{ old('description', $post->description) }}</textarea>
    </div>

    {{-- Image URL --}}
    <div>
        <label class="block font-semibold mb-1">Image URL (optional)</label>
        <input 
            type="url" 
            name="image" 
            value="{{ old('image', $post->image) }}" 
            class="w-full border p-2 rounded" 
            placeholder="https://example.com/image.jpg"
        >

        @if($post->image)
            <div class="mt-3">
                <p class="text-sm text-gray-600 mb-1">Current Image Preview:</p>
                <img 
                    src="{{ $post->image }}" 
                    alt="{{ $post->title }}" 
                    class="w-48 h-48 object-cover rounded border"
                >
            </div>
        @endif
    </div>

    {{-- Music Links --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold mb-1">Spotify Link</label>
            <input 
                type="url" 
                name="spotify" 
                class="w-full border p-2 rounded" 
                value="{{ old('spotify', $post->spotify) }}" 
                placeholder="https://open.spotify.com/..."
            >
        </div>
        <div>
            <label class="block font-semibold mb-1">Bandcamp Link</label>
            <input 
                type="url" 
                name="bandcamp" 
                class="w-full border p-2 rounded" 
                value="{{ old('bandcamp', $post->bandcamp) }}" 
                placeholder="https://bandcamp.com/..."
            >
        </div>
        <div>
            <label class="block font-semibold mb-1">SoundCloud Link</label>
            <input 
                type="url" 
                name="soundcloud" 
                class="w-full border p-2 rounded" 
                value="{{ old('soundcloud', $post->soundcloud) }}" 
                placeholder="https://soundcloud.com/..."
            >
        </div>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Update Post
    </button>
</form>
@endsection
