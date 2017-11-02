<?php
 namespace app\components;
 use yii\validators\Validator;
 class CityValidator extends Validator
 {
    public function validateAttribute($model,$attribute)
    {
        //var_dump($model->$attribute);
        if (!in_array($model->$attribute, ['Paris', 'London'])) {
            $this->addError($model, $attribute, 'The city must be either "Haikou"
           or "Guangzhou".');
        }      
    }
 }