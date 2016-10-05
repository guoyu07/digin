<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Bulkrates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bulkrates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pkgid')->textInput() ?>

    <?= $form->field($model, 'withincityrate')->textInput() ?>

    <?= $form->field($model, 'zonerate')->textInput() ?>

    <?= $form->field($model, 'metrorate')->textInput() ?>

    <?= $form->field($model, 'RoIArate')->textInput() ?>

    <?= $form->field($model, 'RoIBrate')->textInput() ?>

    <?= $form->field($model, 'spldestrate')->textInput() ?>

    <?= $form->field($model, 'minimumweight')->textInput() ?>

    <?= $form->field($model, 'weightmultiple')->textInput() ?>

    <?= $form->field($model, 'crtdt')->textInput() ?>

    <?= $form->field($model, 'crtby')->textInput() ?>

    <?= $form->field($model, 'upddt')->textInput() ?>

    <?= $form->field($model, 'updby')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
