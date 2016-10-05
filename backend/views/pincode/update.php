<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pincode */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pincode',
]) . ' ' . $model->getCity($model->cityid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pincodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getCity($model->cityid), 'url' => ['view', 'id' => $model->pnid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pincode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pinData'=> $pinData,
    ]) ?>

</div>
