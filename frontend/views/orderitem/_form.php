<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
	<div class="col-md-12">
		<div class="orderitem-form">

			<?php $form = ActiveForm::begin(); ?>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?= $form->field($model, 'orid')->textInput() ?>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?= $form->field($model, 'vpid')->textInput() ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?= $form->field($model, 'rate')->textInput() ?>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">	
				<?= $form->field($model, 'quantity')->textInput() ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<?= $form->field($model, 'producttotal')->textInput() ?>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<?= $form->field($model, 'crtdt')->textInput() ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<?= $form->field($model, 'crtby')->textInput() ?>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<?= $form->field($model, 'upddt')->textInput() ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<?= $form->field($model, 'updby')->textInput() ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>
