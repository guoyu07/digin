<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorCurrencySetting */

$this->title = Yii::t('app', 'Update {modelClass} ', [
    'modelClass' => 'Vendor Currency Setting',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendor Currency Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vendor-currency-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'mdlvendor' => $mdlvendor,
    ]) ?>

</div>
