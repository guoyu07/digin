<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicablePincodes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Servicable Pincodes',
]) . ' ' . $model->getCity($model->cityid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicable Pincodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getCity($model->cityid), 'url' => ['view', 'id' => $model->pinid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="servicable-pincodes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pinData'=> $pinData,
    ]) ?>

</div>
