<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Vendortype;
use backend\models\Plan;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use  yii\jui\DatePicker;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/vendorfacility.js"></script>

   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="vendor-form">
<div class="row">
    
    
    <!--div class="col-xs-3"> 
         <!--form method="GET" id="contact" action="index.php?r="-->
     <?php //echo $form->field($mdlVendorPaytype, 'chq_date')->textInput(['maxlength' => true,'class'=>'inputdate']);
 
     /*echo Html::label('From Date', ['class'=>'rptdate']);
                            echo DatePicker::widget([
                 'model' => $vendorcountmodel,                 
                 'attribute' => 'frmdt',                
                 //'language' => 'ru',
                 'dateFormat' => 'yyyy-MM-dd',
                 //'timeFormat'=>'hh:mm:ss',
                 'options' => ['class' => 'form-control']
                                
           
  ]);*/?>
         <!--/div-->  
    
      <!--div class="col-xs-3"> 
            <?php    /* echo Html::label('To Date', ['class'=>'rptdate']);
                 echo DatePicker::widget([
                 'model' => $vendorcountmodel,                 
                 'attribute' => 'todt',                
                 //'language' => 'ru',
                 'dateFormat' => 'yyyy-MM-dd',
                    // 'timeFormat'=>'hh:mm:ss',
                    // 'dateFormat' => 'd-M-Y g:i A', 
                 'options' => ['class' => 'form-control']
                   
  ]);*/
                 
    ?>
       <!--/div-->
       <div class="col-xs-3">  <?= $form->field($vendorcountmodel, 'Date')->textInput(['maxlength' => true]) ?></div>
        <!--input type="text" name="ddtt" class="form-control" id="range" style="width: 200px;" /></div-->
     <script type="text/javascript">
			$(function() {
				$('input[name="Vendor[Date]"]').daterangepicker();
                               // $('#range').daterangepicker();
			});
   </script>

  <div class="col-xs-3"> 
      <div class="form-group" style="margin-top: 25px;">
       
      <?php echo Html::submitButton('Show',array('id'=>'showcount',['/vendor/vendorcount'], 'class'=>'btn btn-primary')); ?>
       <?php //Html::submitButton($vendorcountmodel->isNewRecord ['class' => $vendorcountmodel->isNewRecord ][ 'btn btn-success submit' : 'btn btn-primary submit']) ?>         
      <!--input type="submit" name="submit" value="Show" class="btn btn-primary"-->
   </div>
      </div> </div>
    <br>
  <div>
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Citywise Vendors</legend>
    <?php 
    
     echo Html::beginTag('table class="table table-striped"');
          echo Html::beginTag('tr');
          
          echo Html::tag('th', 'City'); // for hable head 
          echo Html::tag('th', 'Count');
          echo Html::endTag('tr');
          if(isset($vencount) && $vencount !="") {
             
             foreach ($vencount as $v){
          
          echo Html::beginTag('tr');
          
          if($v['City']==''){
              echo Html::tag('td','None');  
          }else{
           echo Html::tag('td','<a href="index.php?r=vendor/index&VendorSearch[city]='.$v['City'].'&VendorSearch[crtdt]='.$v['fromdate'].'_'.$v['todate'].'">'.$v['City'].'</a>'); 
          }
           echo Html::tag('td',$v['Count']);     
           echo Html::endTag('tr');
          }
   //echo "Set.."; var_dump($vencount);
    //echo var_dump($v['fromdate'].'_'.$v['todate']);
}

echo Html::endTag('table'); ?>     
         </fieldset>
  </div>
    
    
    
    
    
    
    
  
  
     <?php ActiveForm::end(); ?>
</div>

