@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Edit Artist</h1>

<form action="{{ route('admin.artists.update', $artist) }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-lg">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $artist->name) }}" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="block font-semibold mb-1">Bio</label>
        <textarea name="bio" class="w-full border p-2 rounded" rows="4">{{ old('bio', $artist->bio) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1">Image URL (optional)</label>

        @if($artist->image)
            <img 
                src="{{ $artist->image }}" 
                alt="{{ $artist->name }}" 
                class="h-32 mb-2 rounded border"
            >
        @endif

        <input 
            type="url" 
            name="image" 
            value="{{ old('image', $artist->image) }}" 
            class="border p-2 w-full" 
            placeholder="https://example.com/artist-image.jpg"
        >
    </div>

    <div>
        <label class="block font-semibold mb-1">Twitter (optional)</label>
        <input type="url" name="twitter" value="{{ old('twitter', $artist->twitter) }}" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold mb-1">Instagram (optional)</label>
        <input type="url" name="instagram" value="{{ old('instagram', $artist->instagram) }}" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold mb-1">Facebook (optional)</label>
        <input type="url" name="facebook" value="{{ old('facebook', $artist->facebook) }}" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold mb-1">Website (optional)</label>
        <input type="url" name="website" value="{{ old('website', $artist->website) }}" class="border p-2 w-full">
    </div>


    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Artist</button>
</form>
@endsection
