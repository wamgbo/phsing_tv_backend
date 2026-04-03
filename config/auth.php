<?php

use App\Models\Post;
use App\Models\User;

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'posts_password_reset',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'posts_provider', // 指向下面的定義
        ],
    ],

    'providers' => [
        'posts_provider' => [
            'driver' => 'eloquent',
            'model' => App\Models\Post::class, // 確保這裡指向你的 Post Model
        ],
    ],

    'passwords' => [
        'posts_password_reset' => [
            'provider' => 'posts_provider',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
];