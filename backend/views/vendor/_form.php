<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Vendortype;
use backend\models\Plan;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use  yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>    

<link rel="stylesheet" type="text/css" href="./css/form.css" />

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->

<script type="text/javascript" src="./js/jquery-latest.js"></script>
<script type="text/javascript" src="./js/workinghrs.js"></script>
<script type="text/javascript" src="./js/vendorfacility.js"></script>
<script type="text/javascript" src="./js/vendorleads.js"></script>
<script>
    function checkuname()
    {
        var nm=$("#vendor-username").val();      
       $.ajax({
           type:"POST",
           url:"<?php echo Yii::$app->request->baseUrl; ?>/index.php?r=/vendor/check",
           data:{username:nm},
           success:  function(result) {
               //alert(result);
               $("#msg").css('display','block');
               $("#msg").html(result);
            },
       });
    }             
 </script>     
 
<div class="vendor-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
  
   <input type="hidden" class="vlid" name="vendorleadid" value="<?=Yii::$app->request->get('vlid')?>">
  <input type="hidden" class="Edit" name="vendoreditid" value="<?=Yii::$app->request->get('Edit')?>">
   
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
			<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
		</div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?> 
		</div>
   
		<?php /* $options = array(
					'id' => 'vendor-username',
					'ajax' => array('type'=>'POST',
									 'url'=>  Url::to('[vendor/SetPassword]'),
									 'data'=>'js:alert("hello....")',
									 'update'=>'#vendor-password', //selector to update
					)
				);*/
		//Yii::$app->getUrlManager()->createUrl('vendor/setPassword')
		?>
		<div class="col-md-4 col-sm-6 col-xs-12">
				<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
				<?php echo Html::button('Check',array('class'=>'btn btn-primary check','onClick'=>'checkuname()')); ?>
				<div id='msg'> </div>
		</div>
     </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'password_field')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'businessname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'logo')->fileInput() ?>
        </div>
    </div>

		<?php $auth=Yii::$app->authManager;
          $users=array();
          if(!Yii::$app->user->isGuest){
          $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);          
          if ($userRole) {
            foreach ($userRole as $role) {
               $roles[] = $role->name;
            }
            // if user have 1 role then $userRole will be a string containing it
            // othewhise let $userRole be an array containing them all
            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
         }
                
          //var_dump($userRole);
          // Yii::$app->user->can('Admin')
          if($userRole=='Admin' || $userRole=='Superadmin') {
            $users=  \dektrium\user\models\User::findByRole('Executive');    }          
         
          
          $userdata=ArrayHelper::map($users, 'id', 'username');
          //var_dump($userdata)?>
	 <div class="row" style="margin-top: 10px;">
		 <div class="col-md-4 col-sm-6 col-xs-12">
			<?= $form->field($model, 'executive')->dropDownList($userdata,['prompt'=>'Select']) ?>
		</div>
	
	<?php  }  //} ?>

