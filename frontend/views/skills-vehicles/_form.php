<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsVehicles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-vehicles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'vehicle_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'make')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_no')->textInput() ?>

    <?= $form->field($model, 'crtdt')->textInput() ?>

    <?= $form->field($model, 'crtby')->textInput() ?>

    <?= $form->field($model, 'upddt')->textInput() ?>

    <?= $form->field($model, 'updby')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
