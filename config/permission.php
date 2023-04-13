<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permission Models
    |--------------------------------------------------------------------------
    |
    | This is the array of permission models that will be used by the application
    | to determine if a user has a certain permission. You can add or remove
    | models here depending on the needs of your application.
    |
    */

    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Here you can specify the cache store that should be used for caching
    | permissions. By default, the default cache store is used, but you
    | can specify a custom cache store here if needed.
    |
    */

    'cache' => [
        'store' => null,
        'expiration_time' => 60, // in minutes
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Driver
    |--------------------------------------------------------------------------
    |
    | This is the database driver that should be used for the permissions
    | package. By default, the package will use the default database
    | connection, but you can specify a different connection here.
    |
    */

    'database' => [
        'connection' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Authorization Guard
    |--------------------------------------------------------------------------
    |
    | This is the guard that should be used for authorization. By default,
    | the "web" guard will be used, but you can specify a different guard
    | here if needed.
    |
    */

    'auth' => [
        'guard' => 'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authorization Middleware
    |--------------------------------------------------------------------------
    |
    | This is the middleware that should be used for authorization. By default,
    | the "can" middleware will be used, but you can specify a different
    | middleware here if needed.
    |
    */

    'middleware' => [
        'auth' => [
            'middleware' => 'auth',
            'except' => [],
        ],
        'permission' => [
            'middleware' => 'can',
            'except' => [],
        ],
        'role' => [
            'middleware' => 'role',
            'except' => [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blade Directives
    |--------------------------------------------------------------------------
    |
    | Here you can specify the Blade directives that should be used for
    | displaying content based on user permissions. You can add or
    | remove directives here depending on the needs of your
    | application.
    |
    */

    'blade' => [
        'directive_prefix' => 'can',
        'role_directive_prefix' => 'role',
    ],

];
