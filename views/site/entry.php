<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($EntryFormModel, 'name') ?>

    <?= $form->field($EntryFormModel, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php
		if( Yii::$app->getSession()->hasFlash('success') ) {  
			echo Alert::widget([  
				'options' => [  
					'class' => 'alert-success', //这里是提示框的class  
				],  
				'body' => Yii::$app->getSession()->getFlash('success'), //消息体  
			]);  
		}  
		if( Yii::$app->getSession()->hasFlash('error') ) {  
			echo Alert::widget([  
				'options' => [  
					'class' => 'alert-warning error-info', //alert-error alert-info alert-warning 
				],  
				'body' => Yii::$app->getSession()->getFlash('error'),  
			]);  
		}
		//$this->registerJsFile( 'myScript.js' );
		//$this->registerJS('$(".error-info").css("{backgroud-color:red}")'); 
?>
<?php ActiveForm::end(); ?>
<script type="text/javascript">
	$(document).ready(function(e) {
			byj_js.init();
    });
</script>