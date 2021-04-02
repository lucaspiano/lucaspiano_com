<?php

return [
    'environment' => (isLocalhost() ? 'development' : 'production'),
    'staticData' => [
        'meta' => __DIR__ . '/../data/meta.json'
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