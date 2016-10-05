<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsFaith */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-faith-form">

    <?php $form = ActiveForm::begin(); ?>   

    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'faith')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
   </div>

    <?php ActiveForm::end(); ?>

</div>
