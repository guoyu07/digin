<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\Models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/search.js"></script>

<div class="searchpath-form">
    <?php $form = ActiveForm::begin(); ?>     
    
           
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'path')->textInput(['maxlength' => true],
                   ["onchange"=>" $.ajax({
                        type     :'POST',
                        cache    : false,
                        url  : 'category/search',
                        success  : function(response) {
                            alert('hiii');
                        }
                        });"]
                    ) 
            ?>
        </div>
    </div>
             
    <?php ActiveForm::end(); ?>
    
    
</div>

<script type="text/javascript">
    $("#category-path").change(function(){                
                var data=$("#category-path").val();
                var datalen=data.length;
                alert(datalen);
                myFunction();
            });
            
            
            function myFunction()
            {
                $.ajax({
                    url: '<?php echo Yii::$app->request->baseUrl. '/category/search' ?>',
                   type: 'post',
                   //data: {searchname: $("#searchname").val() , searchby:$("#searchby").val()},
                   success: function (result) {
                      alert(result);

                   }

              });
            }
</script>