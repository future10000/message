<?php
$params = require __DIR__ . '/params.php';
if (file_exists(__DIR__ . '/params-local.php')) {
    $params = array_merge($params, require __DIR__ . '/params-local.php');
}

$db = require __DIR__ . '/db.php';
if (file_exists(__DIR__ . '/db-local.php')) {
    $db = array_merge($db, require __DIR__ . '/db-local.php');
}

$redis = require __DIR__ . '/redis.php';
if (file_exists(__DIR__ . '/redis-local.php')) {
    $redis = array_merge($redis, require __DIR__ . '/redis-local.php');
}

$config = [
    'id' => 'message',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@runtime' => '@app/runtime',
    ],
    'controllerNamespace' => 'app\command',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'blog' => [
            'class' => 'app\component\log\Business'
        ],
        'gData' => [
            'class' => 'app\lib\globalData\Client',
            'servers' => [
                '127.0.0.1:2207'
            ]
        ],
        'errorHandler' => [
            'class' => 'app\core\ExceptionHandler'
        ],
        'db' => $db,
        'redis' => $redis
    ],
    'params' => $params,
];

return $config;
