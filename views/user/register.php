<?php
	use yii\helpers\Html;
	use yii\bootstrap\Alert;
	use yii\widgets\ActiveForm;
?>
<?php
	$UserForm = ActiveForm::begin(['action' => '?r=user/regsave','method'=>'post','id'=>'RegUserForm']);
	/**
	 *	@Active::field()--生成一个表单字段
	 *  @表单字段与模型和属性相关联。它包含一个标签、一个输入和一个错误消息，并使用它们与最终用户交互以收集其对该属性的输入。
	 *	@参数二：属性名或表达式。关于属性表达式的格式，请参见yii \helper \Html::getAttributeName()
	 *	@参数三:字段对象的附加配置。这些属性是yii \widgets\ ActiveField或子类的属性，这取决于$ fieldClass的值
	 *  Attribute:属性
	 */
?>
<?= $UserForm->field($model, 'UserName')->label('登录名')->textInput(['maxlength' => 20,'class'=>'form-control','OnClick'=>'return CheckForm(this)']) ?>
<?= $UserForm->field($model, 'TrueName')->label('真实姓名')->textInput(['maxlength' => 20,'class'=>'form-control','OnClick'=>'return CheckForm(this)']) ?>
<?= $UserForm->field($model, 'PassWord')->label('密码')->passwordInput(['maxlength' => 20]) ?>
<?= $UserForm->field($model, 'PassWordToo')->label('再次输入密码')->passwordInput(['maxlength' => 20]) ?>
<?= $UserForm->field($model,'Sex')->label('性别')->radioList(['1'=>'男','2'=>'女']);?>
<?= $UserForm->field($model, 'Edu')->label('学历')->dropDownList(['1'=>'大学','2'=>'高中','3'=>'初中'], ['prompt'=>'请选择','style'=>'width:120px']) ?>
<?= $UserForm->field($model, 'File')->label('单个文件上传')->fileInput() ?>
<?= $UserForm->field($model, 'uploadFile[]')->label('多文件上传')->fileInput(['multiple'=>'multiple']); ?>
<?= $UserForm->field($model, 'Hobby')->label('爱好')->checkboxList(['0'=>'篮球','1'=>'足球','2'=>'羽毛球','3'=>'乒乓球']) ?>
<?= $UserForm->field($model, 'Info')->label('基本信息说明')->textarea(['rows'=>3,'cols'=>10]) ?>
<?= Html::activeHiddenInput($model,'Id',['value' => 0]) ?>
<?= Html::submitButton('提交', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
<?= Html::resetButton('重置', ['class'=>'btn btn-primary','name' =>'reset-button','style'=>'margin-left:10px']) ?>
<?php ActiveForm::end(); ?>
<?php //JsBlock::begin() ?>
  <script>
/*    $(function () {
      jQuery('form#apitool').on('beforeSubmit', function (e) {
        var $form = $(this);
        $.ajax({
          url: $form.attr('action'),
          type: 'post',
          data: $form.serialize(),
          success: function (data) {
            // do something
          }
        });
      }).on('submit', function (e) {
        e.preventDefault();
      });*/
  </script>
<?php //JsBlock::end() ?>
