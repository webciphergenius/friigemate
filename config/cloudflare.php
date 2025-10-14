<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cloudflare R2 Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Cloudflare R2 object storage.
    | R2 is S3-compatible, so we use the S3 driver with R2 endpoints.
    |
    */

    'r2' => [
        'access_key_id' => env('CLOUDFLARE_R2_ACCESS_KEY_ID'),
        'secret_access_key' => env('CLOUDFLARE_R2_SECRET_ACCESS_KEY'),
        'region' => env('CLOUDFLARE_R2_REGION', 'auto'),
        'bucket' => env('CLOUDFLARE_R2_BUCKET'),
        'endpoint' => env('CLOUDFLARE_R2_ENDPOINT'),
        'url' => env('CLOUDFLARE_R2_URL'),
        'use_path_style_endpoint' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Blog Images Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration specific to blog image uploads.
    |
    */

    'blog' => [
        'disk' => env('BLOG_IMAGES_DISK', 'cloudflare'),
        'directory' => env('BLOG_IMAGES_DIRECTORY', 'blog-images'),
        'max_size' => env('BLOG_IMAGES_MAX_SIZE', 10240), // 10MB in KB
        'allowed_types' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
    ],
];
