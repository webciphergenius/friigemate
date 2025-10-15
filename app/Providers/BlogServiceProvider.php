<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Firefly\FilamentBlog\Models\Post;
use App\Models\BlogPost;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind our custom BlogPost model
        $this->app->bind(Post::class, BlogPost::class);
        
        // Also bind it as a singleton to ensure it's used everywhere
        $this->app->singleton(Post::class, function () {
            return new BlogPost();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register custom blog post resource to override default
        Filament::registerResources([
            \App\Filament\Resources\BlogPostResource::class,
        ]);
    }
}
