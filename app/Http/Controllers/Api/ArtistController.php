<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        return Artist::all();
    }

    public function show(Artist $artist)
    {
        return $artist;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'website' => 'nullable|url',
        ]);

        $artist = Artist::create($data);
        return response()->json($artist, 201);
    }

    public function update(Request $request, Artist $artist)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'website' => 'nullable|url',
        ]);

        $artist->update($data);
        return $artist;
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response()->json(['message' => 'Artist deleted successfully']);
    }
}
