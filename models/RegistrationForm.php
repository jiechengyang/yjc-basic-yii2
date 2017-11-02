<?php
namespace app\models;
use Yii;
use yii\base\Model;
use app\components\CityValidator;
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $subscriptions;
    public $photos;    
    public $phone;
    public $country;
    public $city;
    public function init()
    {
    }
    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app','用户名'),
            'password' => \Yii::t('app','密码'),
            'email' => \Yii::t('app','电子邮箱'),
            'subscriptions' => \Yii::t('app','订阅'),
            'photos' => \Yii::t('app','头像')
        ];
    }
    public function rules()
    {
        /*return [
                [['username','password','phone','email'],'required'],
                ['email','email'],
        ];*/
        // 要自定义 username 属性的错误信息，RegistrationForm 修改 rules() 方法，以下列方式。
        return [
                [['password','phone','email'],'required'],
                ['username','required','message' => '我艹尼玛，眼睛睁大点，必填啊！'],
                ['country','trim'],
                //['city','default','value' => 'Chengdu'],
                ['email','email'],
                ['city','validateCity']
                //['city', CityValidator::className()]
        ];
    }
    public function validateCity()
    {
        if(!in_array($this->attributes['city'],['Chengdu','Guangzhou'])){
            $this->addError($this->attributes['city'],'The city must be either "London" or "Paris".');
        }
    }
    /*public function beforeValidate()
    {
    }
    public function afterValidate()
    {
        //var_dump($this->errors);
    }*/
}