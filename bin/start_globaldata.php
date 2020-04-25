<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/15
 * Time: 14:14
 */
use \Workerman\Worker;
use \app\lib\globaldata\Server;
// 自动加载类
require_once __DIR__ . '/../vendor/autoload.php';

$worker = new Server();

if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}