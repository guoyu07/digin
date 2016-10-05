<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/vendorleads.js"></script>
<div class="vendorleads-form">
   <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data','id'=>'vendorleadsform']]); ?>  
        
    <?php
          $auth=Yii::$app->authManager;
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
          }
    if($userRole=='Admin' || $userRole=='Superadmin' || $userRole=='Franchisee Manager') { 
        $franchisee=  \backend\models\Franchisee::find()->all();
        
        $franchdata=  ArrayHelper::map($franchisee, 'frid', 'name'); ?>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($mdlvendor, 'franchisee')->dropDownList($franchdata,['prompt'=>'Select',
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
            <?= $form->field($mdlvendor, 'franchexecutive')->dropDownList($exedata,['prompt'=>'Select'])?>
        </div>            
    </div>

    <?php } ?>
  <div class="row">
       <div class="col-xs-3">
           <?= $form->field($model,'excelfile')->fileInput() ?>
       </div>
  </div>
    
     
   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Import') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ?'btn btn-success submit' : 'btn btn-primary']) ?>
  <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
</div>

 <?php ActiveForm::end(); ?>
</div>
