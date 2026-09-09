<?php

use Illuminate\Support\Str;

return [

    

    'driver' => env('SESSION_DRIVER', 'database'),

    

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

   

    'encrypt' => env('SESSION_ENCRYPT', false),

   

    'files' => storage_path('framework/sessions'),

   

    'connection' => env('SESSION_CONNECTION'),

   

    'table' => env('SESSION_TABLE', 'sessions'),

  

    'store' => env('SESSION_STORE'),

 

    'lottery' => [2, 100],


    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application, but you're free to change this when necessary.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | This value determines the domain and subdomains the session cookie is
    | available to. By default, the cookie will be available to the root
    | domain without subdomains. Typically, this shouldn't be changed.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

   

    'secure' => env('SESSION_SECURE_COOKIE'),

    

    'http_only' => env('SESSION_HTTP_ONLY', true),

    

    'same_site' => env('SESSION_SAME_SITE', 'lax'),


    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
