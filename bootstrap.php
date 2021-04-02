<?php

$config = require_once __DIR__ . "/config/app.php";

if ($config['environment'] === 'production' && $_SERVER['HTTPS'] !== "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url", true,301);
    exit;
}

session_start();

require_once __DIR__ . "/classes/MySQLConnection.php";
require_once __DIR__ . "/classes/Youtube/YoutubeParams.php";
require_once __DIR__ . "/classes/Youtube/YoutubeHelper.php";
require_once __DIR__ . "/classes/StaticDataHelper.php";

//$db = new MySQLConnection($config['db']);
$staticData = new StaticDataHelper($config['staticData']);

$youtubeParams = new YoutubeParams(
    $config['youtube']['apiKey'],
    $config['youtube']['apiBaseUrl'],
    $config['youtube']['channelId']
);

$youtubeHelper = new YoutubeHelper($youtubeParams);