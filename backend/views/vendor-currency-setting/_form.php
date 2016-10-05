<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\models\VendorCurrencySetting */
/* @var $form yii\widgets\ActiveForm */

?>
<!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="row">
    <div class="col-md-12">
<div class="vendor-currency-setting-form">

    <?php //$form = ActiveForm::begin(); ?>
    <?php $form = ActiveForm::begin(['id'=>'vencurncyform']); ?>
<div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
    <!--?= $form->field($model, 'vid')->textInput() ?-->
      </div>
</div>
    
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'base_currency')->textInput(['readonly' => true]) ?>
 </div>
</div>
   
 <?php $countries= \frontend\models\Countries::find()->all();
          $countrydata=  ArrayHelper::map($countries, 'id', 'name')?>
 <div class="row">
 <div class="col-xs-3">   
    <!--? = $form->field($modeladdress, 'country')->textInput() ?-->
     <?= $form->field($model, 'country')->dropDownList($countrydata,['prompt'=>'Select']) ?>
</div> </div>
   
  <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'currency')->textInput(['readonly' => true]) ?>
     </div>
</div>
    
    
   <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'currency_rate')->textInput() ?>
     </div>
</div>
    
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'percentaddition')->textInput() ?>
   </div>
</div>
 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    </div>
</div>
    <?php ActiveForm::end(); ?>
<?php $id = intval($_GET['id']);
      $code =backend\models\Vendor::findOne(['vid'=>$id]);
      //var_dump($code['currencycode']);
?>
</div>
<div id="message" style="display: none;"></div>
<?php //echo 'post'.$_GET['id']; ?>
<?php Pjax::begin(['id'=>'currencycode']); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],    
            
             'base_currency',
             //'country',
              [
                'label'=>'Country Name',
                'attribute'=>'country',
                'format'=>'raw',
                'value'=>function($model){
                        $cntrynm=$model->getCountryname($model->country); 
                        return $cntrynm;
                        
                    },
                   ],
             'currency',
             'currency_rate',
             //'percentaddition',  
              [
                'label'=>'%Addition',
                'attribute'=>'percentaddition',
              ],
                  
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

<script type="text/javascript">
     $(document).ready(function(){
         
         var venid = '<?php echo $code['currencycode'];  ?>'
         //$('#vendorcurrencysetting-base_currency').val(venid);
         
         $('#vendorcurrencysetting-country').change(function(){            
            var curcode=$('#vendorcurrencysetting-country').val();
            //alert(curcode);
             $.ajax({
                type:"POST",
                   url:"index.php?r=vendor-currency-setting/getcode",           
                   data:{curcode:curcode},
                   success:  function(result) {   
                      $("#listone2").empty();
                          $('#vendorcurrencysetting-currency').val(result);
                    },
            });       
        });
        
        /******************Code to update grid view*************************/
  $("#vencurncyform").on("beforeSubmit",function(e){    
            var form=$(this);             
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){  
                                           
                       if(result==1)
                       {
                          //form.trigger("reset");
                           form.find('input:text, select').val('');                          
                           //$(".prodtab").find("td").text("None");
                           $.pjax.reload({container:'#currencycode'});
                       }
                       else
                       {
                           $("#message").html(result);                           
                       } 
                   }).fail(function()
                   {
                       console.log("server error!");
                   }); 
                   return false; 
           });
          
     });
</script>
