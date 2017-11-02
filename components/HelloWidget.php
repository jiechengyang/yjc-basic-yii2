<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
class HelloWidget extends Widget
{
    public  $message;
    
    public function init()
    {
        parent::init();
        if($this->message == null)
        {
            $this->message = 'Hello World';
        }
        //ob_start();
    }
    public function run()
    {
        //$content = ob_get_clean();
        return '<font color=\'red\'>'.Html::encode($this->message).'</font><br/>';
        //ob_clean();
        //return   $this->render('hello');
    }
}