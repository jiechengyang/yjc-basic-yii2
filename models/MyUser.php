<?php

namespace app\models;

use Yii;

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
	public function init(){
		$this->created_at = time();
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
}
