<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsPassportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-passport-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'nationality') ?>

    <?= $form->field($model, 'passport_no') ?>

    <?= $form->field($model, 'issuedate') ?>

    <?php // echo $form->field($model, 'expirydate') ?>

    <?php // echo $form->field($model, 'scancopy') ?>

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
