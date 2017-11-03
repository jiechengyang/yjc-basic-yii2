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
    public function actionTest()
    {
        $id =\Yii::$app->request->get('id');
        echo "我是删除处理页面---编号为".$id,'即将被删除';
    }
}