<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier; //过滤HTML内容
use app\components\HelloWidget;//自定义小部件
use yii\widgets\Menu;
use app\assets\AppAsset;//使用资源包
AppAsset::register($this);// 先注册资源     $this 代表视图对象 
use yii\imagine\Image;//图片处理控件
use kartik\datetime\DateTimePicker;//日期控件
$this->title = '关于我们';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, Yii教程, Yii视图,
  meta, 标签']);
$this->registerMetaTag(['name' => 'description', 'content' => '这是一个页面的描述!'], 'description');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
	<p>
    	<?= Html::encode('<script>alert(\'弹出框\')</script><h1>ENCODE EXAMPLE</h1>')?>
    </p>
    <p>
    	<?= HtmlPurifier::process("<script>alert('alert!')</script><h1> HtmlPurifier EXAMPLE</h1>")?>
    </p>
    <p>
      <b>email:</b> <?= $email ?>
   </p>
   <p>
      <b>phone:</b> <?= $phone ?>
   </p>
    <?= $this->render('_view1.php')?>
    <?= $this->render('_view2')?>
    <code><?= __FILE__ ?></code>
</div>
<div>
	<?= HelloWidget::widget(['message' => 'Good morning']) ?>
    <p>
    	<?php  //HelloWidget::begin();?>
         content that may contain <tag>'s
         <?php //HelloWidget::end();?>
    </p>
</div>
<div>
<?php
echo Menu::widget([
    'items' => [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        ['label' => 'Home', 'url' => ['site/index']],
        // 'Products' menu item will be selected as long as the route is 'product/index'
        ['label' => 'Products', 'url' => ['product/index'], 'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]],
        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    ],
]);
// generate a thumbnail image
Image::thumbnail('@webroot/img/test-img.jpg', 120, 120)
    ->save(Yii::getAlias('@runtime/thumb-test-image.jpg'), ['quality' => 50]);
?>
</div>
<div>
   <?php
      echo DateTimePicker::widget([
         'name' => 'dp_1',
         'type' => DateTimePicker::TYPE_INPUT,
         'value' => date('Y-m-d H:i:s'),
         'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii'
         ]
      ]);
   ?>
</div>