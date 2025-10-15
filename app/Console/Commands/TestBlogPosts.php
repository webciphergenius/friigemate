<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BlogPost;
use Illuminate\Support\Facades\DB;

class TestBlogPosts extends Command
{
    protected $signature = 'test:blog-posts';
    protected $description = 'Test blog posts functionality';

    public function handle()
    {
        $this->info('🧪 Testing Blog Posts...');
        
        try {
            // Test 1: Check if we can connect to database
            $this->info('1. Testing database connection...');
            $connection = DB::connection()->getPdo();
            $this->info('✅ Database connection successful');
            
            // Test 2: Check table exists
            $this->info('2. Checking if fblog_posts table exists...');
            $tableExists = DB::getSchemaBuilder()->hasTable('fblog_posts');
            if ($tableExists) {
                $this->info('✅ fblog_posts table exists');
            } else {
                $this->error('❌ fblog_posts table does not exist');
                return;
            }
            
            // Test 3: Count all posts
            $this->info('3. Counting all blog posts...');
            $totalPosts = DB::table('fblog_posts')->count();
            $this->info("📊 Total posts: {$totalPosts}");
            
            // Test 4: Count published posts
            $this->info('4. Counting published posts...');
            $publishedPosts = DB::table('fblog_posts')->where('status', 'published')->count();
            $this->info("📊 Published posts: {$publishedPosts}");
            
            // Test 5: List all posts with details
            $this->info('5. Listing all posts:');
            $posts = DB::table('fblog_posts')->select('id', 'title', 'status', 'published_at')->get();
            foreach ($posts as $post) {
                $this->line("   ID: {$post->id}, Title: {$post->title}, Status: {$post->status}, Published: {$post->published_at}");
            }
            
            // Test 6: Test Eloquent model
            $this->info('6. Testing Eloquent model...');
            $eloquentPosts = BlogPost::where('status', 'published')->count();
            $this->info("📊 Published posts (Eloquent): {$eloquentPosts}");
            
            // Test 7: Test API endpoint logic
            $this->info('7. Testing API endpoint logic...');
            $apiPosts = BlogPost::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
            
            $this->info("📊 Posts that would be returned by API: {$apiPosts->count()}");
            foreach ($apiPosts as $post) {
                $this->line("   - {$post->title} (ID: {$post->id})");
            }
            
            $this->info('🎉 Blog posts test completed successfully!');
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
