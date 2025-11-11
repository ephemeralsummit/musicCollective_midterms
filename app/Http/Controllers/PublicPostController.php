<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Artist;

class PublicPostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('artist')->latest();

        // Search by title or description
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by artist
        if ($artistId = $request->input('artist_id')) {
            $query->where('artist_id', $artistId);
        }

        // Paginate results (you can adjust per page)
        $posts = $query->paginate(9)->appends($request->query());

        // Get all artists for the dropdown
        $artists = Artist::orderBy('name')->get();

        return view('posts.index', compact('posts', 'artists'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}