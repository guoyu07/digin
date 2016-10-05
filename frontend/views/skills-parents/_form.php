<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsParents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-parents-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!--?= $form->field($model, 'userid')->textInput() ?-->

         
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'father_firstname')->textInput(['maxlength' => true]) ?>
        </div>
     </div>
             
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'father_lastname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'mother_firstname')->textInput(['maxlength' => true]) ?>
          </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'mother_lastname')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($sibblingmodel, 'firstname')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
             
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($sibblingmodel, 'lastname')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($sibblingmodel, 'link')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($sibblingmodel, 'relation')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($spousemodel, 'firstname')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($spousemodel, 'lastname')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
         
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($spousemodel, 'link')->textarea(['rows' => 6]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($spousemodel, 'anniversary_date')->textInput() ?>
         </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
