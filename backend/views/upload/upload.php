<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZoneCities */
/* @var $form ActiveForm */
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="upload">

    <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']]); ?>

    <?php echo "<div class='alert alert-info'>You can download our city, state & pincodes database here. <b><a href='#' id='exp'>Download</a></b></div>"; ?>
    <br>
    <?php $dlpartners=  backend\models\DeliveryPartner::find()->where(['!=','dpid',1])->all();
          $dpdata=  ArrayHelper::map($dlpartners, 'dpid', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'dpid')->dropDownList($dpdata,['prompt'=>'Select']) ?>
        </div>
    </div>
    <br>
      <div class="row">
         <div class="col-xs-4">
         <?php //echo '<div style="font-size: 25px; text-align: justify;"><b>OR</b></div>' ;
          echo '<div class="alert alert-warning"><strong>Warning....!</strong> Please upload excel file without empty fields.</div>';
          ?>
      
           <?= $form->field($model,'excelfile')->fileInput() ?>
       </div>  </div>
    
        <div class="form-group">
            <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    
    
    <?php   if($success){
    if($result==null){ ?>
    <div class="alert alert-success" id="import">
  <strong>Success!</strong> Import has done successfully.
   </div> <?php } ?>
   
  <?php   
  if(isset($result) && $result != '' && sizeof($result)>0){?>   
    <div class="alert alert-danger" id="importfl">
        Following cities & states did not match with our database.
        <br><br> 
        <?php if(sizeof($result[0])>0) {
        $cities=  implode(", ", $result[0]);
            echo "<b>Cities: </b>".$cities;
        }else{
            echo "<b>Cities: </b>";
        }?>
        <br>
        <?php if(sizeof($result[1])>0) {
           $states=  implode(", ", $result[1]);
            echo "<b>States: </b>".$states; 
        }else{
            echo "<b>States: </b>";
        }
        
     //echo "<b>Count: </b>".$result[2];   
?>
  </div> 
    <?php  }  }?>

</div><!-- upload -->

<script type="text/javascript">
     $(document).ready(function(){
        
         $('#exp').click(function(){           
             location.href="index.php?r=upload/export"; 
        });
        });
</script>