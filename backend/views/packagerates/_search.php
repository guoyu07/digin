<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PackageratesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packagerates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rid') ?>

    <?= $form->field($model, 'pkgid') ?>

    <?= $form->field($model, 'withincityrate') ?>

    <?= $form->field($model, 'zonerate') ?>

    <?= $form->field($model, 'metrorate') ?>

    <?php // echo $form->field($model, 'RoI-Arate') ?>

    <?php // echo $form->field($model, 'RoI-Brate') ?>

    <?php // echo $form->field($model, 'spldestrate') ?>

    <?php // echo $form->field($model, 'weightmultiple') ?>

    <?php // echo $form->field($model, 'addwithincityrate') ?>

    <?php // echo $form->field($model, 'addzonerate') ?>

    <?php // echo $form->field($model, 'addmetrorate') ?>

    <?php // echo $form->field($model, 'addRoI-Arate') ?>

    <?php // echo $form->field($model, 'addRoI-Brate') ?>

    <?php // echo $form->field($model, 'addspldestrate') ?>

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
