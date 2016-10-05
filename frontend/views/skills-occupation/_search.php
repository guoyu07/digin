<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsOccupationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-occupation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ocid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'occupationtype') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'designation') ?>

    <?php // echo $form->field($model, 'tenure') ?>

    <?php // echo $form->field($model, 'fromdate') ?>

    <?php // echo $form->field($model, 'todate') ?>

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
