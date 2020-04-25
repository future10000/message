<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/13
 * Time: 16:36
 */
namespace app\lib;

use app\constant\Event;
use Yii;
use yii\helpers\VarDumper;

class Util
{
    public static function eventSend($event, array $data = [])
    {
        $ret['event'] = $event;

        if ($event === Event::ERROR) {
            foreach ($data as $item) {
                if (is_numeric($item)) {
                    $ret['data']['code'] = $item;
                } else {
                    $ret['data']['msg'] = $item;
                }
            }
            Yii::$app->blog->warn(VarDumper::export($ret));
        } else {
            if ($data) {
                $ret['data'] = $data;
            }
        }

        return json_encode($ret, JSON_UNESCAPED_UNICODE);
    }

    public static function config(string $key = null)
    {
        $ret = include __DIR__ . '/../config/main.php';
        if (file_exists(__DIR__ . '/../config/main-local.php')) {
            $local = include __DIR__ . '/../config/main-local.php';
            $ret = array_merge($ret, $local);
        }
        if ($key) {
            $keyPath = explode('.', $key);
            foreach ($keyPath as $p) {
                $ret = $ret[$p] ?? null;
                if (!is_array($ret)) {
                    return $ret;
                }
            }
        }

        return $ret;
    }
}