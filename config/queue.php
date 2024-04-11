<?php

return [

    'connections' => [
        'mailcoach-redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 60 * 60,
            'block_for' => null,
        ],
    ],

];
