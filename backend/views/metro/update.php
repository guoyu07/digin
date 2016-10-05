<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Metro */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Metro',
]) . ' ' . $model->getPartner($model->dpid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getPartner($model->dpid), 'url' => ['view', 'id' => $model->mid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="metro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cityData' => $cityData,
    ]) ?>

</div>
