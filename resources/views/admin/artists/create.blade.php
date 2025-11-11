@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Add New Artist</h1>

<form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-lg">
    @csrf

    <div>
        <label class="block font-semibold mb-1">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="block font-semibold mb-1">Bio</label>
        <textarea name="bio" class="w-full border p-2 rounded" rows="4"></textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1">Image URL (optional)</label>
        <input 
            type="url" 
            name="image" 
            class="border p-2 w-full" 
            placeholder="https://example.com/artist-image.jpg"
        >
    </div>

    <div>
        <label class="block font-semibold mb-1">Twitter (optional)</label>
        <input type="url" name="twitter" class="border p-2 w-full" placeholder="https://twitter.com/username">
    </div>

    <div>
        <label class="block font-semibold mb-1">Instagram (optional)</label>
        <input type="url" name="instagram" class="border p-2 w-full" placeholder="https://instagram.com/username">
    </div>

    <div>
        <label class="block font-semibold mb-1">Facebook (optional)</label>
        <input type="url" name="facebook" class="border p-2 w-full" placeholder="https://facebook.com/username">
    </div>

    <div>
        <label class="block font-semibold mb-1">Website (optional)</label>
        <input type="url" name="website" class="border p-2 w-full" placeholder="https://artistwebsite.com">
    </div>


    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Artist</button>
</form>
@endsection
