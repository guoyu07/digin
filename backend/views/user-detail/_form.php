<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-3">
            <?php /*************new****************/ 
                if(!Yii::$app->user->isGuest) {
                      $auth = Yii::$app->authManager; 
                      $roles=$auth->getRoles();
                      foreach ($roles as $rolenm=>$role) {
                          if($role->name=='Admin' || $role->name=='Executive')
                        $userRole[$rolenm] = $role->name;
                      }
                      //var_dump($userRole);
                     // $data= yii\helpers\ArrayHelper::map($roles, 'name', 'name');                       
                      echo $form->field($model, 'role')->dropDownList($userRole); 
                } ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
       
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true])  ?> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
             <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
   
    <!--?= $form->field($model, 'crtdt')->textInput() ?>

    < ?= $form->field($model, 'crtby')->textInput() ?>

    < ?= $form->field($model, 'upddt')->textInput() ?>

    < ?= $form->field($model, 'updby')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
