<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DeliveryPartner */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Delivery Partner',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delivery Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->dpid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="delivery-partner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
