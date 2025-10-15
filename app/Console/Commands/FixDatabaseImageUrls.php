<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixDatabaseImageUrls extends Command
{
    protected $signature = 'fix:database-image-urls';
    protected $description = 'Fix database image URLs to use Cloudflare R2';

    public function handle()
    {
        $this->info('🔧 Fixing database image URLs...');
        
        try {
            // Update all blog posts to use Cloudflare R2 URLs
            $posts = DB::table('fblog_posts')->get();
            $this->info("📝 Found {$posts->count()} blog posts");
            
            foreach ($posts as $post) {
                $oldPath = $post->cover_photo_path;
                
                // If it's already a Cloudflare URL, skip
                if (str_contains($oldPath, 'r2.dev') || str_contains($oldPath, 'cloudflarestorage.com')) {
                    $this->line("  ✅ Already using Cloudflare: {$post->title}");
                    continue;
                }
                
                // Convert local storage path to Cloudflare R2 URL
                $newPath = null;
                if (str_contains($oldPath, 'blog-images/')) {
                    $filename = basename($oldPath);
                    $newPath = "https://pub-b4963756717f44099dd34505f849c117.r2.dev/blog-images/{$filename}";
                } elseif (str_contains($oldPath, 'blog-feature-images/')) {
                    $filename = basename($oldPath);
                    $newPath = "https://pub-b4963756717f44099dd34505f849c117.r2.dev/blog-feature-images/{$filename}";
                }
                
                if ($newPath) {
                    DB::table('fblog_posts')
                        ->where('id', $post->id)
                        ->update(['cover_photo_path' => $newPath]);
                    
                    $this->line("  🔄 Updated: {$post->title}");
                    $this->line("    From: {$oldPath}");
                    $this->line("    To: {$newPath}");
                } else {
                    $this->warn("  ⚠️ Could not convert: {$post->title} - {$oldPath}");
                }
            }
            
            $this->info('🎉 Database image URLs fixed!');
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}
