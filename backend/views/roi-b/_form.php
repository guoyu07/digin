<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RoiB */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="roi-b-form">

    <?php $form = ActiveForm::begin(); ?>

   <?php $dlpartners=  backend\models\DeliveryPartner::find()->where(['!=','dpid',1])->all();
          $dpdata=  ArrayHelper::map($dlpartners, 'dpid', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'dpid')->dropDownList($dpdata,['prompt'=>'Select']) ?>
        </div>
    </div>
    
    <?php $states= \frontend\models\States::find()->all();
          $statedata=  ArrayHelper::map($states, 'id', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'state')->dropDownList($statedata,['prompt'=>'Select']) ?>
        </div>
    </div>
    
    <?php $cities= \frontend\models\Cities::find()->all();
          $citydata=  ArrayHelper::map($cities, 'id', 'name')?>
     <div class="row">
        <div class="col-xs-3"> 
        <?php echo  $form->field($model, 'cityid')-> listBox(
                $citydata,               
                array('id'=>'listone','size'=>10));
          ?>
        </div>
     </div>
    
    <div class="col-xs-2">        
	<?php echo Html::Button('>',['id'=>'btnadd','class'=>'btn btndefault']); ?>
  	<?php echo Html::Button('<',['id'=>'btnremove','class'=>'btn btndefault']); ?>
    </div>
       
    <div class="row">
        <div class="col-xs-3"> 
        <?php       
        if(!isset($cityData))
        {
            $cityData=array();
        }
        echo $form->field($model, 'cityarray')-> listBox($cityData,
                array('id'=>'list2','size'=>10,'multiple' => 'true')
                )->label(''); ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success submit' : 'btn btn-primary submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
     $(document).ready(function(){
         $('#roib-state').change(function(){            
            var state=$('#roib-state').val();
            //alert(state);
             $.ajax({
                type:"POST",
                   url:"index.php?r=roi-b/getcity",           
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
        
         /*******************For adding from list1 to list2*******************************/
        $(document).on('click', '.submit',function(e){                                        
                        $('#list2 > option').prop("selected",true);
        });                
               
       $('#btnadd').click(function(e) {  
             if( $('#listone > option:selected').text()!='Select')
             {    
                   $("#list2 > option[value='']").remove();                      
                   $('#listone > option:selected').appendTo('#list2'); 
                   e.preventDefault(); 
             }
       });  
  
       $('#btnremove').click(function(e) { 
             if( $('#list2 > option:selected').text()!='Select')
             { 
                    $('#list2 > option:selected').appendTo('#listone');                                          
                    e.preventDefault();  
             }
        });
     });
</script>
