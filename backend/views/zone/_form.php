<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Zone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zone-form">

    <?php $form = ActiveForm::begin(); ?>
    
     <?php $dlpartners=  backend\models\DeliveryPartner::find()->where(['!=','dpid',1])->all();
          $dpdata=  ArrayHelper::map($dlpartners, 'dpid', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'dpid')->dropDownList($dpdata,['prompt'=>'Select'])  ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
 
  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
