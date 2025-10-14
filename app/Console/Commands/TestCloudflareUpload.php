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

            // Test file retrieval
            if ($disk->exists($testPath)) {
                $this->info('✅ File exists in Cloudflare R2');
                
                // Test URL generation
                $url = $disk->url($testPath);
                $this->info('✅ Generated URL: ' . $url);
                
                // Clean up test file
                $disk->delete($testPath);
                $this->info('✅ Test file cleaned up');
            } else {
                $this->error('❌ File does not exist in Cloudflare R2');
            }

            $this->info('🎉 Cloudflare R2 test completed successfully!');

        } catch (\Exception $e) {
            $this->error('❌ Cloudflare R2 test failed: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
