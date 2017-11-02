<?php
   use yii\widgets\ActiveForm;
?>
<div style="margin-top: 100px;">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($model, 'image')->fileInput() ?>
   <button>Submit</button>
<?php ActiveForm::end() ?>
</div>
