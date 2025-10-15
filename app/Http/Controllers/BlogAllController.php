<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Http\Controllers\BlogController;

class BlogAllController extends Controller
{
    public function index()
    {
        try {
            // Get published posts with pagination
            $posts = BlogPost::where('status', 'published')
                ->with(['user', 'categories', 'tags'])
                ->orderBy('published_at', 'desc')
                ->paginate(12);

            return view('vendor.filament-blog.blogs.all-post', compact('posts'));
        } catch (\Exception $e) {
            \Log::error('Blog all posts error: ' . $e->getMessage());
            return view('vendor.filament-blog.blogs.all-post', ['posts' => collect([])]);
        }
    }
}
