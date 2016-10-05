<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BrandNameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-name-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'brand_name') ?>

    <?= $form->field($model, 'crtby') ?>

    <?= $form->field($model, 'crtdt') ?>

    <?= $form->field($model, 'updby') ?>

    <?php // echo $form->field($model, 'upddt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
