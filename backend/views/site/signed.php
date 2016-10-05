<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

//$this->title = $name;
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/jquery-latest.js"></script>


<?php $form = ActiveForm::begin(['id'=>'signagreeform',
                                    'method' => 'post',
                                    'action' => ['site/agreement']]); ?>
<input type="hidden" class="frid" name="franchisee" value="<?php echo Yii::$app->user->identity->id ?>">
 <?php 
 if(isset($fridarr)){
 //var_dump($fridarr);
 }
 ?>
<div style="background-color:#e6e6e6;border-radius: 20px;padding: 10px 40px; height:270px;margin-top:50px;">
<!--    <div class="alert alert-success" >-->
<div style="text-align: center;text-decoration: underline;font-family: Impact, Charcoal, sans-serif;">
        <h1>E-Agreement</h1>
        </div><br>
      
        <div style="font-family:Courier New; font-size: 20px;">
             <p> &nbsp;&nbsp;Thanks for registering as a Franchisee. To proceed you have to read & agree to the terms & conditions mentioned in 
            the e-agreement link bellow. 
            </p>  
        </div>
         <div style="font-family:Courier New; font-size: 20px;">
             <p><?php echo Html::checkbox('agree', FALSE, ['label' => '','class'=>'chkagree']);?>&nbsp;I have read the <a href="<?php echo Yii::$app->request->baseUrl.'/../eagreement.pdf' ?>" target="_blank">e-agreement</a>.
                 I accept it.
            </p>  
        </div>
        
   <div class="row">        
    <div id="agr" class="form-group" style="display: none">
        <?= Html::submitButton('I Accept', ['class'=>'btn btn-success']) ?>
    </div>
  </div>
<!--  </div>-->
</div>
 <?php ActiveForm::end(); ?>

<script>
$(document).ready(function(){
$(document).on('click','.chkagree',function(e){
    if($(this).is(":checked")==true)
            {                
                $("#agr").css('display','block');                            
            }else{                
               $("#agr").css('display','none');
            }
            
});
     var frid = '';
            <?php if(isset($fridarr)&& $fridarr != ''){?>
              frid='<?= $fridarr['frid'] ?>';
              //alert(frid);
              $('.frid').val(frid);
            <?php }?>
});

</script>