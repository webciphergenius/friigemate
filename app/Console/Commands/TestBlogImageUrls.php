<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BlogPost;

class TestBlogImageUrls extends Command
{
    protected $signature = 'test:blog-image-urls';
    protected $description = 'Test blog image URLs to see what\'s being returned';

    public function handle()
    {
        $this->info('🧪 Testing Blog Image URLs...');
        
        try {
            $posts = BlogPost::where('status', 'published')->get();
            $this->info("📝 Found {$posts->count()} published posts");
            
            foreach ($posts as $post) {
                $this->line("Post: {$post->title}");
                $this->line("  Raw cover_photo_path: {$post->cover_photo_path}");
                $this->line("  featurePhoto accessor: {$post->featurePhoto}");
                $this->line("  ---");
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}
