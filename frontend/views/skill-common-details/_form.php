<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SkillCommonDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--script src="http://lab.iamrohit.in/js/location.js"></script-->
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/location.js"></script>

<div class="skill-common-details-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'firstname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'middlename')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($user, 'email')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($user, 'phone')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'address1')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'address2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
       
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'state')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($userdetailmodel, 'country')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'birthdate')->textInput() ?>
         </div>
    </div>

    <div class="row">
         <div class="col-xs-3">
            <!--?= $form->field($model, 'birthplaceid')->textInput() ?-->
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?php $condata=array();
                  echo $form->field($country, 'id')->dropDownList($condata,['prompt'=>'Select', 'class'=>'form-control countries']); ?>
         </div>
    </div>    
    
    <div class="row">
         <div class="col-xs-3">
            <?php $statedata=array();
                  echo $form->field($state, 'id')->dropDownList($statedata,['prompt'=>'Select', 'class'=>'form-control states']); ?>
         </div>
    </div>
    
     <div class="row">
         <div class="col-xs-3">
            <?php $citydata=array();
                  echo $form->field($city, 'id')->dropDownList($citydata,['prompt'=>'Select', 'class'=>'form-control cities']); ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?php $reg=  frontend\models\SkillsReligion::find()->all();
                  $religiondata=ArrayHelper::map($reg, 'regid', 'religion_name');
                 echo $form->field($model, 'religionid')->dropDownList($religiondata,['prompt'=>'Select']); ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?php $faith= \frontend\models\SkillsFaith::find()->all();
                  $faithdata= ArrayHelper::map($faith, 'faithid', 'faith');
                  echo $form->field($model, 'faithid')->dropDownList($faithdata,['prompt'=>'Select']); ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?php $cast=  \frontend\models\SkillsCast::find()->all();
                  $castdata= ArrayHelper::map($cast, 'castid', 'cast');
                  echo $form->field($model, 'castid')->dropDownList($castdata,['prompt'=>'Select']); ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'marrital_status')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'landline')->textInput() ?>
         </div>
    </div>
    
   <div class="row">
         <div class="col-xs-3">          
            <?= $form->field($model, 'blog')->textarea(['rows' => 6]) ?>
         </div>
   </div>
    
    <div class="row">
         <div class="col-xs-3">
            <?= $form->field($model, 'annual_income')->textInput() ?>
         </div>
    </div>
    
    
    <div class="col-xs-3">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
  
    <?php ActiveForm::end(); ?>

</div>
