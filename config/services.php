<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'secret' => 'sk_test_LRFbNEFtDhXVrXgFJlByHw7U',
    ],

    /**
     * Social media login
     */
    'github' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'https://skillmonde.com/auth/github/callback',
    ],
    'linkedin' => [    
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'https://skillmonde.com/auth/linkedin/callback'
    ],
    'google' => [    
        'client_id'     => '973116555044-m17hf7lhm6uuuohbmslg2b06poom0tsl.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'https://skillmonde.com/auth/google/callback'
    ],
    'facebook' => [    
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'https://skillmonde.com/auth/facebook/callback'
    ],
    'twitter' => [    
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'https://skillmonde.com/auth/twitter/callback'
    ],

    // Email marketing
    'mailjet' => [
        'key'    => "",
        'secret' => "",
    ]

];
