<?php
namespace app\controllers;
use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//view and create 
class PostController extends Controller
{
    public $defaultAction = 'home';
    public function actionHome()
    {
        
    }
    public function actionView($id = 0)
    {
        $model = Post::findone($id);
        if($model == null)
        {
            throw new NotFoundHttpException;
        }
        return $this->render('view',['model' => $model]);
    }
    public function actionCreate()
    {
        $model = new Post();
        if($model->load(Yii::$app->request()->post()) && $model->save())
        {
            return $this->redirect(['view','id' => $model->id]);
        }else{
            return $this->render('create',['model' => $model]);
        }
    }
    /**
     * 
     *  @独立动作Action 
     */
     public function actions()
     {
        return [
            //用类来申明"error"动作
            'error' => 'yii\web\ErrorAction',
            //用配置数组申明"view"动作
            'view' => [
                   'class' => 'yii\web\viewAction',
                   'viewPrefix' => '',
                 ]
        ];
     }
}
