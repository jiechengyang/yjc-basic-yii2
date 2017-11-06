<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6 0006
 * Time: 下午 13:49
 */
namespace app\components;
use yii\base\Behavior;
use yii\db\ActiveRecord;
class UppercaseBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate'
        ];
    }
    public function beforeValidate($event)
    {
        $this->owner->name = strtoupper($this->owner->name);
    }
}