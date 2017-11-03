<?php
    echo $sort->link('id').'|'.$sort->link('name').'|'.$sort->link('email'),'<hr/>';
?>
<?php foreach($models as $model):?>
<?=$model->id?>
|
<?=$model->name?>
|
<?=$model->email?>
<hr />
<?php endforeach; ?>