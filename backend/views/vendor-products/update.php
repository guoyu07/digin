<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorProducts */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Vendor Products',
]) . ' ' . $model->vpid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendor Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vpid, 'url' => ['view', 'id' => $model->vpid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vendor-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
