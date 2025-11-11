@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Artists</h1>

<div class="grid grid-cols-3 gap-4">
    @foreach($artists as $artist)
    <div class="bg-white p-4 rounded shadow">
        @if($artist->image)
            <img src="{{ asset('storage/' . $artist->image) }}" class="w-full h-40 object-cover mb-2">
        @endif
        <h2 class="text-xl font-bold">{{ $artist->name }}</h2>
        <p class="text-gray-600">{{ Str::limit($artist->bio, 100) }}</p>
        <a href="{{ route('artists.show', $artist) }}" class="text-blue-600">View Artist</a>
    </div>
    @endforeach
</div>
@endsection
