<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsVehiclesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-vehicles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'vcid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'vehicle_type') ?>

    <?= $form->field($model, 'make') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'registration_no') ?>

    <?php // echo $form->field($model, 'crtdt') ?>

    <?php // echo $form->field($model, 'crtby') ?>

    <?php // echo $form->field($model, 'upddt') ?>

    <?php // echo $form->field($model, 'updby') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
