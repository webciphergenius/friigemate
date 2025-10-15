<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;

class FixBlogImages extends Command
{
    protected $signature = 'fix:blog-images';
    protected $description = 'Fix blog image URLs to use local storage';

    public function handle()
    {
        $this->info('🔧 Fixing blog image URLs...');
        
        try {
            $posts = BlogPost::all();
            $this->info("📝 Found {$posts->count()} blog posts");
            
            foreach ($posts as $post) {
                $this->line("Processing: {$post->title}");
                
                // Check if the current path is a Cloudflare R2 URL
                if (str_contains($post->cover_photo_path, 'r2.dev') || str_contains($post->cover_photo_path, 'cloudflarestorage.com')) {
                    // Extract filename from the URL
                    $filename = basename($post->cover_photo_path);
                    
                    // Check if file exists in local storage
                    $localPath = "blog-images/{$filename}";
                    if (Storage::disk('public')->exists($localPath)) {
                        $post->cover_photo_path = $localPath;
                        $post->save();
                        $this->info("  ✅ Updated to local path: {$localPath}");
                    } else {
                        // Try alternative paths
                        $altPaths = [
                            "images/{$filename}",
                            "blog/{$filename}",
                            $filename
                        ];
                        
                        $found = false;
                        foreach ($altPaths as $altPath) {
                            if (Storage::disk('public')->exists($altPath)) {
                                $post->cover_photo_path = $altPath;
                                $post->save();
                                $this->info("  ✅ Updated to local path: {$altPath}");
                                $found = true;
                                break;
                            }
                        }
                        
                        if (!$found) {
                            $this->warn("  ⚠️ Local file not found for: {$filename}");
                        }
                    }
                } else {
                    $this->line("  ℹ️ Already using local path: {$post->cover_photo_path}");
                }
            }
            
            $this->info('🎉 Blog image URLs fixed!');
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}
