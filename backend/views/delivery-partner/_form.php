<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DeliveryPartner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div> 
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'emailid')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'fuelsurcharge')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'CODmin')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'COD')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'RTOCharge')->textInput() ?>
        </div>
    </div>  
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'reversepickupsurcharge')->textInput() ?>
        </div>
    </div>
            
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'COF')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">        
            <?= $form->field($model, 'volwtdenominator')->textInput() ?>
        </div>
    </div>
            
   <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'octroisurcharge')->textInput() ?>
        </div>
    </div>
            
   <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'holidaydeliverycharge')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
