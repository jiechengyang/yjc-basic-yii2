<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';//设置页面title
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}\n{error}</div><div class=\"col-md-8\">{hint}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
			'inputOptions' => ['class' => 'form-control']
        ],
    ]); ?>

        <?= $form->field($model, 'username',['labelOptions' => ['label' => '用户名']])->textInput(['autofocus' => true])->hint('字母数字下划线') ?>

        <?= $form->field($model, 'password',['labelOptions' => ['label' => '密码']])->passwordInput() ?>

        <?= $form->field($model, 'rememberMe',['labelOptions' => ['label' => '记住我']])->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}{label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::a('立即注册',['user/register'], ['class' => 'btn btn-primary profile-link'])?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
