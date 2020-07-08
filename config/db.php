<?php

return [
    'class' => 'yii\db\Connection',
    'commandClass' => 'app\core\DbCommand',

    // 主库通用的配置
    'masterConfig' => [
        'username' => '',
        'password' => '',
        'attributes' => [
            // use a smaller connection timeout
            PDO::ATTR_TIMEOUT => 10,
        ],
        'charset' => 'utf8',
    ],

    // 主库配置列表
    'masters' => [
        //['dsn' => 'mysql:host=127.0.0.1;dbname=message'],
    ],

    // 从库的通用配置
    'slaveConfig' => [
        'username' => '',
        'password' => '',
        'attributes' => [
            // use a smaller connection timeout
            PDO::ATTR_TIMEOUT => 10,
        ],
        'charset' => 'utf8',
    ],

    // 从库配置列表
    'slaves' => [
        //['dsn' => 'mysql:host=127.0.0.1;dbname=message'],
    ],
];
