<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'], // You can restrict this to your frontend origin

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Set to true if using cookies for authentication

'supports_credentials' => false,
// 'paths' => ['api/*', 'sanctum/csrf-cookie'],
// 'allowed_methods' => ['*'],
// 'allowed_origins' => ['http://localhost:5173'], // Add your frontend URL here
// 'allowed_headers' => ['*'],
// 'exposed_headers' => false,
// 'max_age' => 0,
// 'supports_credentials' => true,

];
