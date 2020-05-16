<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'facebook' => [
        'client_id' => '995629410859662',
        'client_secret' => '7568b032b9460a1f5def84193d52ea0f',
        'redirect' => 'https://barngate.salebybrands.com/login/facebook/callback'
    ],
    'google' => [
        'client_id' => '53290345346-mv6ulhuv6u81ctd6mjre9q4l9sq9ts2t.apps.googleusercontent.com',
        'client_secret' => 'zXwj1BwYom65czvtqJaC0Iqq',
        'redirect' => 'https://barngate.salebybrands.com/callback/google'
    ]

];
