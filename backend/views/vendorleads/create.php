<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Vendorleads */

$this->title = Yii::t('app', 'Import VendorLeads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendorleads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendorleads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mdlvendor' => $mdlvendor,
    ]) ?>

</div>
