<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'categories' => [
            'driver' => 'local',
            'root' => storage_path('app/public/categories'),
            'url' => env('APP_URL').'/storage/categories',
            'visibility' => 'public',
        ],

        'category_sliders' => [
            'driver' => 'local',
            'root' => storage_path('app/public/category_sliders'),
            'url' => env('APP_URL').'/storage/category_sliders',
            'visibility' => 'public',
        ],

        'home_sliders' => [
            'driver' => 'local',
            'root' => storage_path('app/public/home_sliders'),
            'url' => env('APP_URL').'/storage/home_sliders',
            'visibility' => 'public',
        ],

        'news' => [
            'driver' => 'local',
            'root' => storage_path('app/public/news'),
            'url' => env('APP_URL').'/storage/news',
            'visibility' => 'public',
        ],

        'catalog' => [
            'driver' => 'local',
            'root' => storage_path('app/public/catalog'),
            'url' => env('APP_URL').'/storage/catalog',
            'visibility' => 'public',
        ],


        'galleries' => [
            'driver' => 'local',
            'root' => storage_path('app/public/galleries'),
            'url' => env('APP_URL').'/storage/galleries',
            'visibility' => 'public',
        ],

        'products' => [
            'driver' => 'local',
            'root' => storage_path('app/public/products'),
            'url' => env('APP_URL').'/storage/products',
            'visibility' => 'public',
        ],

        'product_sliders' => [
            'driver' => 'local',
            'root' => storage_path('app/public/product_sliders'),
            'url' => env('APP_URL').'/storage/product_sliders',
            'visibility' => 'public',
        ],

        'horses' => [
            'driver' => 'local',
            'root' => storage_path('app/public/horses'),
            'url' => env('APP_URL').'/storage/horses',
            'visibility' => 'public',
        ],

        'horse_videos' => [
            'driver' => 'local',
            'root' => storage_path('app/public/horse_videos'),
            'url' => env('APP_URL').'/storage/horse_videos',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
