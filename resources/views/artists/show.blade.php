@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-md md:flex md:space-x-8">
    {{-- Left Column: Artist Profile --}}
    <div class="md:w-1/3 text-center mb-6 md:mb-0">
        <img 
            src="{{ $artist->image ?: 'https://via.placeholder.com/150' }}" 
            alt="{{ $artist->name }}" 
            class="w-40 h-40 mx-auto rounded-full object-cover mb-4 border"
        >

        <h1 class="text-2xl font-bold">{{ $artist->name }}</h1>
        @if($artist->email)
            <p class="text-gray-500 text-sm">{{ $artist->email }}</p>
        @endif
        <p class="mt-3 text-gray-700">{{ $artist->bio ?: 'No bio available.' }}</p>
        
        {{-- 🔗 Social Links --}}
        <div class="mt-4 flex justify-center space-x-3">
            @if($artist->twitter)
                <a href="{{ $artist->twitter }}" target="_blank" class="text-blue-500 hover:text-blue-600" title="Twitter">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
            @endif
            @if($artist->instagram)
                <a href="{{ $artist->instagram }}" target="_blank" class="text-pink-500 hover:text-pink-600" title="Instagram">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
            @endif
            @if($artist->facebook)
                <a href="{{ $artist->facebook }}" target="_blank" class="text-blue-700 hover:text-blue-800" title="Facebook">
                    <i class="fab fa-facebook text-xl"></i>
                </a>
            @endif
            @if($artist->website)
                <a href="{{ $artist->website }}" target="_blank" class="text-blue-700 hover:text-blue-900" title="Website">
                    <i class="fa-brands fa-bluesky text-xl"></i>
                </a>
            @endif
        </div>

        {{-- Admin Actions (optional) --}}
        @auth
        <div class="mt-5 space-x-2">
            <a href="{{ route('admin.artists.edit', $artist) }}" 
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
               Edit Artist
            </a>
            <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Are you sure you want to delete this artist?')" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Delete
                </button>
            </form>
        </div>
        @endauth
    </div>

    {{-- Right Column: Artist's Posts --}}
    <div class="md:w-2/3">
        <h2 class="text-2xl font-semibold mb-4">Posts by {{ $artist->name }}</h2>
        <hr class="mb-4">

        @if($artist->posts->isEmpty())
            <p class="text-gray-500">No posts found for this artist.</p>
        @else
            <div class="space-y-4">
                @foreach($artist->posts as $post)
                    <div class="border rounded-lg p-4 hover:shadow transition">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-gray-700 mb-2">{{ Str::limit($post->description, 150) }}</p>
                        <p class="text-sm text-gray-500">
                            Published: {{ $post->created_at->format('M d, Y') }}
                        </p>
                        <a href="{{ route('posts.show', $post) }}" 
                           class="inline-block mt-2 text-sm text-blue-600 hover:underline">
                            View Post →
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
