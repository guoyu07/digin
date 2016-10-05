<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillCommonDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skill-common-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'birthdate') ?>

    <?= $form->field($model, 'birthplaceid') ?>

    <?= $form->field($model, 'religionid') ?>

    <?php // echo $form->field($model, 'faithid') ?>

    <?php // echo $form->field($model, 'castid') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'marrital_status') ?>

    <?php // echo $form->field($model, 'landline') ?>

    <?php // echo $form->field($model, 'blog') ?>

    <?php // echo $form->field($model, 'annual_income') ?>

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
