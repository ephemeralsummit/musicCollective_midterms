@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Latest Posts</h1>

{{-- Search & Filter Form --}}
<form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row md:items-center gap-3 mb-6">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}" 
        placeholder="Search by title or description..." 
        class="border px-4 py-2 rounded w-full md:w-1/2"
    >

    <select 
        name="artist_id" 
        class="border px-4 py-2 rounded w-full md:w-1/4"
    >
        <option value="">All Artists</option>
        @foreach($artists as $artist)
            <option value="{{ $artist->id }}" {{ request('artist_id') == $artist->id ? 'selected' : '' }}>
                {{ $artist->name }}
            </option>
        @endforeach
    </select>

    <div class="flex gap-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
        <a href="{{ route('home') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Reset</a>
    </div>
</form>

{{-- Post Grid --}}
@if($posts->isEmpty())
    <p class="text-gray-600">No posts found matching your criteria.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
                @if($post->image)
                    <img 
                        src="{{ $post->image }}" 
                        alt="{{ $post->title }}" 
                        class="w-full h-80 object-cover rounded-t"
                    >
                @else
                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-t">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700 mb-3">{{ Str::limit($post->description, 120) }}</p>

                    <div class="text-sm text-gray-500 mb-2">
                        by <span class="font-semibold">{{ $post->artist->name }}</span>
                    </div>

                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline">Read More →</a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endif
@endsection
