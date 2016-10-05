<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Diginleads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diginleads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vid')->textInput() ?>

    <?= $form->field($model, 'leadType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leadName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leadEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leadPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crtdt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
