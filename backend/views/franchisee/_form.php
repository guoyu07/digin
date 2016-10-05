<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\Franchisee */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./css/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="./css/form.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-latest.js"></script>-->

<script type="text/javascript" src="./js/jquery-latest.js"></script>
<script type="text/javascript" src="./js/vendorfacility.js"></script>


<script>
    function checkcode()
    {
        var code=$("#franchisee-code").val();      
       $.ajax({
           type:"POST",
           url:"<?php echo Yii::$app->request->baseUrl; ?>/index.php?r=/franchisee/check",
           data:{code:code},
           success:  function(result) {
               //alert(result);
               $("#msg").css('display','block');
               $("#msg").html(result);
            },
       });
    }
             
 </script>
    
<div class="product-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
      <div class="col-xs-3">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?php echo Html::button('Check',array('class'=>'btn btn-primary check','onClick'=>'checkcode()')); ?>
            <div id='msg'> </div>
        </div> 
    </div>
      <div class="row" style="margin-top: 10px;">
     <div class="col-xs-3">
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
</div> </div>
<div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'idlogo')->fileInput() ?>
        </div>
    </div>
    <div class="row">
 <div class="col-xs-3">
    <?php //$form->field($model, 'adrid')->textInput() ?>
</div> </div>

 <div class="row">
 <div class="col-xs-3">
    <?php //$form->field($model, 'crtdt')->textInput() ?>
     </div> </div>
 <div class="row">
 <div class="col-xs-3">
    <?php //$form->field($model, 'crtby')->textInput() ?>
 </div> </div>
 <div class="row">
 <div class="col-xs-3">
    <?php echo $form->field($modeladdress, 'email')->textInput() ?>
</div> </div>
 <div class="row">
 <div class="col-xs-3">   
    <?php echo $form->field($modeladdress, 'phone')->textInput() ?>
</div> </div>
<div class="row">
 <div class="col-xs-3">   
    <?= $form->field($modeladdress, 'address1')->textInput() ?>
</div> </div>
    <div class="row">
 <div class="col-xs-3">   
    <?= $form->field($modeladdress, 'address2')->textInput() ?>
</div> </div>
    <?php $countries= \frontend\models\Countries::find()->all();
        $countrydata=  ArrayHelper::map($countries, 'id', 'name')?>
 <div class="row">
 <div class="col-xs-3">   
     <?= $form->field($modeladdress, 'country')->dropDownList($countrydata,['prompt'=>'Select']) ?>
</div> </div>
   
     <?php //$states= \frontend\models\States::find()->all();
          $states= array();
          $statedata=  ArrayHelper::map($states, 'id', 'name');
          //$statedata = array();
           ?>
    <div class="row">
        <div class="col-xs-3">
            
            <?php  echo  $form->field($modeladdress, 'state')-> listBox(
                $statedata,               
                array('id'=>'listone2','size'=>10));
          ?>
        </div>
    </div>
    
    <?php $cities= array();
         $citydata=  ArrayHelper::map($cities, 'id', 'name'); 
          // $citydata = array();      
    ?>
     <div class="row">
        <div class="col-xs-3"> 
         <?php  echo  $form->field($modeladdress, 'city')-> listBox(
                $citydata,               
                array('id'=>'listone','size'=>10));
          ?>
        </div>
     </div>
  
    <div class="row">
 <div class="col-xs-3">   
    <?= $form->field($modeladdress, 'pin')->textInput() ?>
</div> </div>
   
<div class="row">
<div class="col-xs-3"> 
   <?= $form->field($model, 'daterange')->textInput() ?>
</div></div>
   <script type="text/javascript">
$(function() {
    //$('input[name="daterange"]').daterangepicker();
    $('input[name="Franchisee[daterange]"]').daterangepicker();
});
    </script>  <br>  
   
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
 </div>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
     $(document).ready(function(){
         $('#listone2').change(function(){            
            var state=$('#listone2').val();
            //alert(state);
             $.ajax({
                type:"POST",
                   url:"index.php?r=franchisee/getcity",           
                   data:{stateid:state},
                   success:  function(result) {   
                      $("#listone").empty();
                      var data=jQuery.parseJSON(result);
                       $.each(data, function(index, value) {                   
                         $('#listone').append($('<option>').text(value['name']).val(value['id']));
                        
                        });
                    },
            });       
        });
     });
</script>
<script type="text/javascript">
     $(document).ready(function(){
         $('#address-country').change(function(){            
            var state=$('#address-country').val();
            //alert(state);
             $.ajax({
                type:"POST",
                   url:"index.php?r=franchisee/getstate",           
                   data:{countryid:state},
                   success:  function(result) {   
                      $("#listone2").empty();
                      var data=jQuery.parseJSON(result);
                       $.each(data, function(index, value) {                   
                         $('#listone2').append($('<option>').text(value['name']).val(value['id']));
                        
                        });
                    },
            });       
        });
     });
</script>
