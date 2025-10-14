<?php

namespace App\Models;

use Firefly\FilamentBlog\Models\Post as BasePost;
use Illuminate\Support\Facades\Storage;

class BlogPost extends BasePost
{
    /**
     * Get the feature photo URL with proper disk handling
     */
    protected function getFeaturePhotoAttribute()
    {
        if (!$this->cover_photo_path) {
            return null;
        }

        // Check if it's already a full URL
        if (filter_var($this->cover_photo_path, FILTER_VALIDATE_URL)) {
            return $this->cover_photo_path;
        }

        // Use Cloudflare disk for new uploads
        $disk = config('cloudflare.blog.disk', 'cloudflare');
        
        if (Storage::disk($disk)->exists($this->cover_photo_path)) {
            return Storage::disk($disk)->url($this->cover_photo_path);
        }

        // Fallback to local storage for existing images
        if (Storage::disk('public')->exists($this->cover_photo_path)) {
            return asset('storage/' . $this->cover_photo_path);
        }

        // Return the path as-is if no storage method works
        return $this->cover_photo_path;
    }
}
