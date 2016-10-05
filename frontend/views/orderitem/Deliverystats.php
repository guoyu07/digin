<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="Delivery-form">
   
<?php $form = ActiveForm::begin(['action' =>['orderitem/deliverystats'], 'id' => 'dlvrstatusfrm', 'method' => 'post','class'=>'frm']); ?>
    
<?= Html::hiddenInput('orderitemid',$model->oritemid)  ?>
  
<?php //echo 'index.'.$index; ?>

<?= $form->field($model, 'delivery_status')->dropdownList(['Dispatched' => 'Dispatched', 'In Transit' => 'In Transit','Delivered' => 'Delivered'], ['prompt' => '---Select---','id'=>'sts'.$index], ['options' =>
                    [                        
                      $model->delivery_status => ['selected' => true]
                    ]
          ])->label(false); ?>

<?= Html::submitButton('Save',['id'=>'btnSubmit'.$index,'class'=>'btn btnn1']) ?>
   
<?php ActiveForm::end(); ?>



<script>
 $(document).ready(function() {
     
     sts='<?php echo $model->delivery_status; ?>';
     //alert(sts); 
     
  if(sts == 'Delivered') {
      $("#sts"+<?php echo $index; ?>).attr("disabled", true);
    
      $("#btnSubmit"+<?php echo $index; ?>).attr("disabled", true); 
      
  } 

 });

 </script>
 
<style type="text/css">
    .btnn1{
        width:70%;
         margin-left: 18px;
    }
    
    #sts{
        width:100%;
           
    }
    
</style>