<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/13
 * Time: 11:35
 */
use GatewayWorker\Lib\Gateway;
use app\service\AuthService;
use app\lib\Util;
use app\constant\ErrCode;
use app\constant\Event;

class Message
{
    /**
     * 当客户端发来消息时触发
     * @param int $clientId 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($clientId, $message)
    {
        $data = json_decode($message, true);
        Yii::$app->blog->info('cmd:' . \yii\helpers\VarDumper::export($data));

        if (empty($data['cmd'])) {
            Gateway::closeCurrentClient(Util::eventSend(Event::ERROR, [ErrCode::LACK_CMD, ErrCode::LACK_CMD_MSG]));
            return false;
        }

        if ($data['cmd'] === 'ping') {
            return true;
        }

        try {
            Yii::$app->runAction($data['cmd'], $data['params']??[]);
        } catch (\yii\base\InvalidRouteException $e) {
            Gateway::closeCurrentClient(Util::eventSend(Event::ERROR, [ErrCode::LACK_CMD, ErrCode::LACK_CMD_MSG]));
            $errLog = [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
            Yii::$app->blog->error(\yii\helpers\VarDumper::export($errLog));

            return false;
        } catch (\yii\base\Exception $e) {
            $errLog = [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ];
            Yii::$app->blog->error(\yii\helpers\VarDumper::export($errLog));

            throw $e;
        }

        return true;
    }

    /**
     * 当用户断开连接时触发
     * @param int $clientId 连接id
     */
    public static function onClose($clientId)
    {
        Yii::$app->blog->info('close');

        AuthService::logout();
    }
}