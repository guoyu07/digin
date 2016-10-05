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

    <?php echo "<div class='alert alert-info'>You can download our vid, productname & price database here. <b><a href='#' id='exp'>Download</a></b></div>"; ?>
    <br>
    
    <?php ActiveForm::end(); ?>
    
    
    <?php  
     
       echo 'Export successfully...!';
        
   ?>
  </div> 
    

</div><!-- upload -->

<script type="text/javascript">
     $(document).ready(function(){
        
         $('#exp').click(function(){           
             location.href="index.php?r=exportproduct/export"; 
        });
        });
</script>