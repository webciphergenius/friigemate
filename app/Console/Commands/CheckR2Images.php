<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckR2Images extends Command
{
    protected $signature = 'check:r2-images';
    protected $description = 'Check what images are in R2 bucket';

    public function handle()
    {
        $this->info('🔍 Checking R2 bucket for images...');
        
        try {
            $disk = Storage::disk('cloudflare');
            
            // List all files in the bucket
            $files = $disk->allFiles();
            $this->info("📁 Total files in R2: " . count($files));
            
            // List blog-related files
            $blogFiles = array_filter($files, function($file) {
                return str_contains($file, 'blog') || str_contains($file, 'news');
            });
            
            $this->info("📝 Blog-related files: " . count($blogFiles));
            foreach ($blogFiles as $file) {
                $this->line("   - {$file}");
            }
            
            // Check specific files mentioned in API
            $specificFiles = [
                'blog-feature-images/news03.png',
                'blog-feature-images/news02.png',
                'blog-images/news03.png',
                'blog-images/news02.png'
            ];
            
            $this->info("🔍 Checking specific files:");
            foreach ($specificFiles as $file) {
                $exists = $disk->exists($file);
                $status = $exists ? '✅ EXISTS' : '❌ NOT FOUND';
                $this->line("   {$file}: {$status}");
                
                if ($exists) {
                    $url = $disk->url($file);
                    $this->line("      URL: {$url}");
                }
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}
