<?php

namespace app\controllers;//创建 app下的controllers 空间
use Yii;//导入 yii空间
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\RegistrationForm;
use app\models\UploadImageForm;
use app\models\Order;
use app\models\UserForm;
use app\models\MyUser;
use yii\bootstrap\Alert;
use yii\base\DynamicModel;//支持动态定义attributes 和 rules。
use yii\widgets\ActiveForm;//bootstrap\ActiveForm
use yii\web\UploadedFile;
use yii\data\Pagination;//使用分页插件
use yii\data\Sort; //对象来表示一个排序模式
use app\components\Taxi;
//use yii\db\Query; //使用 yii\db\ActiveQuery 或 yii\db\Query 来从数据库中查询数据
use yii\data\ActiveDataProvider ;//ActiveDataProvider使用DB应用程序组件作为数据库连接。
use yii\data\SqlDataProvider ;//SqlDataProvider类是使用原始的SQL语句方式工作的。
use yii\data\ArrayDataProvider;//ArrayDataProvider类是使用大数组是最好的方式。此数组中元素可以是 DAO 的任何查询结果或 ActiveRecord 的实例
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
   // public $layout = "newlayout";//将 $layout 属性添加到 SiteController 类。
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','special-callback'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' =>['special-callback'],
                        'allow' => true,
                        'matchCallback' => function ($rule,$action) {
                            return date('m-d') === '11-31';
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     * 独立操作
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /*或者这样使用自定义错误提示
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        //Yii::$app->getResponse()->redirect($url)->send();重定向
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }*/
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        //$model->scenario = ContactForm::SCENARIO_EAMIL_FROM_GUEST;//当设置为游客场景的话，结果是所有字段都是必填
        $model->scenario = ContactForm::SCENARIO_EAMIL_FROM_USER;//当设置为用户场景的话，结果是除名字字段外都是必填
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $email = Yii::$app->params['adminEmail'];
        $model = new ContactForm();
        Yii::$app->view->on(yii\web\view::EVENT_END_BODY,function(){
           echo date('Y-m-d H:i:s'); 
        });
        return $this->render('about',['email' => $email,'phone' => '1111111111','model' => $model]);
    }
    /**
     *  学习controller 
     *   操作 ID 总是被以小写处理，如果一个操作 ID 由多个单词组成， 单词之间将由连字符连接（如 create-comment）。 操作 ID 映射为方法名时移除了连字符，将每个单词首字母大写，并加上 action 前缀。 例子：操作 ID create-comment 相当于方法名 actionCreateComment
     * 
     * http://www.yii2test.net/?r=site/say          ---结果为   HELLO YANG
     * http://www.yii2test.net/?r=site/say          ---结果为   空
     */
     public function actionSay($message='HELLO YANG')
     {
        //var_dump(Yii::$app->request->get());exit;
        return $this->render('say',['message' => $message]);
     }
     // 例子：操作 ID create-comment 相当于方法名 actionCreateComment
     public function actionShowList()
     {
        return $this->render('say',['message' => '控制器使用驼峰命名']);
     }
     /**
      *     学习model
      * 
      * 表达式 Yii::$app 代表应用实例，它是一个全局可访问的单例。 同时它也是一个服务定位器， 能提供 request，response，db 等等特定功能的组件。 在上面的代码里就是使用 request 组件来访问应用实例收到的 $_POST 数据。
      */ 
     public function actionEntry()
     {
        $EntryFormModel = new EntryForm();
        $AppRequest = Yii::$app->request;
        if($EntryFormModel->load($AppRequest->post()) && $EntryFormModel->validate()){
            //验证model 收到的数据   
            //$name = Yii::$app->request->post('name');  or $EntryFormModel->name
           // print_r($AppRequest->post('EntryForm')) ;exit; ----读取post的数据 
             //echo '<pre>';print_r($EntryFormModel);exit();
             $name = $EntryFormModel->name;
             if( $name != 'jiechengyang')
             { 
                //return $this->refresh();
                 //echo '<pre>';print_r(Yii::$app->session);exit;
                 //Yii::$app->session['uinfo'] = json_encode($uinfo);//设置seesion or $session->set('user_id', '1234');
                 /*
                    读取session               
                    $session = Yii::$app->session;
                    $user_id = $session->get('user_id');
                    //OR
                    $user_id = $session['user_id'];
                    //OR
                    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                 */
                 Yii::$app->session->setFlash('error','该用户不存在');
                 return $this->render('entry',['EntryFormModel'=>$EntryFormModel]);
             }
            return $this->render('entry-form',['EntryFormModel'=>$EntryFormModel]);
        }else{
            // 使用 $model->getErrors() 获取错误详情
            //var_dump($EntryFormModel->getErrors());exit;
            return $this->render('entry',['EntryFormModel'=>$EntryFormModel]);
        }
     }
     //HTTP请求
     public function actionTestRequest()
     {
        $req = Yii::$app->request;
        if ($req->isAjax) {
          echo "the request is AJAX";
        }
        if ($req->isGet) {
          echo "the request is GET";
        }
        if ($req->isPost) {
          echo "the request is POST";
        }
        if ($req->isPut) {
          echo "the request is PUT";
        }
        echo '<hr/>';
        echo 'The URL without the host:'.Yii::$app->request->url,'<br/>';
        echo 'The URL without the host path:'.Yii::$app->request->absoluteUrl,'<br/>';
        echo 'The host of the URL:'.Yii::$app->request->hostInfo,'<br/>';
        echo 'The part after the entry script and before the question mark:'.Yii::$app->request->pathInfo,'<br/>';
        echo 'The part after the question mark:'.Yii::$app->request->queryString,'<br/>';
        echo 'The part after the host and before the entry script:'.Yii::$app->request->baseUrl,'<br/>';
        echo 'The URL without path info and query string:'.Yii::$app->request->scriptUrl,'<br/>';
        echo 'The host name in the URL:'.Yii::$app->request->serverName,'<br/>';
        echo 'The port used by the web server:'.Yii::$app->request->serverPort,'<br/>';
        echo 'The HomeUrl:'.Yii::$app->getHomeUrl(),'<br/>';
        echo 'The ClientIp:'.Yii::$app->request->getUserIP(),'<br/>';
        echo '<pre>';print_r(Yii::$app->request->headers);
     }
     //HTTP响应
     public function actionTestResponse()
     {
        //Yii::$app->response->statusCode = 201;  
        //throw new \yii\web\GoneHttpException;
        // Yii::$app->response->headers->add('Pragma','no-cache');
        $headers = Yii::$app->response->headers;
        
        // 增加一个 Pragma 头，已存在的Pragma 头不会被覆盖。
        $headers->add('Pragma', 'no-cache');
        
        // 设置一个Pragma 头. 任何已存在的Pragma 头都会被丢弃
        $headers->set('Pragma', 'no-cache');
        
        // 删除Pragma 头并返回删除的Pragma 头的值到数组
        $values = $headers->remove('Pragma');
        Yii::$app->response->content = 'hello world!';
/**
 *         HTML: 通过 yii\web\HtmlResponseFormatter 来实现.
 *         XML: 通过 yii\web\XmlResponseFormatter来实现.
 *         JSON: 通过 yii\web\JsonResponseFormatter来实现.
 *         JSONP: 通过 yii\web\JsonResponseFormatter来实现.
 */
        /**
         * 以 JSON 格式响应
        *\yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        *return [
         *   'id' => 1,
          *  'name' => 'Apple',
           * 'age' => 28,
            *'country' => 'China',
            *'city' => 'ChengDu'
        *];
        */
        //重定向
        //return $this->redirect('http://www.yiibai.com/');
        //return Yii::$app->response->sendFile('favicon.ico');//发送文件
        //\Yii::$app->response->sendFile('path/to/file.txt')->send();//如果不是在操作方法中调用文件发送方法，在后面还应调用 yii\web\Response::send() 没有其他内容追加到响应中。
         //return Yii::$app->response->sendStreamAsFile('img/test-img.jpg','1223');
     }
     //程序暂时维护中
     public function actionMaintenance()
     {
        echo "<h1>系统正在维护中...</h1>";  
     }
     /**
      * 
      *  @创建URL 
      *  要创建各种URL，可以使用 yii\helpers\Url::to() 辅助方法。下面的例子假定使用的是默认的URL格式。
      *
      */
     public function actionRoutes()
     {
        return $this->render('routes');
     }
     /**
      * 
      * @Yii模型 
      * 模型是从 yii\base\Model 扩展，那么它的所有成员变量应该为公共且是非静态的属性 
      * 默认是对象格式，转换数组:$model->attributes 转换JSON:\yii\helpers\Json::encode
      */
      public function actionShowContactModel()
      {
        $mContactForm = new \app\models\ContactForm();
        $mContactForm->name = '杨捷成';
        $mContactForm->email = '2064320087@qq.com';
        $mContactForm->subject = '物联网云平台';
        $mContactForm->body = '中国水利网站2017年7月26日讯 （记者 熊渤 特约记者 谢奇）7月26日，湖北省政府新闻办举行“学习贯彻湖北省第十一次党代会精神 以优异成绩迎接党的十九大”系列新闻发布会之二——“湖北水利设施补强工程思路举措”新闻发布会。2017年省政府工作报告提出了“全面实施农村饮水安';
        echo '<pre>';print_R($mContactForm->attributes);
        return \yii\helpers\Json::encode($mContactForm);
      }
    public function actionRegistration() {
       /*$mRegistration = new RegistrationForm();
       if($mRegistration->load(Yii::$app->request->post()) && $mRegistration->validate()){
            Yii::$app->session->setFlash('contactFormSubmitted');
            var_dump($mRegistration);exit;
            return $this->refresh();            
       }else{
            $errors = $mRegistration->errors;
            print_r($errors);exit;
       }*/
       $model = new RegistrationForm();
       //ajax提交验证
       if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format =  \yii\web\Response::FORMAT_JSON;
            //print_r(ActiveForm::validate($model));exit();
       }
       return $this->render('registration', ['model' => $model]);
    } 
    //动态验证
    public function actionAdHocValidation()
    {
        $model = DynamicModel::validateData([
            'username' => 'hippo',
            'email' => 'yiibai.com@gmail.com'
        ],[
            [['username','email'],'string','max' => 12],
            ['email','email']
        ]);
        if($model->hasErrors()){
            var_dump($model->errors);
        }else{
            echo 'success';
        }
    }
    //会话SESSION 
    public function actionOpenAndCloseSession()
    {
        $session = \Yii::$app->session;
        $session->open();//打开session
        if($session->isActive){
            echo '成功开启SESSION';
        }
        $session->close();//关闭session
        $session->destroy();//销毁session
    }
    //访问会话
    public function actionAccessSession()
    {
        $session = \Yii::$app->session;
        $session->set('Language','Chinese');//设置单个session变量
        echo $session->get('Language');//读取单个session变量
        $session->remove('Language');//删除某个session变量
        if(!$session->has('Language')){//检验某个session是否存在
            echo 'chinese is not set';
        }
        $session['captcha'] = [
          'value' => 'Yiibai',
          'lifetime' => 7200,
        ];
        print_r($session['captcha']);
    }
    //访问闪存(flash)
    public function actionShowFlash()
    {
        $session = Yii::$app->session;
        $session->setFlash('greeting','Hello Every One');
        return $this->render('showflash');
    }
    //COOKIE
    public function actionReadCookies()
    {
        $cookies = \Yii::$app->request->cookies;
        echo '<pre>';
        //print_r($cookies);exit();
        $lang = $cookies->getValue('username');//读取该cookie的value值
        //var_dump($lang);
       // print_r( $cookies->get('username'));exit;
        if($cookie = $cookies->get('username') !== null){//$cookies->get()读取该cookie结果是一个对象
            $lang = is_object($cookie)?$cookie->value:'';
        }
        if(isset($cookies['username'])){//等同于$cookies->get()读取该cookie结果是一个对象
            //print_r($cookies['username']);exit;
            $lang = $cookies['username']->value;
        }
        if ($cookies->has('username')) echo "Current language: $lang";//判断cookie是否存在 
    }
    public function actionSendCookies()
    {
        $cookies = Yii::$app->response->cookies; 
           $cookies->add(new \yii\web\Cookie([ 
              'name' => 'Language', 
              'value' => 'Chinese', 
              'expire' => time()+60
           ])); 
           $cookies->add(new \yii\web\Cookie([
              'name' => 'username', 
              'value' => 'Hippo', 
           ])); 
           $cookies->add(new \yii\web\Cookie([ 
              'name' => 'country', 
              'value' => 'China', 
           ])); 
    }
    //文件上传
    public function actionLoadImage()
    {
           $model = new UploadImageForm();
           if (Yii::$app->request->isPost) {
              $model->image = UploadedFile::getInstance($model, 'image');
              if ($model->upload()) {
                 // file is uploaded successfully
                 echo "File successfully uploaded";
                 return;
              }
           }
           return $this->render('upload', ['model' => $model]);
    }
    //格式化
    public function actionFormatter(){
       return $this->render('formatter');
    }
    //分页
    public function actionPagination()
    {
        $query = MyUser::find();
        $totalcount = $query->count();//获取总记录数
        $pagesize = \Yii::$app->request->get('pagesize');
        $defaultPageSize = !empty($pagesize) ? $pagesize : 5;
        $pagination = new Pagination(['totalCount' => $totalcount ,'defaultPageSize' => $defaultPageSize]);//使用分页
        $models = $query->offset($pagination->offset)->limit($pagination->limit)->all();//获取总记录  find()->toArray() asArray()
        return $this->render('pagination', [
          'models' => $models,
          'pagination' => $pagination,
        ]);
    }
    //排序
    public function actionSorting()
    {
        $sort = new Sort(['attributes' => ['id','name','email']]);
        $models = MyUser::find()->orderBy($sort->orders)->all();
        return $this->render('sorting', [
          'models' => $models,
          'sort' => $sort,
        ]);
    }
    //属性
    public function actionProperties()
    {
        $object = new Taxi();
        $phone = $object->getPhone();
        var_dump($phone);
        $object->setPhone('18483699374');
        $object->phone = '13800138000';
        var_dump($phone);
    }
    //Active 数据提供者
    public function actionDataProvider()
    {
        $query = MyUser::find();//对象变为数组->asArray()
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        $users = $provider->getModels();
        echo '<pre>';print_r($users);
    }
    //SQL数据提供者
    public function actionData2Provider()
    {
        $count = Yii::$app->db->createCommand('SELECT COUNT(id) AS count FROM user')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM user',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => ['id','name','email'],
            ]
        ]);
        $users = $provider->getModels();
        echo '<pre>';print_r($users);
    }
    //数组数据提供者
    public function actionData3Provider()
    {
        $data = MyUser::find()->asArray()->all();
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 3
            ],
            'sort' => [
                'attributes' => ['id','name']
            ]
        ]);
        $users = $provider->getModels();
        echo '<pre>';print_r($users);
    }
    //数据Widgets
    public function actionDataWidget()
    {
        $model = MyUser::find()->orderBy('id desc')->one();
        $viewtype = \Yii::$app->request->get('viewtype');
        if($viewtype == 'grid' || $viewtype == 'grid2' || $viewtype == 'grid3'){
            $dataprovider = new ActiveDataProvider([
                'query' => MyUser::find(),
                'pagination' => [
                    'pageSize' =>10
                ]
            ]);
            return $this->render('datawidget',['dataProvider' => $dataprovider,'viewtype' => $viewtype]);
        }
        return $this->render('datawidget',['model' => $model]);
    }
    //数据widgets之ListView
    public function actionDataListviewWidget()
    {
        $dataprovider = new ActiveDataProvider([
            'query' => MyUser::find(),
            'pagination' => [
                'pageSize' =>10
            ]
        ]);
        return $this->render('datawidget',['dataProvider' => $dataprovider]);
    }
    /*事件学习*/
    public function actionTestEvent()
    {
        $model = new MyUser();
        $model->name = 'JieChengYang';
        $model->email = '2064320087@qq.com';
        if($model->save()){//保存
            $model->trigger(MyUser::EVENT_NEW_USER);//触发事件
        }
    }
    /*行为学习:现在，当我们创建或更新的用户，它的 name 属性将会自动转换为大写。*/
    public function actionTestBehavior()
    {
        $model = new MyUser();
        $model->name = "fengruixue";
        $model->email = "fengruixue.com@gmail.com";
        if($model->save()){
            echo '<pre>';
            print_r(MyUser::find()->asArray()->all());
        }
    }
    /*依赖注入*/
    public function actionTestInterface()
    {
        $container = new \yii\di\Container();
        $container->set("\app\components\MyInterface","\app\components\First");
        $obj = $container->get("\app\components\MyInterface");
        $obj->test(); // print "First class"
        $container->set("\app\components\MyInterface","\app\components\Second");
        $obj = $container->get("\app\components\MyInterface");
        $obj->test(); // print "Second class
    }
    /*数据访问对象*/
    public function actionTestDb()
    {
        $users = Yii::$app->db->createCommand("SELECT * FROM `user` LIMIT 5")->queryAll();//返回一组行。每行是列名称和值的关联数组。如果查询返回没有结果，则返回空数组
        print_R($users);
        $uone = Yii::$app->db->createCommand("SELECT * FROM `user` WHERE `id`=1")->queryOne();//返回一行(第一行)如果查询没有结果，则返回false
        print_r($uone);
        $userName = Yii::$app->db->createCommand('SELECT name FROM user')->queryColumn();//返回单个列(第一列)如果查询返回没有结果，则返回空数组
        echo '<hr/>';
        print_r($userName);
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user')->queryScalar();//返回标量值,如果查询没有结果，则返回false
        var_dump($count);
    }
    /*创建一个 SQL命令*/
    public function actionTestDb2() {
       $firstUser = Yii::$app->db->createCommand('SELECT * FROM user WHERE id = :id')
          ->bindValue(':id', 1)
          ->queryOne();
       var_dump($firstUser);echo '<hr/>';
       $params = [':id' => 2, ':name' => 'User2'];
       $secondUser = Yii::$app->db->createCommand('SELECT * FROM user WHERE
          id = :id AND name = :name')
          ->bindValues($params)
          ->queryOne();
       /*
            bindValue() − 绑定单个参数值
            
            bindValues() − 绑定多个参数值
       */
       var_dump($secondUser);echo '<hr/>';
          //another approach
       $params = [':id' => 3, ':name' => 'User3'];
       $thirdUser = Yii::$app->db->createCommand('SELECT * FROM user WHERE
          id = :id AND name = :name', $params)
          ->queryOne();
       var_dump($thirdUser);
    }
    /*INSERT, UPDATE 和 DELETE 查询*/
    public function actionTestDb3() {
          // INSERT (table name, column values)
          Yii::$app->db->createCommand()->insert('user', [
             'name' => 'My New User',
             'email' => 'mynewuser@gmail.com',
          ])->execute();
          $user = Yii::$app->db->createCommand('SELECT * FROM user WHERE name = :name')
             ->bindValue(':name', 'My New User')
             ->queryOne();
          var_dump($user);echo '<hr/>';
          // UPDATE (table name, column values, condition)
          Yii::$app->db->createCommand()->update('user', ['name' => 'My New User
             Updated'], 'name = "My New User"')->execute();
          $user = Yii::$app->db->createCommand('SELECT * FROM user WHERE name = :name')
             ->bindValue(':name', 'My New User Updated')
             ->queryOne();
          var_dump($user);echo '<hr/>';
          // DELETE (table name, condition)
          Yii::$app->db->createCommand()->delete('user', 'name = "My New User
             Updated"')->execute();
          $user = Yii::$app->db->createCommand('SELECT * FROM user WHERE name = :name')
             ->bindValue(':name', 'My New User Updated')
             ->queryOne();
          var_dump($user);
    }
    /*查询生成器*/
    public function actionTestDb4() {
       //generates "SELECT id, name, email FROM user WHERE name = 'User10';"
       $user = (new \yii\db\Query())
          ->select(['id', 'name', 'email'])
          ->from('user')
          ->where(['name' => 'User10'])
          ->one();
       var_dump($user);
    }
    /*WHERE()函数*/
    public function actionTestDb5() {
       $user = (new \yii\db\Query())
          ->select(['id', 'name', 'email'])
          ->from('user')
          ->where([
             'name' => 'User5',
             'email' => 'user55@gmail.com'
          ])
          ->one();
       var_dump($user);
    }
    /**
     *运算符格式化允许定义任意条件的格式如下 -
        [operator, operand1, operand2]
        操作符可以是 -
        and − ['and', 'id = 1', 'id = 2'] 会产生类似： id = 1 AND id = 2
        
        between − ['between', 'id', 1, 15] 会产生类似：id BETWEEN 1 AND 15
        
        not between − 类似 between 操作符, 但是 BETWEEN 被替换为 NOT BETWEEN
        
        in − ['in', 'id', [5,10,15]] 会产生类似： IN (5,10,15)
        
        not in − 类似  in 操作符,但是 IN 被替换为 NOT IN
        
        like − ['like', 'name', 'user'] 会产生类似： name LIKE '%user%'
        
        or like − 类似  like 操作符, 但是 OR 用来分割 LIKE 谓词
        
        not like − 类似于 like 操作符, 但是 LIKE 被 NOT LIKE 替代； 
        
        or not like − 类似 not like 运算符，但或用来连接 NOT LIKE 谓词
        
        exists − 要求一个操作数必须是 yii\db\Query 类的一个实例
        
        not exists − 类似 exists 操作符，但是构建了一个NOT EXISTS(子查询)的表达式
        
        <, <=, >, >=, 或任何其他数据库操作符: ['<', 'id', 10] 会产生类似： id<10 
     * 
     */
    public function actionTestDb6() {
        $users = (new \yii\db\Query())
          ->select(['id', 'name', 'email'])
          ->from('user')
          ->where(['between', 'id', 5, 7])
          ->all();
        var_dump($users);
    }
    /*OrderBy()函数*/
    public function actionTestDb7() {
       $users = (new \yii\db\Query())
          ->select(['id', 'name', 'email'])
          ->from('user')
          ->orderBy('name DESC')
          ->all();
       var_dump($users);
    }
    /*groupBy()函数*/
    public function actionTestDb8() {
       $users = (new \yii\db\Query())
          ->select(['id', 'name', 'email'])
          ->from('user')
          ->groupBy('name')
          ->having('id < 5')
          ->all();
       var_dump($users);
    }
    /*limit() 和 offset() 方法定义了 LIMIT 和 OFFSET 段。*/
    public function actionTestDb9() {
       $users = (new \yii\db\Query())
          ->select(['id', 'name', 'email'])
          ->from('user')
          ->limit(5)
          ->offset(5)
          ->all();
       var_dump($users);
    }
    /*
    yii\db\Query 类提供了一组用于不同的目的的方法 -
    all() − 返回一行为名称-值对的数组。
    one() − 返回第一行
    column() − 返回第一列
    scalar() − 返回结果的第一行和第一列的标量值。
    exists() − 返回指示查询是否包含任何结果值
    count() 返回COUNT查询结果
    其他聚集查询方法 - 包括：sum($q), average($q), max($q), min($q)。$q 参数可以是列名 或 DB 表达式。
    */
    //关联查询1:n
    public function actionGuanLian()
    {
        //查询客户的所有订单 SELECT a.username,b.* FROM `byt_user` a LEFT JOIN `byt_order` b ON a.id=b.user_id;
        $customer = UserForm::find()->where(['username' => 'yangjiecheng'])->one();//->asArray()
        //$lists = $customer->hasMany(Order::className(),['user_id' => 'id'])->asArray()->all();
        //$lists = $customer->getOrders();
        $lists = $customer->orders;
        echo '<pre>';print_r($lists);
    }
    //关联查询1:1
    public function actionGuanLian2(){
        //查询某个订单对应的客户信息 SELECT b.*,a.id FROM `byt_order` a LEFT JOIN `byt_user` b ON a.user_id = b.id;
        $order = Order::find()->where(['id' => 1])->one();
        //$users = $order->getUsers();
        $users = $order->users;
        echo '<pre>';print_r($users);
    }
    //// 匹配的回调函数被调用了！这个页面只有每年的10月31号能访问（译者注：原文在这里说该方法是回调函数不确切，读者不要和 `matchCallback` 的值即匿名的回调函数混淆理解）
    public function actionSpecialCallback()
    {
         return $this->render('happy-halloween');
    }
}
