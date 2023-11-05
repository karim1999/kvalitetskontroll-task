<?php
return [
    'user-service' => [
        'base_uri' => env('USER_SERVICE_HOST'),
        'port' => env('USER_SERVICE_PORT'),
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
    ],
    'admin-service' => [
        'base_uri' => env('ADMIN_SERVICE_HOST'),
        'port' => env('ADMIN_SERVICE_PORT'),
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
    ],
    'product-service' => [
        'base_uri' => env('PRODUCT_SERVICE_HOST'),
        'port' => env('PRODUCT_SERVICE_PORT'),
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
    ],
    'order-service' => [
        'base_uri' => env('ORDER_SERVICE_HOST'),
        'port' => env('ORDER_SERVICE_PORT'),
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
    ],
];
