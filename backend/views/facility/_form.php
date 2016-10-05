<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Facility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facility-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ?= $form->field($model, 'id')->textInput() ?-->
    <div class="row">       
        <div class="col-xs-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
     </div>
    
     <div class="row">       
        <div class="col-xs-3">
                <?= $form->field($model, 'description')->textarea() ?>
        </div>
     </div>
    <!--?= $form->field($model, 'crtby')->textInput() ?>

    < ?= $form->field($model, 'crtdt')->textInput() ?>

    < ?= $form->field($model, 'updtby')->textInput() ?>

    < ?= $form->field($model, 'upddt')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>

  </div>

    <?php ActiveForm::end(); ?>

</div>
