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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'brevo' => [
        'api_key' => env('BREVO_API_KEY'),
        'sms_sender' => env('BREVO_SMS_SENDER', 'PakSMSConnect'),
    ],

    'mocean' => [
        'base_url' => env('MOCEAN_BASE_URL', 'https://rest.moceanapi.com'),
        'api_token' => env('MOCEAN_API_TOKEN'),
        'sender_id' => env('MOCEAN_SENDER_ID'),
    ],

    'sms' => [
        'default_provider' => env('SMS_PROVIDER', 'mocean'),
    ],

];
