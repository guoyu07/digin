<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendorleads */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Vendorleads',
]) . ' ' . $model->vlid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendorleads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vlid, 'url' => ['view', 'id' => $model->vlid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vendorleads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
