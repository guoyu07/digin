<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CountryCurrency */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="upload-product-form">

    <?php 

   if(isset($msgarr) && $msgarr!=" "){ 
       if($msgarr ==null){
        //$vpids=  implode(",", $msgarr);    
   ?>
    <div class="alert alert-success" >        
      Prices of vendor products <strong></strong> are updated. Import has done successfully.
   </div> <?php } }  ?>
   
  <?php if(isset($msgarr) && $msgarr!=" " && sizeof($msgarr)>0) { 
       $vpids=  implode(",", $msgarr);  ?>
    
      <div class="alert alert-warning" >        
      Prices of vendor products <strong><?=$vpids?></strong> are not updated.
   </div>
    
    <?php  }   ?>

    
  <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data','id'=>'uploadproductform','action'=>'product/upload']]); ?>
  
     <div class="row">
         <div class="col-xs-3"> 
    <?= $form->field($model,'excelfile')->fileInput() ?>
 </div></div>
    
     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Import') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ?'btn btn-success submit' : 'btn btn-primary submit']) ?>
    </div>
        

    <?php ActiveForm::end(); ?>

</div>
