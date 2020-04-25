<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/14
 * Time: 13:09
 */
namespace app\command;

use app\constant\ErrCode;
use app\constant\Event;
use app\core\Controller;
use app\lib\Util;
use app\service\AuthService;
use GatewayWorker\Lib\Gateway;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (empty($this->params['token'])) {
            Gateway::closeCurrentClient(Util::eventSend(Event::ERROR, [ErrCode::LACK_PARAMS, ErrCode::LACK_PARAMS_MSG]));

            return false;
        }

        AuthService::login($this->params['token']);

        return true;
    }
}