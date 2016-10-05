<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\diginleadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diginleads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vid') ?>

    <?= $form->field($model, 'leadType') ?>

    <?= $form->field($model, 'leadName') ?>

    <?= $form->field($model, 'leadEmail') ?>

    <?php // echo $form->field($model, 'leadPhone') ?>

    <?php // echo $form->field($model, 'crtdt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
