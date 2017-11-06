<?php

namespace app\models;

use Yii;
use app\components\UppercaseBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 */
class MyUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $label_img = '/static/images/nopic.png';
	public $is_valid = 1;
	public $created_at;
	public $content = 'asdasdasdas你的记得记得<div>dddd</div><Script>alert(2222)</script>';
    /*假设每当一个新用户在网站注册后，要发送一封电子邮件通知管理员。*/
    /*        $person = new Person;
    // 使用PHP全局函数作为handler来进行绑定
            $person->on(Person::EVENT_GREET, 'person_say_hello');
    // 使用对象$obj的成员函数say_hello来进行绑定
            $person->on(Person::EVENT_GREET, [$obj, 'say_hello']);
    // 使用类Greet的静态成员函数say_hello进行绑定
            $person->on(Person::EVENT_GREET, ['app\helper\Greet', 'say_hello']);
    // 使用匿名函数
            $person->on(Person::EVENT_GREET, function ($event) {
                echo 'Hello';
            });   */
    CONST EVENT_NEW_USER = 'new_user';
	public function init(){
        // first parameter is the name of the event and second is the handler.
        $this->on(SELF::EVENT_NEW_USER,[$this,'SendMailToAdmin']);
		$this->created_at = time();
	}
    // 要附加一个行为，应该重写行为组件的 behaviors() 方法。
    public function behaviors()
    {
        return [
            UppercaseBehavior::className(),
            /*'myBahavior2' => UppercaseBehavior::className(),
            [
                'class' => UppercaseBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
                'prop3' =>'value3',
            ],
            'myBehavior4' => [
                'class' => UppercaseBehavior::className(),
                'prop1' => 'value1'
            ]*/
        ];

    }
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'name' => '姓名',
            'email' => '邮箱',
			'label_img' => '缩略图',
        ];
    }
    public function SendMailToAdmin($event)
    {
        echo 'mail sent to admin using the event';
    }
}
