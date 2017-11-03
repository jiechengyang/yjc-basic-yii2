<?php
namespace app\components;
class Taxi extends \Yii\base\Object
{
    private $_phone;
    public function getPhone()
    {
        return $this->_phone;
    }
    public function setPhone($phone)
    {
        $this->_phone = trim($phone);
    }
}