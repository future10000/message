<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/17
 * Time: 13:46
 */
namespace app\component\log;

use yii\base\Component;
use yii\helpers\VarDumper;

class Business extends Component
{
    /**
     * @var \Logger
     */
    private $logger;

    public function init()
    {
        parent::init();
        \Logger::configure(\Yii::$app->params['log4']);
        $this->logger = \Logger::getLogger(__CLASS__);
    }

    public function warn($message)
    {
        $this->logger->warn($this->msgProcess($message));
    }

    public function info($message)
    {
        $this->logger->info($this->msgProcess($message));
    }

    public function error($message)
    {
        $this->logger->error($this->msgProcess($message));
    }

    protected function msgProcess($message)
    {
        return $message . ',session:' . VarDumper::export($_SESSION);
    }
}