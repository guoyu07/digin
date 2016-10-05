<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Packagerates */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Packagerates',
]) . ' ' . $model->rid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packagerates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rid, 'url' => ['view', 'id' => $model->rid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="packagerates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
