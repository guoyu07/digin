<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Downlod-form">
   
<?php $form = ActiveForm::begin(['action' =>['orderitem/'], 'id' => 'downloadfrm', 'method' => 'post']); ?>
    
<!--?= Html::hiddenInput('orderitemid',$model->oritemid)  ?-->
    
<div class="row">  
 
    <input type="checkbox" id="chkid" name="chk" value="" style="margin-left: 13px;">
    
</div>

<?php ActiveForm::end(); ?>
</div>
<?php //echo $model->delivery_status;?>

<script>
  $( "#btnSubmit" ).click(function() {
      alert('hi...');

?>
}) 
 </script>