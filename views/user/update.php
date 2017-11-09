<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'user-update-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <?= $form->field($user, 'username') ?>

    ...other input fields...
    
    <?= $form->field($profile, 'website') ?>

    <?= Html::submitButton('更新数据', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>