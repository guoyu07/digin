<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Dppackage */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Delivery Partner Package',
]) . ' ' . $model->packagename;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delivery Partner Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->packagename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dppackage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mdlpkgrates' => $mdlpkgrates,
        'mdlbulkrates' => $mdlbulkrates,
    ]) ?>

</div>
