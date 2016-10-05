<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Delivery-form">
   
<?php $form = ActiveForm::begin(['action' =>['orderitem/deliverypin'], 'id' => 'dlvrpinfrm', 'method' => 'post']); ?>
    
<?= Html::hiddenInput('orderitemid',$model->oritemid)  ?>
    
    <div class="row" style="visibility:visible;">  
<?= Html::textInput('dlvrpin','',['id'=>'txtpin']) ?>
       
 
<?= Html::submitButton('Submit',['id'=>'btnSubmit','class'=>'btn btnn2']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
<?php //echo $model->delivery_status;?>

<script>
  $( "#btnSubmit" ).click(function() {
      //alert('hi...');
?>
}) 
 </script>
 
 <style type="text/css">
    .btnn2{
       width: 60%;
    margin-left: 17%;
    margin-top: 17%;
    }
    
    #txtpin{
        width: 80%;
       margin-left: 13px;
           
    }
    
</style>