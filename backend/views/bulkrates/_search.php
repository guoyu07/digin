<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BulkratesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bulkrates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pkgid') ?>

    <?= $form->field($model, 'withincityrate') ?>

    <?= $form->field($model, 'zonerate') ?>

    <?= $form->field($model, 'metrorate') ?>

    <?php // echo $form->field($model, 'RoIArate') ?>

    <?php // echo $form->field($model, 'RoIBrate') ?>

    <?php // echo $form->field($model, 'spldestrate') ?>

    <?php // echo $form->field($model, 'minimumweight') ?>

    <?php // echo $form->field($model, 'weightmultiple') ?>

    <?php // echo $form->field($model, 'crtdt') ?>

    <?php // echo $form->field($model, 'crtby') ?>

    <?php // echo $form->field($model, 'upddt') ?>

    <?php // echo $form->field($model, 'updby') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
