<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VendorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'vid') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'businessname') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'vendtor_type') ?>

    <?php // echo $form->field($model, 'phone1') ?>

    <?php // echo $form->field($model, 'phone2') ?>

    <?php // echo $form->field($model, 'aboutme') ?>

    <?php // echo $form->field($model, 'address1') ?>

    <?php // echo $form->field($model, 'address2') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'pin') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'lng') ?>

    <?php // echo $form->field($model, 'googleaddr') ?>

    <?php // echo $form->field($model, 'plan') ?>

    <?php // echo $form->field($model, 'subscriptionenddate') ?>

    <?php // echo $form->field($model, 'shift') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'delivery') ?>

    <?php // echo $form->field($model, 'dppkgid') ?>

    <?php // echo $form->field($model, 'Is_blocked') ?>

    <?php // echo $form->field($model, 'Is_active') ?>

    <?php // echo $form->field($model, 'isbyfranchisee') ?>

    <?php // echo $form->field($model, 'txnid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'pwd') ?>

    <?php // echo $form->field($model, 'currencycode') ?>

    <?php // echo $form->field($model, 'payu_pal_id') ?>

    <?php // echo $form->field($model, 'paymentgateway') ?>

    <?php // echo $form->field($model, 'clicks') ?>

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
