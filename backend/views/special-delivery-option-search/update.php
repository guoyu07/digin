<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpecialDeliveryOption */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Special Delivery Option',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Special Delivery Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="special-delivery-option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
