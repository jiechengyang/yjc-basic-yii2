<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6 0006
 * Time: 下午 13:30
 */
namespace  app\components;
use yii\base\Behavior;
use yii\db\ActiveRecord;
class MyBehavior extends Behavior
{
    private $_prop1;
    public function getProp1()
    {
        return $this->_prop1;
    }
    public function setProp1($value)
    {
        $this->_prop1 = $value;
    }
    public function myfunction()
    {

    }
    public function events()
    {
       // return parent::events(); // TODO: Change the autogenerated stub
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'afterValidate',
        ];
    }
    public function afterValidate($event)
    {

    }
}