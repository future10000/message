<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/10
 * Time: 17:45
 */
namespace app\core;

class Request extends \yii\base\Request
{
    private $_params;

    public function getParams()
    {
        return $this->_params;
    }

    public function setParams(array $params)
    {
        $this->_params = $params;
    }

    public function resolve()
    {
        $rawParams = $this->getParams();
        $route = $rawParams['route'];
        $params = $rawParams['params'];

        return [$route, $params];
    }
}