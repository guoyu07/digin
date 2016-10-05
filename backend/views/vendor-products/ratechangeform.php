<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="OtherCurrencyRate-form">
   <?php //var_dump($model); ?>
<?php $form = ActiveForm::begin(['action' =>['vendor-products/changecurncyrate'], 'id' => 'chngcurrt', 'method' => 'post']); ?>
    
<?= Html::hiddenInput('ocid',$model['ocid'])  ?>
<?= Html::hiddenInput('cntry',$model['country'])  ?>
<?= Html::hiddenInput('curncy',$model['currency'])  ?>
    
    <div class="row" style="visibility:visible;">  
<?= Html::textInput('chngerate',$model['price'],['id'=>'txtpin']) ?>
       
 
<?= Html::submitButton('Save',['id'=>'btnSubmit','class'=>'btn']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
<?php //echo $model->delivery_status;?>

 <style type="text/css">
    .btnn2{
       width: 60%;
    margin-left: 17%;
    margin-top: 17%;
    }
    
    #txtpin{
       //width: 80%;
       margin-left: 10%;
           
    }
    
</style>