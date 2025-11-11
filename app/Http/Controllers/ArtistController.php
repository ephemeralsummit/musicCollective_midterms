<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = \App\Models\Artist::latest()->get();
        return view('admin.artists.index', compact('artists'));
    }


    public function show(Artist $artist)
    {
        $artist->load('posts');
        return view('artists.show', compact('artist'));
    }

    // Admin-only
    public function create()
    {
        return view('admin.artists.create');
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

        Artist::create($data);
        return redirect()->route('artists.index')->with('success', 'Artist created!');
    }

    public function destroy(Artist $artist)
    {
        if ($artist->image) {
            Storage::disk('public')->delete($artist->image);
        }
        $artist->delete();

        return redirect()->back()->with('success', 'Artist deleted.');
    }
    public function edit(\App\Models\Artist $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

    public function update(Request $request, \App\Models\Artist $artist)
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

        $artist->update($data);

        return redirect()->route('admin.artists.index')->with('success', 'Artist updated!');
    }

}
