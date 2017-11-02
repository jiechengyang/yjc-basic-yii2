<?php
   namespace app\models;
   use yii\base\Model;
   class UploadImageForm extends Model {
      public $image;
      public function rules() {
         return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png,jpeg'],
         ];
      }
      public function upload() {
         if ($this->validate()) {
            //$path = dirname();
            $path = \Yii::getAlias("@webroot").'/uploads/';
            $filepath = $this->__CreateFileName($path,$this->image->extension);
            $this->image->saveAs($filepath['a']);
            return true;
         } else {
            return false;
         }
      }
      private function __CreateFileName($uploadpath,$extension)
      {
        $path = $uploadpath.date('Y-m');
        if(!is_dir($path)){
            mkdir($path,0700);
        }
        $key = md5(time().\Yii::$app->getSecurity()->generateRandomString());
        $filename = $path.'/'.$key.'.'.$extension;
        return array('a'=>$filename,'p'=>date('Y-m').'/'.$key.'.'.$extension);
      }
   }
