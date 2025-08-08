<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Blog::query();

        // Search filter
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");
        }

        // Hashtag filter
        if ($tag = $request->input('tag')) {
            $query->where('hashtags', 'like', "%$tag%");
        }

        $blogs = $query->latest()->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', compact('blog'));
    }
}
