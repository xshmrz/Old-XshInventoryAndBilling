<?php
    return [
        'default' => env('FILESYSTEM_DISK', 'upload'),
        'disks'   => [
            'local'   => [
                'driver' => 'local',
                'root'   => storage_path('app'),
                'throw'  => FALSE,
            ],
            'public'  => [
                'driver'     => 'local',
                'root'       => storage_path('app/public'),
                'url'        => env('APP_URL') . '/storage',
                'visibility' => 'public',
                'throw'      => FALSE,
            ],
            's3'      => [
                'driver'                  => 's3',
                'key'                     => env('AWS_ACCESS_KEY_ID'),
                'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
                'region'                  => env('AWS_DEFAULT_REGION'),
                'bucket'                  => env('AWS_BUCKET'),
                'url'                     => env('AWS_URL'),
                'endpoint'                => env('AWS_ENDPOINT'),
                'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', FALSE),
                'throw'                   => FALSE,
            ],
            'snapshots' => [
                'driver' => 'local',
                'root'   => database_path('snapshots'),
            ],
            'upload'  => [
                'driver'     => 'local',
                'root'       => base_path('upload'),
                'url'        => 'upload',
                'visibility' => 'public',
                'throw'      => FALSE,
            ],
        ],
        'links'   => [
            public_path('storage') => storage_path('app/public'),
        ],
    ];
