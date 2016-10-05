<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsParentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-parents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'parentid') ?>

    <?= $form->field($model, 'userid') ?>   

    <?= $form->field($model, 'father_firstname') ?>

    <?php // echo $form->field($model, 'father_lastname') ?>

    <?php // echo $form->field($model, 'mother_firstname') ?>

    <?php // echo $form->field($model, 'mother_lastname') ?>

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
