<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/12
 * Time: 19:33
 */
namespace app\core;

class Controller extends \yii\base\Controller
{
    public $params = [];

    public function bindActionParams($action, $params)
    {
        return $this->params = $params;
    }
}