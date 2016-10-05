<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsSpouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-spouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <!--?= $form->field($model, 'anniversary_date')->textInput() ?-->

    <?= $form->field($model, 'crtdt')->textInput() ?>

    <?= $form->field($model, 'crtby')->textInput() ?>

    <?= $form->field($model, 'upddt')->textInput() ?>

    <?= $form->field($model, 'updby')->textInput() ?>


    <?php      echo Html::label('Anniversary Date', ['class'=>'anivdt']);
               echo DatePicker::widget([
                 'model' => $model,                 
                 'attribute' => 'anniversary_date',                       
                 'dateFormat' => 'yyyy-MM-dd',
                 //'options' => ['class' => 'form-control']
              ]);  
               ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
