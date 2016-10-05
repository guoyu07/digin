<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BrandName */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-name-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>
            </div>
    </div>

    <!--?= $form->field($model, 'crtby')->textInput() ?>

    < ?= $form->field($model, 'crtdt')->textInput() ?>

    < ?= $form->field($model, 'updby')->textInput() ?>

    < ?= $form->field($model, 'upddt')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
