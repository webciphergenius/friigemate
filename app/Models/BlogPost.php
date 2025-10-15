<?php

namespace App\Models;

use Firefly\FilamentBlog\Models\Post as BasePost;
use Illuminate\Support\Facades\Storage;

class BlogPost extends BasePost
{
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => 'string', // Cast enum to string for Filament compatibility
    ];

    /**
     * Override the foreign key for relationships
     */
    protected $foreignKey = 'post_id';

    /**
     * Override the categories relationship to use the correct foreign key
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            \Firefly\FilamentBlog\Models\Category::class,
            config('filamentblog.tables.prefix') . 'category_' . config('filamentblog.tables.prefix') . 'post',
            'post_id', // Use 'post_id' instead of 'blog_post_id'
            'category_id'
        );
    }

    /**
     * Override the tags relationship to use the correct foreign key
     */
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            \Firefly\FilamentBlog\Models\Tag::class,
            config('filamentblog.tables.prefix') . 'post_' . config('filamentblog.tables.prefix') . 'tag',
            'post_id', // Use 'post_id' instead of 'blog_post_id'
            'tag_id'
        );
    }

    /**
     * Override the SEO details relationship to use the correct foreign key
     */
    public function seoDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            \Firefly\FilamentBlog\Models\SeoDetail::class,
            'post_id', // Use 'post_id' instead of 'blog_post_id'
            'id'
        );
    }
    
    /**
     * Override the getForeignKey method to return the correct foreign key
     */
    public function getForeignKey(): string
    {
        return 'post_id';
    }

    /**
     * Override the comments relationship to use the correct foreign key
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            \Firefly\FilamentBlog\Models\Comment::class,
            'post_id', // Use 'post_id' instead of 'blog_post_id'
            'id'
        );
    }

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
        
        try {
            // Try to get the URL directly from Cloudflare disk
            // This works even if exists() fails due to eventual consistency
            $cloudflareUrl = Storage::disk($disk)->url($this->cover_photo_path);
            
            // If the path starts with any blog directory, assume it's on Cloudflare
            $blogDirectories = ['blog-images/', 'blog-feature-images/'];
            foreach ($blogDirectories as $directory) {
                if (str_starts_with($this->cover_photo_path, $directory)) {
                    return $cloudflareUrl;
                }
            }
        } catch (\Exception $e) {
            // If Cloudflare fails, continue to fallback methods
        }

        // Fallback to local storage for existing images
        try {
            if (Storage::disk('public')->exists($this->cover_photo_path)) {
                return asset('storage/' . $this->cover_photo_path);
            }
        } catch (\Exception $e) {
            // If local storage fails, continue
        }

        // Try Cloudflare URL generation as final fallback
        try {
            return Storage::disk($disk)->url($this->cover_photo_path);
        } catch (\Exception $e) {
            // Return the path as-is if all methods fail
            return $this->cover_photo_path;
        }
    }
}
