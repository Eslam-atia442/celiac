<?php

$base_dir = 'uploads';

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
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'app' => [
            'driver' => 'local',
            'root' => app_path() . DIRECTORY_SEPARATOR,
            'visibility' => 'public',
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

    /*
    |--------------------------------------------------------------------------
    | upload config
    |--------------------------------------------------------------------------
    |
    | Here you may configure the upload config
    |
    */
    'upload' => [
        'max_size'  => 10240,   // kb
        'max_width' => 1080,    // px
        'max_height'=> 2160,    // px
        'quality'   => 60,
        'paths' => [
            'default'  => $base_dir . DIRECTORY_SEPARATOR,
            'user' => $base_dir . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR,
            'governance_lists' => $base_dir . DIRECTORY_SEPARATOR . 'governance_lists' . DIRECTORY_SEPARATOR,
            'board_of_managers_members' => $base_dir . DIRECTORY_SEPARATOR .'board_of_managers'.DIRECTORY_SEPARATOR.'members'.DIRECTORY_SEPARATOR,
            'board_of_managers_meetings' => $base_dir . DIRECTORY_SEPARATOR .'board_of_managers'.DIRECTORY_SEPARATOR.'meetings'.DIRECTORY_SEPARATOR,
            'organizational_structure_members' => $base_dir . DIRECTORY_SEPARATOR .'organizational_structure'.DIRECTORY_SEPARATOR.'members'.DIRECTORY_SEPARATOR,
            'general_assembly_members' => $base_dir . DIRECTORY_SEPARATOR .'general_assembly'.DIRECTORY_SEPARATOR.'members'.DIRECTORY_SEPARATOR,
            'general_assembly_meetings' => $base_dir . DIRECTORY_SEPARATOR .'general_assembly'.DIRECTORY_SEPARATOR.'meetings'.DIRECTORY_SEPARATOR,
            'project' => $base_dir . DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR,
            'milestone' => $base_dir . DIRECTORY_SEPARATOR . 'milestones' . DIRECTORY_SEPARATOR,
            'project_scope' => $base_dir . DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR . 'scopes' . DIRECTORY_SEPARATOR,
            'file_type_banner_image' => $base_dir . DIRECTORY_SEPARATOR .'file_type_banner_image'.DIRECTORY_SEPARATOR.'banners'.DIRECTORY_SEPARATOR,
            'file_type_donation_image' => $base_dir . DIRECTORY_SEPARATOR .'file_type_donation_image'.DIRECTORY_SEPARATOR.'donations'.DIRECTORY_SEPARATOR,
            'post' => $base_dir . DIRECTORY_SEPARATOR .'posts'.DIRECTORY_SEPARATOR,
            'partner' => $base_dir . DIRECTORY_SEPARATOR .'partners'.DIRECTORY_SEPARATOR,
            'committee_members' => $base_dir . DIRECTORY_SEPARATOR .'committees'.DIRECTORY_SEPARATOR.'members'.DIRECTORY_SEPARATOR,
            'admins' => $base_dir . DIRECTORY_SEPARATOR .'admins'.DIRECTORY_SEPARATOR,
            'scientific_researches' => $base_dir . DIRECTORY_SEPARATOR .'scientific_researches'.DIRECTORY_SEPARATOR,
            'translated_books' => $base_dir . DIRECTORY_SEPARATOR .'translated_books'.DIRECTORY_SEPARATOR,
            'guidance_manual' => $base_dir . DIRECTORY_SEPARATOR .'guidance_manual'.DIRECTORY_SEPARATOR,
            'patient_awareness' => $base_dir . DIRECTORY_SEPARATOR .'patient_awareness'.DIRECTORY_SEPARATOR,
            "file_type_about_diesease_image" => $base_dir . DIRECTORY_SEPARATOR . "file_type_about_diesease_image" . DIRECTORY_SEPARATOR . "about_diesease" . DIRECTORY_SEPARATOR,
            "file_type_information_about_treatment_image" => $base_dir . DIRECTORY_SEPARATOR . "file_type_information_about_treatment_image" . DIRECTORY_SEPARATOR . "_about_treatment" . DIRECTORY_SEPARATOR,
        ],
    ],

];
