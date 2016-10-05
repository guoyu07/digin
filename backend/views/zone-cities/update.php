<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ZoneCities */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Zone Cities',
]) . ' ' . $model->getZonename($model->zid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zone Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getZonename($model->zid), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="zone-cities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cityData' => $cityData,
    ]) ?>

</div>
