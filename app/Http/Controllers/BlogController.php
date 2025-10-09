<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function getLatestPosts()
    {
        try {
            // Get the table prefix from config
            $prefix = config('filamentblog.tables.prefix');
            
            // Fetch latest 3 published blog posts
            $posts = DB::table($prefix . 'posts')
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();

            // Transform the data to match the frontend needs
            $formattedPosts = $posts->map(function ($post) {
                // Ensure the cover photo path is a full URL
                $coverPhotoUrl = $post->cover_photo_path;
                if (!str_starts_with($coverPhotoUrl, 'http')) {
                    // If it's a relative path, prepend the storage URL
                    $coverPhotoUrl = asset('storage/' . $post->cover_photo_path);
                }
                
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'sub_title' => $post->sub_title,
                    'slug' => $post->slug,
                    'body' => $post->body,
                    'cover_photo_path' => $coverPhotoUrl,
                    'photo_alt_text' => $post->photo_alt_text,
                    'published_at' => $post->published_at,
                    'excerpt' => $this->getExcerpt($post->body, 150), // Get first 150 characters
                    'formatted_date' => $this->formatDate($post->published_at),
                ];
            });

            return response()->json([
                'success' => true,
                'posts' => $formattedPosts
            ]);

        } catch (\Exception $e) {
            \Log::error('Blog posts fetch error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch blog posts',
                'posts' => []
            ], 500);
        }
    }

    private function getExcerpt($body, $length = 150)
    {
        // Remove HTML tags and get plain text
        $text = strip_tags($body);
        
        // If text is shorter than desired length, return it
        if (strlen($text) <= $length) {
            return $text;
        }
        
        // Truncate and add ellipsis
        return substr($text, 0, $length) . '...';
    }

    private function formatDate($date)
    {
        if (!$date) {
            return date('F d, Y');
        }
        
        return \Carbon\Carbon::parse($date)->format('F d, Y');
    }
}