<!-- /*******************For Backend************************/-->
		<?php if(!Yii::$app->user->isGuest) {
			if($userRole=='Admin' || $userRole=='Superadmin') { 
			$franchisee=  \backend\models\Franchisee::find()->all();

			$franchdata=  ArrayHelper::map($franchisee, 'frid', 'name'); ?>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<?= $form->field($model, 'franchisee')->dropDownList($franchdata,['prompt'=>'Select',
			'onchange'=>
			 '$.get( "'.Url::toRoute('vendor/getexecutive').'", { id: $(this).val() } )
					.done(function(data) {
					  $( "select#vendor-franchexecutive" ).html( data );
					});
				'])?>
		</div>
	</div>            
    <?php $exedata=array();
    $query = (new \yii\db\Query()) 
                ->select(['u.user_id','CONCAT(u.firstname," ",u.lastname) as name'])
                ->from('user_detail u')
                ->join('inner join', 'franchisee_user f', 'f.userid=u.user_id')
                ->where(['u.role'=>'Franchisee Executive']);                
     $franchexe=$query->all();
     $exedata=  ArrayHelper::map($franchexe, 'user_id', 'name');?>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'franchexecutive')->dropDownList($exedata,['prompt'=>'Select'])?>
        </div>            
    </div>
    <?php }  }?>
   <!-- /*******************For Frontend************************/-->
    <?php /*if(Yii::$app->user->isGuest){
    $franchisee=  \backend\models\Franchisee::find()->all();        
    $franchdata=  ArrayHelper::map($franchisee, 'frid', 'name'); ?>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'franchisee')->dropDownList($franchdata,['prompt'=>'Select',
                    'onchange'=>
                     '$.get( "'.Url::toRoute('vendor/getexecutive').'", { id: $(this).val() } )
                            .done(function(data) {
                              $( "select#vendor-franchexecutive" ).html( data );
                            });
                        '])?>
        </div>            
    </div>
    
    <?php $exedata=array();
    $query = (new \yii\db\Query()) 
                ->select(['u.user_id','CONCAT(u.firstname," ",u.lastname) as name'])
                ->from('user_detail u')
                ->join('inner join', 'franchisee_user f', 'f.userid=u.user_id')
                ->where(['u.role'=>'Franchisee Executive']);                
     $franchexe=$query->all();
     $exedata=  ArrayHelper::map($franchexe, 'user_id', 'name');?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'franchexecutive')->dropDownList($exedata,['prompt'=>'Select'])?>
        </div>            
    </div>
    <?php }  */?>
   
    <?php $type=Vendortype::find()->all();
           $listdata=ArrayHelper::map($type, 'id', 'type')?>
    <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'vendtor_type')->dropDownList($listdata,['prompt'=>'Select']) ?>
        </div>
    </div>

    <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'phone1')->textInput() ?>
        </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'phone2')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?= $form->field($model, 'aboutme')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'address1')->textInput(['maxlength' => true, 'class'=>'form-control address']) ?>
        </div>
         <div class="col-md-4 col-sm-6 col-xs-12">           
            <?= $form->field($model, 'address2')->textInput(['maxlength' => true, 'class'=>'form-control address']) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'class'=>'form-control address']) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'class'=>'form-control address']) ?>
        </div>               
    </div>  
   
    <?php $countries= \frontend\models\Countries::find()->all();
          $countrydata=  ArrayHelper::map($countries, 'name', 'name')?>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">         
            <!--?= $form->field($model, 'country')->textInput(['maxlength' => true, 'class'=>'form-control address']) ?-->
            <?= $form->field($model, 'country')->dropDownList($countrydata,['prompt'=>'Select']) ?>
        </div>               
         <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'pin')->textInput(['class'=>'form-control address']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?php echo $form->field($model, 'location')->textInput(['id'=>'latlng','readonly'=>true]);
                  echo Html::button('Hide Map',array('id'=>'showmap', 'class'=>'btn btn-primary')); ?>
        </div> 
         <div class="col-md-4 col-sm-6 col-xs-12">
            <?php echo $form->field($model, 'googleaddr')->textInput(['id'=>'googleaddress']);
             echo Html::button('Locate',array('id'=>'loc', 'class'=>'btn btn-primary'));?>
        </div>
    </div>
    
    <div class="row">
		 <div class="col-md-4 col-sm-6 col-xs-12">
			<div id="map" class="mapwidth">       
			</div> 
		</div>
    </div>   
    
      
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-top:10px">                           
            <?php //if(isset($mdlVendorWorkinghours[0]->shift))
               echo $form->field($model, 'shift')->radioList(array('S'=>'Single','D'=>'Double'));
                 ?>
        </div>
    </div>
    
    
    <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">Working Hours</legend>
			<div class=" table-responsive">
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
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[0], '[0]isdayoff')->checkbox(array('id'=>'day_1','class'=>'weekday')));
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[1], '[1]isdayoff')->checkbox(array('id'=>'day_2','class'=>'weekday')));
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[2], '[2]isdayoff')->checkbox(array('id'=>'day_3','class'=>'weekday')));
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[3], '[3]isdayoff')->checkbox(array('id'=>'day_4','class'=>'weekday')));
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[4], '[4]isdayoff')->checkbox(array('id'=>'day_5','class'=>'weekday')));
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[5], '[5]isdayoff')->checkbox(array('id'=>'day_6','class'=>'weekday')));
					echo Html::tag('td',$form->field($mdlVendorWorkinghours[6], '[6]isdayoff')->checkbox(array('id'=>'day_7','class'=>'weekday')));       
					echo Html::endTag('tr');
				 
				 
					$time=['00:00'=>'00 a.m.','01:00'=>'01 a.m.','02:00'=>'02 a.m.','03:00'=>'03 a.m.','04:00'=>'04 a.m.','05:00'=>'05 a.m.','06:00'=>'06 a.m.','07:00'=>'07 a.m.','08:00'=>'08 a.m.','09:00'=>'09 a.m.','10:00'=>'10 a.m.','11:00'=>'11 a.m.','12:00'=>'12 p.m.','13:00'=>'01 p.m.','14:00'=>'02 p.m.','15:00'=>'03 p.m.','16:00'=>'04 p.m.','17:00'=>'05 p.m.','18:00'=>'06 p.m.','19:00'=>'07 p.m.','20:00'=>'08 p.m.','21:00'=>'09 p.m.','22:00'=>'10 p.m.','23:00'=>'11 p.m.'];
					
					echo Html::beginTag('tr', array('id'=>'row2'));
				  //echo Html::tag('td','Single Shift'.Html::button('Apply',array('id'=>'applyall1','class'=>'btn btn-primary')),array('rowspan'=>2,'id'=>'shiftname'));
					echo Html::tag('td','Single Shift',array('id'=>'shiftname'));
					echo Html::tag('td','From'); 
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[0], '[0]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_0', 'id' => 'fromtime_1')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[1], '[1]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_1', 'id' => 'fromtime_2')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[2], '[2]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_2', 'id' => 'fromtime_3')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[3], '[3]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_3' , 'id' =>'fromtime_4')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[4], '[4]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_4', 'id' => 'fromtime_5')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[5], '[5]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_5', 'id' => 'fromtime_6')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[6], '[6]timefrom')->dropDownList($time, array('class' => 'form-control time drpdn_6', 'id' => 'fromtime_7')));
					echo Html::endTag('tr');

					echo Html::beginTag('tr', array('id' => 'row3'));
					echo Html::tag('td', Html::button('Apply', array('id' => 'applyall1', 'class' => 'btn btn-primary'))); //This button can put here also without giving rowspan to Single shift
					echo Html::tag('td', 'To');
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[0], '[0]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_0', 'id' => 'totime_1')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[1], '[1]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_1', 'id' => 'totime_2')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[2], '[2]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_2', 'id' => 'totime_3')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[3], '[3]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_3', 'id' => 'totime_4')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[4], '[4]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_4', 'id' => 'totime_5')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[5], '[5]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_5', 'id' => 'totime_6')));
					echo Html::tag('td', $form->field($mdlVendorWorkinghours[6], '[6]timeto')->dropDownList($time, array('class' => 'form-control time drpdn_6', 'id' => 'totime_7')));
					echo Html::endTag('tr');
				  
				  echo Html::beginTag('tr', array('id'=>'row4'));
				  echo Html::tag('td','Evening Shift'.Html::button('Apply',array('id'=>'applyall2','class'=>'btn btn-primary')),array('rowspan'=>2));
				  echo Html::tag('td','From');
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[0],'[0]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_0','id'=>'evengfromtime_1')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[1],'[1]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_1','id'=>'evengfromtime_2')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[2],'[2]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_2','id'=>'evengfromtime_3')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[3],'[3]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_3','id'=>'evengfromtime_4')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[4],'[4]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_4','id'=>'evengfromtime_5')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[5],'[5]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_5','id'=>'evengfromtime_6')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[6],'[6]timefromevening')->dropDownList($time,array('class'=>'form-control time drpdn_6','id'=>'evengfromtime_7')));
				  echo Html::endTag('tr');
							
				  echo Html::beginTag('tr', array('id'=>'row5'));
				  echo Html::tag('td','To');
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[0],'[0]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_0','id'=>'evengtotime_1')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[1],'[1]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_1','id'=>'evengtotime_2')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[2],'[2]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_2','id'=>'evengtotime_3')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[3],'[3]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_3','id'=>'evengtotime_4')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[4],'[4]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_4','id'=>'evengtotime_5')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[5],'[5]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_5','id'=>'evengtotime_6')));
				  echo Html::tag('td',$form->field($mdlVendorWorkinghours[6],'[6]timetoevening')->dropDownList($time,array('class'=>'form-control time drpdn_6','id'=>'evengtotime_7')));
				  echo Html::endTag('tr');
				  
				  
				  echo Html::endTag('table'); ?>   
				</div>
				</div>
			</fieldset>
		</div>
	</div>
    
    
    <?php 
           
          $venfacids=array(); 
          if(isset($venfacilityData)&& $venfacilityData!=NULL)
          {
            $venfacids=array_keys($venfacilityData);  
          }  
          
          $facility= \backend\models\Facility::find()->select('id, name')->where(['not in','id',$venfacids])->all();         
         // $facility= \backend\models\Facility::findBySql("select id, name from facility")->where("t.id not in ($venfacids)")->all();         
          $facilityData=ArrayHelper::map($facility,'id','name');  
          
          ?>
    <div class="row">
        <div class="col-md-3 col-sm-5 col-xs-12"> 
        <?php $facility=new \backend\models\Facility();
        echo Html::label('Facility');
        echo $form->field($facility, 'id')-> listBox(
                $facilityData,               
                array('id'=>'listA','size'=>4,'multiple' => 'true')
                )->label(false);  ?>
        </div>

     <div class="col-md-1 col-sm-1 col-xs-6">  
		<label></label>
		 <div class="row">
			<?php echo Html::Button('',['id'=>'btnAdd','class'=>'btn btndefault']); ?>
		</div>
		<div class="row">
			<?php echo Html::Button('',['id'=>'btnRemove','class'=>'btn btndefault']); ?>
		</div>
	</div>
        <div class="col-md-3 col-sm-5 col-xs-12">
        <?php //$data=array();
        if(!isset($venfacilityData))
        {
            $venfacilityData=array();
        }
        echo $form->field($mdlvenfac, 'facidarray')-> listBox($venfacilityData,
                array('id'=>'listB','size'=>4,'multiple' => 'true')
                )->label('');  
        ?>
        </div>
    </div>
    
   <?php //$plans= Plan::find()->all();
          //$listdata=  ArrayHelper::map($plans, 'id', 'name')
          $listdata=array();?>
    <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">        
            <?= $form->field($model, 'plan')->dropDownList($listdata,['prompt'=>'Select', 
                'onchange'=>
                      '$.get( "'.Url::toRoute('vendor/getplandesc').'", { id: $(this).val() } )
                            .done(function(data) {
                              $( "#plandesc" ).css("display","block");
                              $( "#plandesc" ).html( data );
                            });
                        ']) ?>            
             <div id="plandesc" class='alert alert-info' style="display: none;"></div>            
        </div>
        
    </div>
    <div class="planmsg" style="margin-top:5px; margin-bottom:10px; color:red; display: none;">
        <b> There are no plans under this country which you have entered. </b>
    </div>


    <?php $paytype=  backend\models\Paymentype::find()->all();
          $venpaytypeData=ArrayHelper::map($paytype,'ptid','type');  ?>
    
    <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12">        
           <?php              
              /*if(!isset($venpaytypeData))
              {
                  $venpaytypeData=array();
              } */
           echo $form->field($mdlVendorPaytype, 'ptypeid')->radioList($venpaytypeData)?>
        </div>
           
    </div>
    
			<div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-12">        
                   <?php 
                    if(!$model->isNewRecord && $mdlVendorPaytype->ptypeid!=1){                    
                    ?>
                    <div class="chkdate" style="display: block;">  
                    <?php } else{?>
            <div class="chkdate"> 
                <?php } ?>
            <?php  echo Html::label('Cheque No', 'chq', ['class'=>'chq']);
            echo $form->field($mdlVendorPaytype, 'chq_no')->textInput()->label(false) ?>
            <?php //echo $form->field($mdlVendorPaytype, 'email')->textInput(['maxlength' => true]) ?>
           
     
               <?php //echo $form->field($mdlVendorPaytype, 'chq_date')->textInput(['maxlength' => true,'class'=>'inputdate']);
               echo Html::label('Cheque Date', 'chq', ['class'=>'chqdt']);
                            echo DatePicker::widget([
                 'model' => $mdlVendorPaytype,                 
                 'attribute' => 'chq_date',                
                 //'language' => 'ru',
                 'dateFormat' => 'yyyy-MM-dd',
                 'options' => ['class' => 'form-control']
]);?>
                </div>
           </div>
         </div>  </div>
    <br>
<!--     <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">        
           <?php //$data=['1'=>'Digin Payment, Digin Delivery','2'=>'Digin Payment, Self Delivery', '3'=>'Digin Payment, No delivery', '4'=>'No Payment, No Delivery'];
          // echo $form->field($model, 'paymentanddelivery')->radioList($data); ?>
        </div>           
    </div>
    -->
    <div class="row">
        <div class="col-md-2 col-sm-6 col-xs-12">        
           <?php $data=['1'=>'Digin Payment','0'=>'No Payment'];
           echo $form->field($model, 'paymntopt')->radioList($data); ?>
        </div>    
        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:2%;margin-bottom: 1%;">        
           (Accept your payment through digin payment getway provider)
        </div> <br><br>
         <div class="col-md-6 col-sm-6 col-xs-12"> 
          (You will take the payment offline at your own)      
        </div>  
    </div>
   
     <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">        
           <?php $data=['1'=>'Digin delivery world wide','2'=>'I will deliver my product world wide','3'=>'I will delivered within'];
           echo $form->field($model, 'delivryopt')->radioList($data); ?>
        </div>
         <div class="col-md-2 col-sm-6 col-xs-12">
          <?php echo $form->field($mdlspcdlvroptn, 'delivery_limit')->dropDownList(['select'=>'-Select value-','1' => 'Kms', '2' => 'City','3' => 'Country'], ['style' => 'background:gray;color:#fff;float:left;margin-top: 47%;']); ?>         
        </div>
         <div class="col-md-1 col-sm-6 col-xs-12"  style="margin-top: 7%;">
             <span><b>For min order of</b></span>
         </div>
         <div class="col-md-2 col-sm-6 col-xs-12">
             <input type="text" name="minorderval" id="minordr" class="form-control" style="margin-top: 49%;">
          </div> 
         <div id="kmfld" style="display:none;">
          <div class="col-md-1 col-sm-6 col-xs-12"  style="margin-top: 7%;">
             <span><b>Kms</b></span>
         </div>
          <div class="col-md-2 col-sm-6 col-xs-12">
              <input type="text" name="kms"  class="form-control" style="margin-top: 49%;">
          </div>  
         </div>
          
    </div>
    
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12" style="display: none;" id="dlvrsbid">
          <?php $data=['1'=>'Digin Delivery','0'=>'No Delivery'];
           echo $form->field($model, 'dlvrsb')->radioList($data); ?>
         </div>
    </div>
    
    
    <?php $deliverypartner= \backend\models\DeliveryPartner::find()->all();
        
        $dpdata=  ArrayHelper::map($deliverypartner, 'dpid', 'name');
        $dpdata=array(); ?>
    <div id="dp" style="display: none;">
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'deliverypartner')->dropDownList($dpdata,['prompt'=>'Select',
                    'onchange'=>
                     '$.get( "'.Url::toRoute('vendor/getdeliverypackage').'", { id: $(this).val() } )
                            .done(function(data) {
                              $( "select#vendor-dppkg" ).html( data );
                            });
                        '])?>
        </div>            
    </div>
        <div class="dpmsg" style="margin-top:5px; margin-bottom:10px; color:red; display: none;">
            <b> There are no delivery partners servicing your area. </b>
        </div>
    <?php    
     $dppkg=  backend\models\Dppackage::find()->all();
     $pkgdata=  ArrayHelper::map($dppkg, 'id', 'packagename');
     //$pkgdata=array(); ?>
    <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">        
            <?= $form->field($model, 'dppkg')->dropDownList($pkgdata,['prompt'=>'Select'])?>
        </div>            
    </div>
    
    </div>
<?php if($userRole=='Admin' && $userRole=='Vendor') { ?>
    <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">  
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Bank Details</legend>
        <div class="row">
         <div class="col-md-5 col-sm-6 col-xs-12">  
            <?= $form->field($model, 'bank_name')->textInput() ?>
        </div>
            <div class="col-md-5 col-sm-6 col-xs-12">  
            <?= $form->field($model, 'account_no')->textInput() ?>
        </div>
            </div>
        <div class="row">
            <div class="col-md-5 col-sm-6 col-xs-12">  
            <?= $form->field($model, 'ifsc_code')->textInput() ?>
        </div>
            
            <div class="col-md-5 col-sm-6 col-xs-12">  
            <?= $form->field($model, 'account_name')->textInput() ?>
        </div>
          
            </div>
        </fieldset>
            </div>
      </div>  
      <?php } ?>  
        
        
   <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-5rcs{font-weight:bold;font-size:20px}
    .tg .tg-9hbo{font-weight:bold;vertical-align:top; text-align: center;}
    .tg .tg-9hb{font-weight:bold;vertical-align:top;}
    .tg .tg-yw4l{vertical-align:top; width:70px; text-align: center;}
    </style>
    <table class="tg" id="ratetable" style="display:none;">
        <tr>
          <th class="tg-5rcs" colspan="7"></th>
        </tr>
        <tr>
          <td class="tg-9hb">Weight</td>
          <td class="tg-9hbo">Within City</td>
          <td class="tg-9hbo">Within Zone</td>
          <td class="tg-9hbo">Metro</td>
          <td class="tg-9hbo">RoI-A</td>
          <td class="tg-9hbo">RoI-B</td>
          <td class="tg-9hbo">Spl Dest.</td>
        </tr>
        <tr>
          <td class="tg-9hb">Up to 500 gms</td>
          <td class="tg-yw4l" id="r1"></td>
          <td class="tg-yw4l" id="r2"></td>
          <td class="tg-yw4l" id="r3"></td>
          <td class="tg-yw4l" id="r4"></td>
          <td class="tg-yw4l" id="r5"></td>
          <td class="tg-yw4l" id="r6"></td>
        </tr>
        <tr>
          <td class="tg-9hb">Additional 500 gms</td>
          <td class="tg-yw4l" id="r7"></td>
          <td class="tg-yw4l" id="r8"></td>
          <td class="tg-yw4l" id="r9"></td>
          <td class="tg-yw4l" id="r10"></td>
          <td class="tg-yw4l" id="r11"></td>
          <td class="tg-yw4l" id="r12"></td>
        </tr>      
        <tr id="bulkrow" style="visibility:hidden;">
          <td class="tg-9hb">&gt;5 Kgs. Per kg</td>
          <td class="tg-yw4l" id="r13"></td>
          <td class="tg-yw4l" id="r14"></td>
          <td class="tg-yw4l" id="r15"></td>
          <td class="tg-yw4l" id="r16"></td>
          <td class="tg-yw4l" id="r17"></td>
          <td class="tg-yw4l" id="r18"></td>
        </tr>
       
    </table>
   
     <br>
    <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">         
         <?php echo Html::checkbox('agree', FALSE, ['label' => 'Accept','class'=>'chkacpt']);?>
            <?php  //echo Html::label('I agree to Digin terms of services and privacy policy.', 'agreet', ['class'=>'agree']);
                   echo "<div class=acceptline>I agree to Digin terms of services and privacy policy.</div>"; ?>
           </div>
    </div>
            <?php //echo $form->field($mdlVendorPaytype, 'ptypeid')->textInput()-> ?>
               
      
    <!--?= $form->field($model, 'crtdt')->textInput() ?>

    < ?= $form->field($model, 'crtby')->textInput() ?>

    < ?= $form->field($model, 'upddt')->textInput() ?>

    < ?= $form->field($model, 'updby')->textInput() ?-->
<p>
	 <div class="row">
		<div class="col-md-1 col-sm-3 col-xs-4">  
			<div id="cncl" class="cancelbtn1">
			<?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
			</div>
		</div>
		<div class="col-md-1 col-sm-3 col-xs-4">  
			<div class="agree" style="display: none">
				<div class="form-group">	
					<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success submit' : 'btn btn-primary submit']) ?>         		   
				</div>
			</div>
		</div>	
	</div>
	<?php ActiveForm::end(); ?>



<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initMap" async defer></script>
<script>
var markers = [];
var map;
var infowindow;
var geocoder;
var marker;
var autocomplete;
function initMap() {    
    var input='';
    if(document.getElementById('latlng')!=null){
         input = document.getElementById('latlng').value;         
    }
 geocoder = new google.maps.Geocoder;
 
 map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
  });
 
 if(input !='')
 {
 var latlngStr = input.split(',', 2);
 var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
  map.setCenter(latlng);
  marker = new google.maps.Marker({
          position: latlng,
          map: map
        });
  markers.push(marker);
  }
else{ 
  
  //infowindow = new google.maps.InfoWindow({map: map});
  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infowindow, map.getCenter());
    });
  } else { 
    // Browser doesn't support Geolocation
    handleLocationError(false, infowindow, map.getCenter());
  }
  }
  
    /*****************start*********************/
    //set google address by entering any location 
    var inputaddr= document.getElementById('googleaddress'); 
    autocomplete = new google.maps.places.Autocomplete(inputaddr);    
   
    autocomplete.addListener('place_changed', function() {    
    locateAddress();  
  }); 
  /********************end**********************/  
 
  google.maps.event.addListener(map, 'click', function(event) {
     placeMarker(event.latLng);
	 });
  }
  
  function locateAddress(){   
    autocomplete.bindTo('bounds', map);
      var place = autocomplete.getPlace();
      if(place==null){
          //alert("place is null..");
       var geocoder = new google.maps.Geocoder();
       var address = document.getElementById('googleaddress').value;
       geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {            
              map.setCenter(results[0].geometry.location);
              placeMarker(results[0].geometry.location);
            } else {
              window.alert('Place not found. Please check your address.');
            }
      });
      }
      else{ 
        if(document.getElementById('googleaddress').value!=null && document.getElementById('googleaddress').value!=''){
        if (!place.geometry) {
          window.alert("Place not found. Please check your address.");
          return;
        }
        // If the place has a geometry, then present it on a map.
        if (!place=='undefined' && place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);    
        }    
        placeMarker(place.geometry.location);
        }
        else{
            window.alert("Please enter correct address.");
        }
    }
  }
  
  function placeMarker(location) {
  deleteMarkers();
  loc=location.lat()+','+location.lng();
 geocodeLatLng(geocoder, map, infowindow,loc)
}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}
// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}
function deleteMarkers() {
  clearMarkers();
  markers = [];
}


