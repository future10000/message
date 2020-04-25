<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/2/13
 * Time: 17:54
 */
namespace app\service;

use app\constant\Constant;
use app\constant\ErrCode;
use app\constant\Event;
use app\lib\Util;
use app\model\LiveRecord;
use app\model\Student;
use app\model\Teacher;
use app\models\Employee;
use GatewayWorker\Lib\Context;
use GatewayWorker\Lib\Gateway;
use Yii;
use yii\db\Expression;

class AuthService
{
    public static function login($token)
    {
        if (self::getIdentity($token) === null) {
            Gateway::closeCurrentClient(Util::eventSend(Event::ERROR, [ErrCode::LACK_CMD, ErrCode::LACK_CMD_MSG]));
            return false;
        }

        Gateway::bindUid(Context::$client_id, $_SESSION['uid']);

        return true;
    }

    public static function getIdentity($token)
    {
        //todo $_SESSION['uid']写入
        return null;
    }

    public static function logout()
    {

    }
}