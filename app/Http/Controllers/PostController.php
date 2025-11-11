<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Admin-only
    public function index()
    {
        $posts = Post::with('artist')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $artists = Artist::all();
        return view('admin.posts.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'artist_id' => 'required|exists:artists,id',
            'image' => 'nullable|url',
            'spotify' => 'nullable|url',
            'bandcamp' => 'nullable|url',
            'soundcloud' => 'nullable|url',
        ]);

        // $data['image'] = $data['image_url'] ?? null; // store URL instead of uploaded file
        // unset($data['image_url']);

        \App\Models\Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created!');
    }


    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted.');
    }


    public function edit(Post $post)
    {
        $artists = Artist::all();
        return view('admin.posts.edit', compact('post', 'artists'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'artist_id' => 'required|exists:artists,id',
            'image' => 'nullable|url',
            'spotify' => 'nullable|url',
            'bandcamp' => 'nullable|url',
            'soundcloud' => 'nullable|url',
        ]);

        // $data['image'] = $data['image_url'] ?? null;
        // unset($data['image_url']);

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated!');
    }

}
