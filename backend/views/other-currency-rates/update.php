<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OtherCurrencyRates */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Other Currency Rates',
]) . $model->ocid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Other Currency Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ocid, 'url' => ['view', 'id' => $model->ocid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="other-currency-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
