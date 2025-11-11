<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Artist;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('artist')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($artistId = $request->input('artist_id')) {
            $query->where('artist_id', $artistId);
        }

        $posts = $query->paginate(10);

        return response()->json($posts);
    }


    public function show(Post $post)
    {
        return $post->load('artist');
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

        $post = Post::create($data);
        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'artist_id' => 'sometimes|required|exists:artists,id',
            'image' => 'nullable|url',
            'spotify' => 'nullable|url',
            'bandcamp' => 'nullable|url',
            'soundcloud' => 'nullable|url',
        ]);

        $post->update($data);
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}

