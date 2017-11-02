<?php
namespace app\modules\manage\controllers;
use Yii;
use yii\web\Controller;
use yii\web\session;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class IndexController extends Controller
{
    public $layout = 'main';
    //public $defaultAction = 'home';
    public function actionIndex()
    {
        return $this->render('index');
    }
}