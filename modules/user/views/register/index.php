<?php
	use yii\helpers\Html;
?>
<?php
$this->title = '这是一个自定义模块';
$this->params['breadcrumbs'][] = $this->title;
//echo Html::encode($this->title);
echo $this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php']);
echo $this->registerMetaTag(['name' => 'description', 'content' => 'This is my cool website made with Yii!'], 'description');
echo $this->registerMetaTag(['name' => 'description', 'content' => 'This website is about funny raccoons.'], 'description');
echo $this->registerLinkTag([
    'title' => 'Live News for Yii',
    'rel' => 'alternate',
    'type' => 'application/rss+xml',
    'href' => 'http://www.yiiframework.com/rss.xml/',
]);
?>
<h1>Hello,这是一个自定义模块!</h1> 