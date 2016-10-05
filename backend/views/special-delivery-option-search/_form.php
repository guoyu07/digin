<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SpecialDeliveryOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="special-delivery-option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'delivery_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'km_radius')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_all')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