function geocodeLatLng(geocoder, map, infowindow,latlngs) {
  
  var latlngStr = latlngs.split(',', 2);
  var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        marker = new google.maps.Marker({
          position: latlng,
          map: map
        });
		markers.push(marker);
		document.getElementById('latlng').value=latlng.lat+','+latlng.lng;
		document.getElementById('googleaddress').value=results[1].formatted_address;
      
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}

$("#loc").click(function(){      
    locateAddress();
});

$("#vendor-franchisee").change(function(){
    $("#vendor-executive").val("Select");
});
$("#vendor-executive").change(function(){
    $("#vendor-franchisee").val("Select");
});


/***************show /hide Map  button vendor form ************************/
 $('#showmap').click(function(){
    var $this = $(this);
    $this.toggleClass('#showmap');
    if($this.hasClass('#showmap')){
      $this.text('Show Map');     
    } else {
      $this.text('Hide Map');
    }
  });


 /**vendor edit profile***/
       editvenid = $(".Edit").val();
        //alert(editvenid);
        if(editvenid==1){
           // alert('hi m in edit value'+editvenid);
             //$('#vendor-plan').prop('disabled', false);
             $("#vendor-plan").prop("disabled", true);
             //$("#vendorreceivablepaytype-chq_no").prop("disabled", true);
             //$("#vendorreceivablepaytype-chq_date").prop("disabled", true);
             $("#vendorreceivablepaytype-chq_date").attr("readonly", true); 
             $("#vendorreceivablepaytype-chq_no").attr("readonly", true); 
             $('#vendorreceivablepaytype-ptypeid').find('*').prop('disabled',true);
          paytype='<?php echo $mdlVendorPaytype->ptypeid; ?>';
          chqno='<?php echo $mdlVendorPaytype->chq_no; ?>';
          chq_dt='<?php echo $mdlVendorPaytype->chq_date; ?>';
//         alert('after in edit...'+paytype);
//         alert('after in edit...'+chqno);
//         alert('after in edit...'+chq_dt);
         $("input[name='VendorReceivablePayType[ptypeid]']").val(paytype);
         //$("#vendorreceivablepaytype-chq_no").val(chqno);
         //$("#vendorreceivablepaytype-chq_date").val(chq_dt);
         $("input[name='VendorReceivablePayType[chq_no]']").val(chqno);
         $("input[name='VendorReceivablePayType[chq_date]']").val(chq_dt);
//         alert( $("input[name='VendorReceivablePayType[chq_no]']").val());
//         alert($("input[name='VendorReceivablePayType[chq_date]']").val());
      }


