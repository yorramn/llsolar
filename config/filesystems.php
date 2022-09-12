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
            'throw' => false,
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'permissions' => [
                'file' => [
                    'public' => 0777,
                    'private' => 0664,
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0700,
                ],
            ],
        ],
//        'local' => [
//            'driver' => 'local',
//            'root' => '/webroot/storage',
//            'permissions' => [
//                'file' => [
//                    'public' => 0664,
//                    'private' => 0664,
//                ],
//                'dir' => [
//                    'public' => 0700,
//                    'private' => 0700,
//                ],
//            ],
//        ],

//        'public' => [
//            'driver' => 'local',
//            //'root' => '/webroot/storage/public',
//            'root' => storage_path('app/public'),
//            'url' => env('APP_URL').'/storage',
//            'visibility' => 'public',
//            'permissions' => [
//                'file' => [
//                    'public' => 0775,
//                    'private' => 0775,
//                ],
//                'dir' => [
//                    'public' => 0775,
//                    'private' => 0775,
//                ],
//            ],
//        ],
    ],

//    'links' => [
//        public_path('storage') => storage_path('app/public'),
//        public_path('attachments') => storage_path('app/public/customers/attachments'),
//    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];
