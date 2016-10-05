<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendortype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendortype-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <!--?= $form->field($model, 'crtdt')->textInput() ?>

    < ?= $form->field($model, 'crtby')->textInput() ?>

    < ?= $form->field($model, 'upddt')->textInput() ?>

    < ?= $form->field($model, 'updby')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>

  </div>

    <?php ActiveForm::end(); ?>

</div>
