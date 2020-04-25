<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/10
 * Time: 17:36
 */
namespace app\core;

use yii\base\Response;

class Application extends \yii\base\Application
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * Handles the specified request.
     * @param Request $request the request to be handled
     * @return Response the resulting response
     */
    public function handleRequest($request)
    {
    }

    /**
     * Returns the error handler component.
     * @return ErrorHandler the error handler application component.
     */
    public function getErrorHandler()
    {
        return $this->get('errorHandler');
    }

    /**
     * Returns the request component.
     * @return Request the request component.
     */
    public function getRequest()
    {
        return $this->get('request');
    }

    /**
     * {@inheritdoc}
     */
    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'request' => ['class' => 'app\core\Request'],
        ]);
    }
}