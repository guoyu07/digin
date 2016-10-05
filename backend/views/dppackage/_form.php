<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Dppackage */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="dppackage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $dlpartners=  backend\models\DeliveryPartner::find()->where(['!=','dpid',1])->all();
          $dpdata=  ArrayHelper::map($dlpartners, 'dpid', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'dpid')->dropDownList($dpdata,['prompt'=>'Select'])  ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'packagename')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-xs-6">        
            <?= $form->field($mdlbulkrates, 'bulk')->checkbox(['style'=>'margin-left:292px; margin-top:30px;', 'class'=>'isbulk']) ?>
        </div>
    </div>
  
    <div class="row">
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'initialweight')->textInput() ?>
        </div>
        
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'addweightmultiple')->textInput() ?>
        </div>
        
        <div class="col-xs-3">        
            <?= $form->field($mdlbulkrates, 'minimumweight')->textInput(['disabled'=>true]) ?>
        </div>
        
        <div class="col-xs-3">        
            <?= $form->field($mdlbulkrates, 'weightmultiple')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($mdlpkgrates, 'withincityrate')->textInput() ?>
        </div>
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'addwithincityrate')->textInput() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($mdlbulkrates, 'withincityrate')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
            
    <div class="row">
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'zonerate')->textInput() ?>
        </div>
        <div class="col-xs-3">         
            <?= $form->field($mdlpkgrates, 'addzonerate')->textInput() ?>
        </div>
        <div class="col-xs-3">        
            <?= $form->field($mdlbulkrates, 'zonerate')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
            
    <div class="row">
        <div class="col-xs-3">       
            <?= $form->field($mdlpkgrates, 'metrorate')->textInput() ?>
        </div>
        <div class="col-xs-3">         
            <?= $form->field($mdlpkgrates, 'addmetrorate')->textInput() ?>
        </div>
        <div class="col-xs-3">       
            <?= $form->field($mdlbulkrates, 'metrorate')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'RoIArate')->textInput() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($mdlpkgrates, 'addRoIArate')->textInput() ?>
        </div>
        <div class="col-xs-3">        
            <?= $form->field($mdlbulkrates, 'RoIArate')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
            
    <div class="row">
        <div class="col-xs-3">         
            <?= $form->field($mdlpkgrates, 'RoIBrate')->textInput() ?>
        </div>
        <div class="col-xs-3">       
            <?= $form->field($mdlpkgrates, 'addRoIBrate')->textInput() ?>
        </div>
        <div class="col-xs-3">         
            <?= $form->field($mdlbulkrates, 'RoIBrate')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'spldestrate')->textInput() ?>
        </div>
        <div class="col-xs-3">        
            <?= $form->field($mdlpkgrates, 'addspldestrate')->textInput() ?>
        </div>
        <div class="col-xs-3">        
            <?= $form->field($mdlbulkrates, 'spldestrate')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
        
      
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(document).ready(function(){       
        $(document).on('click','.isbulk',function(e){
            if($(this).is(":checked")==true)
                    {                
                        //alert("checked...");
                        $("#bulkrates-bulk").val(1);
                        $("#bulkrates-minimumweight").attr('disabled',false);
                        $("#bulkrates-weightmultiple").attr('disabled',false);
                        $("#bulkrates-withincityrate").attr('disabled',false);
                        $("#bulkrates-zonerate").attr('disabled',false);
                        $("#bulkrates-metrorate").attr('disabled',false);
                        $("#bulkrates-roiarate").attr('disabled',false);
                        $("#bulkrates-roibrate").attr('disabled',false);
                        $("#bulkrates-spldestrate").attr('disabled',false);
                    }else{                
                        //alert("Unchecked...");  
                        $("#bulkrates-bulk").val(0);
                        $("#bulkrates-minimumweight").attr('disabled',true);
                        $("#bulkrates-weightmultiple").attr('disabled',true);
                        $("#bulkrates-withincityrate").attr('disabled',true);
                        $("#bulkrates-zonerate").attr('disabled',true);
                        $("#bulkrates-metrorate").attr('disabled',true);
                        $("#bulkrates-roiarate").attr('disabled',true);
                        $("#bulkrates-roibrate").attr('disabled',true);
                        $("#bulkrates-spldestrate").attr('disabled',true);
                    }  
        });
        <?php if($mdlbulkrates->bulk==1) {?>
                        $("#bulkrates-minimumweight").attr('disabled',false);
                        $("#bulkrates-weightmultiple").attr('disabled',false);
                        $("#bulkrates-withincityrate").attr('disabled',false);
                        $("#bulkrates-zonerate").attr('disabled',false);
                        $("#bulkrates-metrorate").attr('disabled',false);
                        $("#bulkrates-roiarate").attr('disabled',false);
                        $("#bulkrates-roibrate").attr('disabled',false);
                        $("#bulkrates-spldestrate").attr('disabled',false);
        <?php } ?>
    });
</script>

