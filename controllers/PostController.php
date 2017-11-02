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
     *  @��������Action 
     */
     public function actions()
     {
        return [
            //����������"error"����
            'error' => 'yii\web\ErrorAction',
            //��������������"view"����
            'view' => [
                   'class' => 'yii\web\viewAction',
                   'viewPrefix' => '',
                 ]
        ];
     }
}
