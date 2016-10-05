<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RoiB */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Roi B',
]) . ' ' . $model->getPartner($model->dpid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roi Bs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getPartner($model->dpid), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="roi-b-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cityData' => $cityData,
    ]) ?>

</div>
