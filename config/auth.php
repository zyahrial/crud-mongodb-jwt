<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    // 'defaults' => [
    //     'guard' => 'api',
    //     'passwords' => 'users',
    // ],


    // 'guards' => [
    //     'web' => [
    //         'driver' => 'session',
    //         'provider' => 'users',
    //     ],

    //     'api' => [
    //         'driver' => 'jwt',
    //         'provider' => 'users',
    //         'hash' => false,
    //     ],
    // ],
    //   'defaults' => [
    //     'guard' => env('AUTH_GUARD', 'api'),
    //     'passwords' => 'users',
    // ],
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    
    'guards' => [
        'api' => [
          'driver' => 'jwt',
          'provider' => 'users'
        ],
      ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  =>  App\Models\User::class,
        ]
    ],
];