<?php

return [
    "default" => env("BROADCAST_DRIVER", "centrifugo"),

    "connections" => [
        "centrifugo" => [
            "driver" => "pusher",
            "key" => env("CENTRIFUGO_API_KEY", "secret-key"),
            "secret" => env("CENTRIFUGO_API_SECRET", "secret-key"),
            "app_id" => env("CENTRIFUGO_APP_ID", "1"),
            "options" => [
                "host" => env("CENTRIFUGO_HOST", "127.0.0.1"),
                "port" => env("CENTRIFUGO_PORT", 8000),
                "scheme" => env("CENTRIFUGO_SCHEME", "http"),
                "encrypted" => false,
                "curl_options" => [],
            ],
        ],

        "pusher" => [
            "driver" => "pusher",
            "key" => env("PUSHER_APP_KEY"),
            "secret" => env("PUSHER_APP_SECRET"),
            "app_id" => env("PUSHER_APP_ID"),
            "options" => [
                "cluster" => env("PUSHER_APP_CLUSTER"),
                "useTLS" => true,
            ],
        ],

        "redis" => [
            "driver" => "redis",
            "connection" => "default",
        ],

        "log" => [
            "driver" => "log",
        ],

        "null" => [
            "driver" => "null",
        ],
    ],
];
