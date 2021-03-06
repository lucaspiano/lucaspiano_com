<?php

$config = require_once __DIR__ . "/config/app.php";

if ($config['environment'] === 'production' && $_SERVER['HTTPS'] !== "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url", true,301);
    exit;
}

date_default_timezone_set('America/Sao_Paulo');
session_start();

require_once __DIR__ . "/classes/MySQLConnection.php";
require_once __DIR__ . "/classes/Youtube/YoutubeParams.php";
require_once __DIR__ . "/classes/Youtube/YoutubeHelper.php";
require_once __DIR__ . "/classes/StaticDataHelper.php";

$dbConnection = new MySQLConnection($config['db']);
$staticData = new StaticDataHelper($config['staticData']);

$clientSecret = json_decode(file_get_contents($config['youtube']['clientSecretFile']), true);

$youtubeParams = new YoutubeParams(
    $config['youtube']['apiKey'],
    $config['youtube']['apiBaseUrl'],
    $config['youtube']['channelId'],
    $clientSecret
);

$youtubeHelper = new YoutubeHelper($youtubeParams);