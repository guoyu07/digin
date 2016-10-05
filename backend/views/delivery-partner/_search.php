<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DeliveryPartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-partner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dpid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'fuelsurcharge') ?>

    <?= $form->field($model, 'CODmin') ?>

    <?= $form->field($model, 'COD') ?>

    <?php // echo $form->field($model, 'RTOCharge') ?>

    <?php // echo $form->field($model, 'reversepickupsurcharge') ?>

    <?php // echo $form->field($model, 'COF') ?>

    <?php // echo $form->field($model, 'volwtdenominator') ?>

    <?php // echo $form->field($model, 'octroisurcharge') ?>

    <?php // echo $form->field($model, 'holidaydeliverycharge') ?>

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
