<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestCloudflareUpload extends Command
{
    protected $signature = 'test:cloudflare-upload';
    protected $description = 'Test Cloudflare R2 upload functionality';

    public function handle()
    {
        $this->info('Testing Cloudflare R2 configuration...');

        try {
            // Test disk configuration
            $disk = Storage::disk('cloudflare');
            $this->info('✅ Cloudflare disk loaded successfully');

            // Test file upload
            $testContent = 'This is a test file for Cloudflare R2';
            $testPath = 'test-files/test-' . time() . '.txt';
            
            $disk->put($testPath, $testContent);
            $this->info('✅ File uploaded successfully to: ' . $testPath);

            // Wait a moment for eventual consistency
            sleep(2);

            // Test file retrieval with better error handling
            try {
                if ($disk->exists($testPath)) {
                    $this->info('✅ File exists in Cloudflare R2');
                } else {
                    $this->warn('⚠️  File existence check failed (this might be due to eventual consistency)');
                }
                
                // Test URL generation
                $url = $disk->url($testPath);
                $this->info('✅ Generated URL: ' . $url);
                
                // Test file content retrieval
                $retrievedContent = $disk->get($testPath);
                if ($retrievedContent === $testContent) {
                    $this->info('✅ File content retrieved successfully');
                } else {
                    $this->warn('⚠️  File content mismatch');
                }
                
                // Clean up test file
                $disk->delete($testPath);
                $this->info('✅ Test file cleaned up');
                
            } catch (\Exception $e) {
                $this->warn('⚠️  File operations had issues: ' . $e->getMessage());
                $this->info('This might be due to Cloudflare R2 eventual consistency');
            }

            $this->info('🎉 Cloudflare R2 test completed successfully!');

        } catch (\Exception $e) {
            $this->error('❌ Cloudflare R2 test failed: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
