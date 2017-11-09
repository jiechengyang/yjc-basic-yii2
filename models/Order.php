<?php
namespace app\models;
use Yii;
class Order extends \yii\db\ActiveRecord
{
    public static function tabname()
    {
        return "{{%order}}";
    }
    public function getUsers()
    {
        //$users = $this->hasOne(UserForm::className(),['id' => 'user_id'])->asArray()->one();
        $users = $this->hasOne(UserForm::className(),['id' => 'user_id'])->asArray();
        return $users;
    }
}
