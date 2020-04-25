<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/14
 * Time: 12:44
 */
namespace app\command;

use app\constant\ErrCode;
use app\constant\Event;
use app\core\Controller;
use app\lib\Util;
use GatewayWorker\Lib\Gateway;
use Yii;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (empty($_SESSION['uid'])) {
            Gateway::closeCurrentClient(Util::eventSend(Event::ERROR, [ErrCode::NOT_LOGIN, ErrCode::NOT_LOGIN_MSG]));

            return false;
        }
        return parent::beforeAction($action);
    }

    public function checkParams($params)
    {
        if (is_string($params)) {
            $params = explode(',', $params);
        }
        foreach ($params as $param) {
            if (empty($this->params[$param])) {
                Gateway::closeCurrentClient(Util::eventSend(Event::ERROR, [ErrCode::LACK_PARAMS, ErrCode::LACK_PARAMS_MSG]));
                return false;
            }
        }

        return true;
    }
}