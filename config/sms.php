<?php

return [
    'default' => env('SMS_PROVIDER', 'mocean'),

    'providers' => [
        'brevo' => [
            'sms_sender' => env('BREVO_SMS_SENDER', 'PakSMSConnect'),
        ],

        'mocean' => [
            'base_url' => env('MOCEAN_BASE_URL', 'https://rest.moceanapi.com'),
            'api_token' => env('MOCEAN_API_TOKEN'),
            'sender_id' => env('MOCEAN_SENDER_ID'),
        ],
    ],
];