leadid=$(".vlid").val();
if(leadid!=''){
 $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=vendorleads/convertdata",           
           data:{id:leadid},
           success:  function(result) {    
               //alert('Hi..m In...vendorleads....');
              $.each(result, function(index, value) {                    
                 $("#vendor-firstname").val(value['firstname']);
                 $("#vendor-lastname").val(value['lastname']);
                 $("#vendor-email").val(value['email']);
                 $("#vendor-website").val(value['website']);
                 $("#vendor-businessname").val(value['businessname']);
                 $("#vendor-vendtor_type").val(value['vendor_type']);
                 $("#vendor-phone1").val(value['phone1']);
                 $("#vendor-phone2").val(value['phone2']);
                 $("#vendor-address1").val(value['address1']);
                 $("#vendor-address2").val(value['address2']);
                 $("#vendor-city").val(value['city']);
                 $("#vendor-state").val(value['state']);
                 $("#vendor-pin").val(value['pin']);
                 $("#vendor-franchisee").val(value['frid']);
                 $("#vendor-franchexecutive").val(value['crtby']);
             }); 
            },
    }); 
}

<?php if(Yii::$app->user->isGuest){?>
jQuery("input[name='VendorReceivablePayType[ptypeid]']").each(function(i) {           
            if($(this).val()!=3){
                jQuery(this).attr('disabled', true);
            }else{
                jQuery(this).attr('checked', true);
                $('#vendorreceivablepaytype-chq_no').val(0);               
                var dt='<?= date('Y/m/d')?>';
                //alert(dt);
                $('#vendorreceivablepaytype-chq_date').val(dt);
            }          
});
<?php } ?>
 
</script>


<script type="text/javascript">
    $(document).ready(function(){
    <?php if(!$model->isNewRecord) {?>    
        var paytype='<?php echo $mdlVendorPaytype->ptypeid; ?>';        
        if(paytype=="3")
        {               
               $(".chq").text("Tansaction No.");  
               $(".chqdt").text("Tansaction Date");  
        }
        if(paytype=="4")
        {              
                $(".chq").text("Add DD No.");  
               $(".chqdt").text("Add Date");  
        }
        <?php if($model->payment==1 && $model->delivery==1) {?>
             $("#dp").css('display','block');
        <?php } ?>

       var con='<?php echo $model->country;?>';
    <?php }?>
       getPlan(); 
       getDP();
    });
    
    <?php if(!$model->isNewRecord) {?>        
       $( window ).load(function() {
                //alert("On load...");
                var plan='<?php echo $model->plan; ?>';                
                $("#vendor-plan").val(plan);
        });
      <?php } ?>
</script>