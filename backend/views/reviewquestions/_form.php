<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Reviewquestions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviewquestions-form">

    
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
    <div class="col-xs-5">
        <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





