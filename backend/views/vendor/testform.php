<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/workinghrs.js"></script>

<div class="vendorwhrs-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="row">
        <div class="col-xs-3">                              
            <?= $form->field($mdlVendorWorkinghours, 'shift')->radioList(array('S'=>'Single','D'=>'Double'),['itemOptions'=>['id'=>'shift1']]);
              ?>
        </div>
    </div>
        
        
        
    <div class="row">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Working Hours</legend>
    <?php  
          echo Html::beginTag('table');
          echo Html::beginTag('tr');
          
          echo Html::tag('th', 'Day'); // for hable head 
          echo Html::tag('th', ' ');
          echo Html::tag('th','Mon');          
          echo Html::tag('th','Tue');
          echo Html::tag('th','Wed');
          echo Html::tag('th','Thur');
          echo Html::tag('th','Fri');
          echo Html::tag('th','Sat');
          echo Html::tag('th','Sun');
          
          echo Html::endTag('tr');
          
          echo Html::beginTag('tr', array('id'=>'row1'));
          echo Html::tag('td','Weekly Off'); 
          echo Html::tag('td','');          
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_1','class'=>'weekday')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_2','class'=>'weekday')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_3','class'=>'weekday')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_4','class'=>'weekday')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_5','class'=>'weekday')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_6','class'=>'weekday')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours, 'wkday[]')->checkbox(array('id'=>'day_7','class'=>'weekday')));
          echo Html::endTag('tr');
          
         // var_dump($mdlVendorWorkinghours);
         // var_dump($mdlVendorWorkinghours[0]['timefrom']);       
        
          
          $time=['00:00'=>'00:00','01:00'=>'01:00','02:00'=>'02:00','03:00'=>'03:00','04:00'=>'04:00','05:00'=>'05:00','06:00'=>'06:00','07:00'=>'07:00','08:00'=>'08:00','09:00'=>'09:00','10:00'=>'10:00','11:00'=>'11:00'];
          echo Html::beginTag('tr', array('id'=>'row2'));          
          echo Html::tag('td','Single Shift',array('id'=>'shiftname'));
          echo Html::tag('td','From'); 
                            
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[0]timefrom')->dropDownList(
                    $time,array('class'=>'form-control time','id'=>'fromtime_1' 
                        //array(isset($mdlVendorWorkinghours->fromshift1[0]) ? $mdlVendorWorkinghours->fromshift1[0] : ''=>array('selected'=>'selected')))
                    )));
         
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[1]timefrom')->dropDownList(
                  $time,array('class'=>'form-control time','id'=>'fromtime_2'
                  //'options'=> array(isset($mdlVendorWorkinghours->fromshift1[1]) ? $mdlVendorWorkinghours->fromshift1[1] : ''=>array('selected'=>'selected')))
                     ) ));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[2]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'fromtime_3')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[3]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'fromtime_4')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[4]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'fromtime_5')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[5]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'fromtime_6')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[6]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'fromtime_7')));
          echo Html::endTag('tr');
          
          echo Html::beginTag('tr', array('id'=>'row3'));
          echo Html::tag('td',Html::button('Apply',array('id'=>'applyall1','class'=>'btn btn-primary'))); //This button can put here also without giving rowspan to Single shift
          echo Html::tag('td','To');
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[0]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_1')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[1]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_2')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[2]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_3')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[3]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_4')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[4]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_5')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[5]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_6')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[6]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'totime_7')));
          echo Html::endTag('tr');
                 
         /* 
          echo Html::beginTag('tr', array('id'=>'row4'));
          echo Html::tag('td','Evening Shift'.Html::button('Apply',array('id'=>'applyall2','class'=>'btn btn-primary')),array('rowspan'=>2));
          echo Html::tag('td','From');
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[0]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_1')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[1]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_2')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[2]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_3')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[3]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_4')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[4]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_5')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[5]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_6')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[6]timefrom')->dropDownList($time,array('class'=>'form-control time','id'=>'evengfromtime_7')));
          echo Html::endTag('tr');
                    
          echo Html::beginTag('tr', array('id'=>'row5'));
          echo Html::tag('td','To');
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[0]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_1')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[1]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_2')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[2]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_3')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[3]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_4')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[4]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_5')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[5]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_6')));
          echo Html::tag('td',$form->field($mdlVendorWorkinghours,'[6]timeto')->dropDownList($time,array('class'=>'form-control time','id'=>'evengtotime_7')));
          echo Html::endTag('tr'); */
          
          
          echo Html::endTag('table'); ?>            
        </fieldset>
    </div>
  
    
    <div class="form-group">
        <?= Html::submitButton($mdlVendorWorkinghours->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $mdlVendorWorkinghours->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>         
    </div>
    
     <?php ActiveForm::end(); ?>
</div>