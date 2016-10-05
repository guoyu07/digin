<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    
    <?php $features=  \backend\models\Features::find()->all();
           //if(!isset($featuredata)){
           $featuredata= ArrayHelper::map($features, 'id', 'name');
           ?>
   
    <div class="row">
        <div class="col-xs-6">
         <?= $form->field($mdlplanfeature, 'feature')->checkboxList($featuredata, [
                'onclick' => "$(this).val( $('input:checkbox:checked').val()); ",//if you use required as a validation rule you will need this for the time being until a fix is in place by yii2
                'item' => function($index, $label, $name, $checked, $value) {
                return "<label class='ckbox ckbox-primary col-xs-4'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3' class='disable' id='check_{$index}'> {$label}</label>";
                }
        ])
        ?>
        </div>
    </div>
    
    <?php $countries= \frontend\models\Countries::find()->all();
          $countrydata=  ArrayHelper::map($countries, 'id', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'countryid')->dropDownList($countrydata,['prompt'=>'Select']) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'charge')->textInput() ?>
        </div>
    </div>

   <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'digin_commision')->textInput() ?>
        </div>
    </div>
    
    <?php $duration=[1=>"1 Year", 2=>"2 Years", 3=>"3 Years", 4=>"4 Years", 5=>"5 Years"]; ?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'year')->dropDownList($duration,['prompt'=>'Select']) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>

   </div>
         
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
$(document).ready(function(){  
    <?php if($model->isNewRecord){?>
   $(".disable[value='4']").prop("disabled", true);
   $(".disable[value='5']").prop("disabled", true);
   $(".disable[value='6']").prop("disabled", true);
   $(".disable[value='7']").prop("disabled", true);
   $(".disable[value='8']").prop("disabled", true);
   $(".disable[value='9']").prop("disabled", true);
   $(".disable[value='10']").prop("disabled", true);
 $(".disable[value='11']").prop("disabled", true);
   $(".disable[value='12']").prop("disabled", true);
    <?php } ?>
   
 
   $(".disable").click(function(){
        if($('#check_0').is(":checked"))
        {
             //alert("check...");
             $(".disable[value='4']").prop("disabled", false);
             $(".disable[value='5']").prop("disabled", false);
             $(".disable[value='6']").prop("disabled", false);
             $(".disable[value='7']").prop("disabled", false);
             $(".disable[value='8']").prop("disabled", false);
             $(".disable[value='9']").prop("disabled", false);
             $(".disable[value='10']").prop("disabled", false);
             $(".disable[value='11']").prop("disabled", false);
             $(".disable[value='12']").prop("disabled", false);
        }
        else{
            $(".disable[value='4']").prop("disabled", true);
            $(".disable[value='5']").prop("disabled", true);
            $(".disable[value='6']").prop("disabled", true);
            $(".disable[value='7']").prop("disabled", true);
            $(".disable[value='8']").prop("disabled", true);
            $(".disable[value='9']").prop("disabled", true);
            $(".disable[value='10']").prop("disabled", true);
             $(".disable[value='11']").prop("disabled", true);
            $(".disable[value='12']").prop("disabled", true);
        }
    });
    
    
    //$(".disable[value='10']").prop("checked", true);
    <?php if(isset($featureid)){
       foreach ($featureid as $f){  ?>         
        $(".disable[value='<?=$f ?>']").prop("checked", true);
    <?php }}?>
});

</script>