
<?php
return [
    'super-admin' => [
        'first_name' => env('ADMIN_FIRST_NAME', 'Super'),
        'last_name' =>  env('ADMIN_LAST_NAME', 'Admin'),
        'email' =>  env('ADMIN_EMAIL', 'super@admin.com'),
        'country_code' =>  env('ADMIN_COUNTRY_CODE', '91'),
        'mobile_number' =>  env('ADMIN_MOBILE_NUMBER', '1234567890'),
        'password' => env('ADMIN_PASSWORD', 'super@admin.com'),
        'status' => 1,
    ],
    'admin' => [
        'first_name' => env('ADMIN_FIRST_NAME', 'Admin'),
        'last_name' =>  env('ADMIN_LAST_NAME', 'John'),
        'email' =>  env('ADMIN_EMAIL', 'admin@admin.com'),
        'country_code' =>  env('ADMIN_COUNTRY_CODE', '91'),
        'mobile_number' =>  env('ADMIN_MOBILE_NUMBER', '1234567891'),
        'password' => env('ADMIN_PASSWORD', 'admin@admin.com'),
        'status' => 1,
    ],
    'user-paginate' => env('USER_PAGINATE', 2),
    'social-links' => [
        'facebook_link' => 'https://www.facebook.com/sharer',
        'twitter_link' => 'https://x.com/',
        'thread_link' => 'https://www.threads.net/t/CuY8S0ASjXO',
        'instagram_link' => 'https://www.instagram.com',
    ],
    'frontend' => [
        'category_game_count' => 4,
    ]
];
