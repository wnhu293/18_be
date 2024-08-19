<?php

return [


    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver'    => 'session',
            'provider'  => 'users',
        ],
        'daily' => [
            'driver'    => 'session',
            'provider'  => 'dailyprovider',
        ],
        'khachhang' => [
            'driver'    => 'session',
            'provider'  => 'khachhangprovider',
        ],
        'nhanvien' => [
            'driver'    => 'session',
            'provider'  => 'nhanvienprovider',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'dailyprovider' => [
            'driver'    => 'eloquent',
            'model'     => \App\Models\DaiLy::class,
        ],
        'khachhangprovider' => [
            'driver'    => 'eloquent',
            'model'     => \App\Models\KhachHang::class,
        ],
        'nhanvienprovider' => [
            'driver'    => 'eloquent',
            'model'     => \App\Models\NhanVien::class,
        ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
