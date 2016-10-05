<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Userreview */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Userreview',
]) . ' ' . $model->urid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->urid, 'url' => ['view', 'id' => $model->urid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="userreview-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
