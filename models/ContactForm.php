<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    const SCENARIO_EAMIL_FROM_GUEST = 'EMAIL_FROM_GUEST';
    const SCENARIO_EAMIL_FROM_USER = 'EMAIL_FROM_USER';
    /**
     *  @声明场景 
     */
     public function scenarios()
     {
        return [
            self::SCENARIO_EAMIL_FROM_GUEST => ['name','email','subject','body','verifyCode'],
            self::SCENARIO_EAMIL_FROM_USER => ['email','subject','body','verifyCode']
        ];
     }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name'  => \yii::t('app','名字'),
            'email'  => \Yii::t('app','邮箱地址'),
            'subject' => \Yii::t('app','标题'),
            'body' => \Yii::t('app','内容'),
            'verifyCode' => \Yii::t('app','验证码'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
