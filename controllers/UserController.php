<?php
 namespace app\controllers;
 use Yii;
 use yii\web\controller;
 use yii\filters\AccessControl;
 use yii\web\Response;
 use app\models\userForm;
 use app\models\Profile;
 use yii\bootstrap\Alert;
 use yii\web\NotFoundHttpException;
 class UserController extends Controller
 {
    private $usermodel;
    private $apprequest;
    public function init()
    {
        //验证是否登录.....
        $this->usermodel = new userForm();
        $this->apprequest = Yii::$app->request;
    }
    public function actionRegister()
    {

        Yii::$app->language = 'zh-CN';       //设定为使用中文
        $model = $this->usermodel;
        $model->Sex = 1;
        return  $this->render('register',['model' => $model]);
    }
    /**
     *  @处理登录
     *  
     */
     public function actionRegsave()
     {
        if($this->usermodel->load($this->apprequest->post()) && $this->usermodel->validate())
        {
            //防重复判断
            $check = UserForm::find()->where(['UserName' => $this->usermodel->UserName])->count();
            if(!empty($check))
            {
                //Yii::$app->session->setFlash('error','该用户名已经存在');return $this->refresh();
               return  $this->error('该用户名已经存在','?r=user/register');
            }
            $this->usermodel->Hobby = !empty($this->usermodel->Hobby) ? implode('|',$this->usermodel->Hobby) : '';
            $this->usermodel->AddTime = date('Y-m-d H:i:s');
            $this->usermodel->RegIp = $this->apprequest->userIP; 
            $this->usermodel->Hex = mt_rand(100000,999999);
            $this->usermodel->PassWord = md5(md5($this->usermodel->PassWord).$this->usermodel->Hex);
            $lid = $this->usermodel->save();
            if(!$lid){
                //Yii::$app->session->setFlash('error','注册失败');
                return $this->error('注册失败','?r=user/register');
            }else{
                //Yii::$app->session->setFlash('error','');
               return $this->success("注册成功","?r=site/login","10");
            }
        }else{
            echo 2;
        }
     }
     /*多模型的复合表单*/
     public function actionUpdate($id)
     {
        $user = userForm::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("没有找到用户登录信息！");
        }
        $profile = Profile::findOne($user->profile_id);
        if (!$profile) {
            throw new NotFoundHttpException("没有找到用户基本信息");
        }
        $user->scenario = 'update';
        $profile->scenario = 'update';
        if ($user->load (Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            $isValid = $profile->validate() && $isValid;
            if ($isValid) {
                $user->save(false);
                $profile->save(false);
                return $this->redirect(['user/view', 'id' => $id]);
            }
        }
        return $this->render('update', [
            'user' => $user,
            'profile' => $profile,
        ]);
     }
 }