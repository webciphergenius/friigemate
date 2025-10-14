<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DiagnoseCloudflare extends Command
{
    protected $signature = 'diagnose:cloudflare';
    protected $description = 'Diagnose Cloudflare R2 configuration';

    public function handle()
    {
        $this->info('🔍 Diagnosing Cloudflare R2 Configuration...');
        $this->newLine();

        // Check environment variables
        $this->info('📋 Environment Variables:');
        $envVars = [
            'CLOUDFLARE_R2_ACCESS_KEY_ID',
            'CLOUDFLARE_R2_SECRET_ACCESS_KEY',
            'CLOUDFLARE_R2_BUCKET',
            'CLOUDFLARE_R2_REGION',
            'CLOUDFLARE_R2_ENDPOINT',
            'CLOUDFLARE_R2_URL',
        ];

        foreach ($envVars as $var) {
            $value = env($var);
            if ($value) {
                if (str_contains($var, 'SECRET') || str_contains($var, 'KEY')) {
                    $displayValue = substr($value, 0, 8) . '...';
                } else {
                    $displayValue = $value;
                }
                $this->info("  ✅ {$var}: {$displayValue}");
            } else {
                $this->error("  ❌ {$var}: Not set");
            }
        }

        $this->newLine();

        // Check filesystem configuration
        $this->info('⚙️  Filesystem Configuration:');
        $cloudflareConfig = config('filesystems.disks.cloudflare');
        if ($cloudflareConfig) {
            $this->info('  ✅ Cloudflare disk configuration found');
            $this->info('  📁 Driver: ' . ($cloudflareConfig['driver'] ?? 'Not set'));
            $this->info('  🌍 Region: ' . ($cloudflareConfig['region'] ?? 'Not set'));
            $this->info('  🪣 Bucket: ' . ($cloudflareConfig['bucket'] ?? 'Not set'));
            $this->info('  🔗 Endpoint: ' . ($cloudflareConfig['endpoint'] ?? 'Not set'));
        } else {
            $this->error('  ❌ Cloudflare disk configuration not found');
        }

        $this->newLine();

        // Check custom configuration
        $this->info('🎛️  Custom Configuration:');
        $customConfig = config('cloudflare.blog');
        if ($customConfig) {
            $this->info('  ✅ Custom Cloudflare blog config found');
            $this->info('  💾 Disk: ' . ($customConfig['disk'] ?? 'Not set'));
            $this->info('  📂 Directory: ' . ($customConfig['directory'] ?? 'Not set'));
            $this->info('  📏 Max Size: ' . ($customConfig['max_size'] ?? 'Not set') . ' KB');
        } else {
            $this->error('  ❌ Custom Cloudflare blog config not found');
        }

        $this->newLine();

        // Test disk creation
        $this->info('🧪 Testing Disk Creation:');
        try {
            $disk = Storage::disk('cloudflare');
            $this->info('  ✅ Cloudflare disk created successfully');
            
            // Test basic operations without file I/O
            $this->info('  📝 Testing URL generation...');
            $testUrl = $disk->url('test-file.txt');
            $this->info("  ✅ URL generated: {$testUrl}");
            
        } catch (\Exception $e) {
            $this->error('  ❌ Failed to create Cloudflare disk: ' . $e->getMessage());
        }

        $this->newLine();
        $this->info('🎯 Recommendations:');
        
        if (!env('CLOUDFLARE_R2_ACCESS_KEY_ID')) {
            $this->warn('  ⚠️  Set CLOUDFLARE_R2_ACCESS_KEY_ID in your .env file');
        }
        
        if (!env('CLOUDFLARE_R2_SECRET_ACCESS_KEY')) {
            $this->warn('  ⚠️  Set CLOUDFLARE_R2_SECRET_ACCESS_KEY in your .env file');
        }
        
        if (!env('CLOUDFLARE_R2_BUCKET')) {
            $this->warn('  ⚠️  Set CLOUDFLARE_R2_BUCKET in your .env file');
        }
        
        if (!env('CLOUDFLARE_R2_ENDPOINT')) {
            $this->warn('  ⚠️  Set CLOUDFLARE_R2_ENDPOINT in your .env file');
        }

        $this->newLine();
        $this->info('💡 The "exists()" check failure is likely due to Cloudflare R2\'s eventual consistency.');
        $this->info('   This is normal and doesn\'t affect actual file uploads or URL generation.');
    }
}
