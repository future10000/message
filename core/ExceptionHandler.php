<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2019/3/29
 * Time: 9:40
 */

namespace app\core;

use yii\base\ErrorHandler;
use yii\helpers\VarDumper;
use Yii;

class ExceptionHandler extends ErrorHandler
{
    /**
     * param \Exception $exception
     */
    public function renderException($exception)
    {
        $errLog = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'trace' => $exception->getTraceAsString(),
        ];
        Yii::$app->blog->error(VarDumper::export($errLog));

        throw $exception;
    }
}