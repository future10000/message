<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/13
 * Time: 15:35
 */
return [
    'class' => 'yii\redis\Connection',
    'hostname' => '',  //你的redis地址
    'password' => '',
    'port' => 6379, //端口
    'database' => 0, // 默认库
    'retries' => 1
];