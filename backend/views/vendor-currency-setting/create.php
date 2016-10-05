<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\VendorCurrencySetting */

$this->title = Yii::t('app', 'Create Vendor Currency Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendor Currency Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-currency-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mdlvendor' => $mdlvendor,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
