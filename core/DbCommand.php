<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/13
 * Time: 14:08
 */
namespace app\core;

use yii\db\Command;

class DbCommand extends Command
{
    const EVENT_DISCONNECT = 'disconnect';

    /**
     * 处理修改类型sql的断线重连问题
     * @return int
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    public function execute()
    {
        try{
            return parent::execute();
        }catch(\Exception $e){
            if($this->handleException($e)) {
                return parent::execute();
            }
            throw $e;
        }
    }

    /**
     * 处理查询类sql断线重连问题
     * @param string $method
     * @param null $fetchMode
     * @return mixed
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    protected function queryInternal($method, $fetchMode = null)
    {
        try{
            return parent::queryInternal($method, $fetchMode = null);
        }catch(\Exception $e){
            if($this->handleException($e)) {
                return parent::queryInternal($method, $fetchMode);
            }
            throw $e;
        }
    }

    /**
     * 处理执行sql时捕获的异常信息
     * 并且根据异常信息来决定是否需要重新连接数据库
     * @param \Exception $e
     * @return bool true: 需要重新执行sql false: 不需要重新执行sql
     */
    private function handleException(\Exception $e)
    {
        if ($e instanceof \yii\db\Exception) {
            if (in_array($e->errorInfo[1], [2006, 2013])) {
                $this->trigger(static::EVENT_DISCONNECT);
                $this->db->close();
                \Yii::$app->blog->info('数据库重连...');
                $this->db->open();
                $this->pdoStatement = null;

                return true;
            }
        }

        return false;
    }

    protected function bindPendingParams()
    {
        foreach ($this->pendingParams as $name => $value) {
            $this->pdoStatement->bindValue($name, $value[0], $value[1]);
        }
    }
}