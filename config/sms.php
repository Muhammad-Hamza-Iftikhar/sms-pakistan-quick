<?php

return [
    'default' => env('SMS_PROVIDER', 'lifetime'),

    'providers' => [
        'lifetime' => [
            'driver' => 'lifetime',
        ],
    ],
];
