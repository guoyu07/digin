<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Orderitem',
]) . ' ' . $model->oritemid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orderitems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oritemid, 'url' => ['view', 'id' => $model->oritemid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="orderitem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
