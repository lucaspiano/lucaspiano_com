<?php

return [
    'environment' => (isLocalhost() ? 'development' : 'production'),
    'staticData' => [
        'meta' => __DIR__ . '/../data/meta.json'
    ],
    'youtube' => [
        'apiBaseUrl' => 'https://www.googleapis.com/youtube/v3',
        'apiKey' => 'AIzaSyBLtsBUJ6Sy6pzGEKeVjUH4KVgAwBRHB6c',
        'channelId' => 'UCR2dv_znZ_o5GO8tUMGZZUg'
    ],
    'db' => [
        'host' => 'mysql.lucaspiano.com',
        'username' => 'lucaspiano',
        'password' => '106658',
        'database' => 'lucaspiano',
    ]
];

function isLocalhost() {
    if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
        return true;
    }

    if (in_array($_SERVER['SERVER_NAME'], ['0.0.0.0'])) {
        return true;
    }

    if (strstr($_SERVER['HTTP_HOST'], '0.0.0.0')) {
        return true;
    }

    return false;
}