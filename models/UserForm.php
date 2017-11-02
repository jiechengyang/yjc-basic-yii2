<?php

namespace app\models;

use Yii;
use yii\base\Model;
class UserForm extends \yii\db\ActiveRecord
{
    /*public $Id;
    public $UserName;
    public $TrueName;
    public $PassWord;
    public $Sex;
    public $Edu;
    public $File;
    public $Hobby;
    public $Info;*/
    public $PassWordToo;
    public $uploadFile;
    public static function tableName(){
        return '{{%user}}';
    }
    public function rules()
    {
        return [
                    [['UserName','TrueName','PassWord','PassWordToo'],'required'],
                    [['UserName','TrueName','PassWord','PassWordToo'],'string','max'=>255], 
                    [['PassWordToo'],'compare','compareAttribute'=>'PassWord']    
               ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'Id',
            'UserName' => 'UserName',
            'TrueName' => 'PassWord',
            'Sex' => 'Sex',
            'Edu' => 'Edu',
            'File' => 'File',
            'Hobby' => 'Hobby',
            'Info' => 'Info',
            'AddTime' => 'AddTime',
            'RegIp' => 'RegIp',
            'Hex' => 'Hex'
        ];
    }
}