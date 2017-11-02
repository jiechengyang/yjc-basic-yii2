<?php
namespace app\modules\user\controllers;
use yii\web\Controller;
class RegisterController extends Controller
{
    public $defaultAction = 'home';
    public function  actionHome()
    {
           return  $this->render('index',[]);
    }
}