@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    {{-- Title --}}
    <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

    {{-- Meta --}}
    <div class="text-gray-500 text-sm mb-6">
        By 
        <a href="{{ route('artists.show', $post->artist) }}" 
           class="font-semibold text-blue-600 hover:underline">
           {{ $post->artist->name }}
        </a>
        • Published {{ $post->created_at->format('M d, Y') }}
    </div>

    {{-- Image --}}
    @if($post->image)
        <div class="mb-6">
            <img 
                src="{{ $post->image }}" 
                alt="{{ $post->title }}" 
                class="w-full max-h-[500px] object-cover rounded-lg border"
            >
        </div>
    @endif

    {{-- Description --}}
    <div class="prose max-w-none text-gray-800 leading-relaxed mb-8">
        {!! nl2br(e($post->description)) !!}
    </div>

    {{-- 🎧 Music Links --}}
    @if($post->spotify || $post->bandcamp || $post->soundcloud)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-2">Listen on:</h3>
            <div class="flex items-center space-x-4">
                @if($post->spotify)
                    <a href="{{ $post->spotify }}" target="_blank" title="Spotify" class="text-green-500 hover:text-green-600">
                        <i class="fab fa-spotify text-2xl"></i>
                    </a>
                @endif
                @if($post->bandcamp)
                    <a href="{{ $post->bandcamp }}" target="_blank" title="Bandcamp" class="text-blue-700 hover:text-blue-800">
                        <i class="fab fa-bandcamp text-2xl"></i>
                    </a>
                @endif
                @if($post->soundcloud)
                    <a href="{{ $post->soundcloud }}" target="_blank" title="SoundCloud" class="text-orange-500 hover:text-orange-600">
                        <i class="fab fa-soundcloud text-2xl"></i>
                    </a>
                @endif
            </div>
        </div>
    @endif

    {{-- Artist Footer --}}
    <div class="pt-6 border-t border-gray-200 flex items-center space-x-4">
        <img 
            src="{{ $post->artist->image ?: 'https://via.placeholder.com/80' }}" 
            alt="{{ $post->artist->name }}" 
            class="w-16 h-16 rounded-full object-cover border"
        >
        <div>
            <h3 class="text-lg font-semibold">
                <a href="{{ route('artists.show', $post->artist) }}" class="hover:underline text-blue-700">
                    {{ $post->artist->name }}
                </a>
            </h3>
            <p class="text-sm text-gray-600 line-clamp-2">{{ $post->artist->bio ?: 'No bio available.' }}</p>
        </div>
    </div>
</div>
@endsection
