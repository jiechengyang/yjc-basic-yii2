<?php
   // use yii\helpers\Html;
    //use yii\widgets\ActiveForm;
   use yii\bootstrap\ActiveForm;
   use yii\bootstrap\Html;
?>
<style>
div.required label:after {
    content: " *";
    color: red;
}
</style>
<div class="row" style="margin-top: 100px;">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'enableAjaxValidation'=>true,//允许AJAX验证
            'fieldConfig' => [
                'template' => "<div style=\"height:100px;\">{label}<div class=\"col-lg-6\">{input}\n{error}</div><div class=\"col-md-3\">{hint}</div></div>",
                'labelOptions' => ['class' => 'col-lg-3 control-label'],
                'inputOptions' => ['class' => 'form-control' ]
            ],
            
        ])?>
        <?= $form->field($model, 'username')->textInput()->hint('Please enter your name')->label('用户名') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'photos[]')->fileInput(['multiple'=>'multiple']) ?>
        <?= $form->field($model, 'subscriptions[]')->checkboxList(['a' => 'Item A',
         'b' => 'Item B', 'c' => 'Item C']) ?>
        <div class = "form-group">
         <?= Html::submitButton('提交', ['class' => 'btn btn-primary',
            'name' => 'registration-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>