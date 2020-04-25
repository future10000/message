<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/14
 * Time: 11:44
 */
namespace app\constant;

class ErrCode
{
    const LACK_CMD = 1000;
    const LACK_CMD_MSG = '非法请求';

    const NOT_LOGIN = 1001;
    const NOT_LOGIN_MSG = '请登录';

    const LACK_PARAMS = 1002;
    const LACK_PARAMS_MSG = '缺少参数';
}