<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsBanksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-banks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'bankname') ?>

    <?= $form->field($model, 'branchname') ?>

    <?= $form->field($model, 'account_no') ?>

    <?php // echo $form->field($model, 'IFSC_no') ?>

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
