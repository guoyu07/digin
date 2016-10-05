<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsOccupation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-occupation-form">

    <?php $form = ActiveForm::begin(); ?>

   <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'occupationtype')->textInput(['maxlength' => true]) ?>
         </div>
   </div>
    
   <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
        </div>
   </div>
    
   <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
        </div>
   </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'tenure')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'fromdate')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'todate')->textInput() ?>
        </div>
    </div>
    
    <!--div class="row">
         <div class="col-xs-3">
            < ?php $skills=  \frontend\models\Skills::find()->all();
                  $skilldata=  \yii\helpers\ArrayHelper::map($skills, 'sid', 'skill');
                echo $form->field($userskillmodel, 'skillid')->dropDownList($skilldata,['prompt'=>'Select']);
                //echo Html::button('Add Skill',[\yii\helpers\Url::to('skills/index')]);
                echo Html::a('Add Skill', ['/skills/index'], ['class'=>'btn btn-primary' , 'target'=>'_blank']); ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($userskillmodel, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($consultantmodel, 'consultant_type')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($consultantmodel, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($consultantmodel, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
   <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($consultantmodel, 'email')->textInput(['maxlength' => true]) ?>
        </div>
   </div>
    
    <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($testmodel, 'quotes')->textarea(['rows' => 6]) ?>
        </div>
   </div>
    
   <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($testmodel, 'name')->textInput(['maxlength' => true]) ?>
       </div>
   </div>
    
    <div class="row">
         <div class="col-xs-3">
            < ?= $form->field($testmodel, 'image')->fileInput() ?>
        </div>
   </div-->
    
    <div class="col-xs-3">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
