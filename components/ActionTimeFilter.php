<?php
namespace app\components;
use Yii;
use yii\base\ActionFilter;
class ActionTimeFilter extends ActionFilter
{
    private $_starttime;
    
    public function beforeAction($action)
    {
        $this->_starttime = microtime(true);
        return parent::beforeAction($action);
    }
    public function afterAction($action,$result)
    {
        $time = microtime(true) - $this->_starttime;
        Yii::trace("Action '{$action->uniqueId}' spent $time second.");
        return parent::afterAction($action,$result);
    }
}