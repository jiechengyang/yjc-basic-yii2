<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "byt_user".
 *
 * @property integer $Id
 * @property string $UserName
 * @property string $TrueName
 * @property string $PassWord
 * @property string $Hex
 * @property integer $Sex
 * @property string $Hobby
 * @property string $File
 * @property string $Info
 * @property integer $Edu
 * @property string $AddTime
 * @property string $RegIp
 * @property string $LastUpdTime
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'byt_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sex', 'Edu'], 'integer'],
            [['Info'], 'string'],
            [['AddTime', 'LastUpdTime'], 'safe'],
            [['UserName', 'TrueName'], 'string', 'max' => 100],
            [['PassWord'], 'string', 'max' => 32],
            [['Hex'], 'string', 'max' => 6],
            [['Hobby'], 'string', 'max' => 8],
            [['File'], 'string', 'max' => 125],
            [['RegIp'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'UserName' => 'User Name',
            'TrueName' => 'True Name',
            'PassWord' => 'Pass Word',
            'Hex' => 'Hex',
            'Sex' => 'Sex',
            'Hobby' => 'Hobby',
            'File' => 'File',
            'Info' => 'Info',
            'Edu' => 'Edu',
            'AddTime' => 'Add Time',
            'RegIp' => 'Reg Ip',
            'LastUpdTime' => 'Last Upd Time',
        ];
    }
}
