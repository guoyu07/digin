<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Vendor',
]) . ' ' . $model->vid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->businessname, 'url' => ['view', 'id' => $model->vid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vendor-update">

    <h1><?= Html::encode($model->businessname) ?></h1>

    <?=    //var_dump($mdlVendorPaytype);
        $this->render('_form', [
        'model' => $model,
        'mdlVendorWorkinghours' => $mdlVendorWorkinghours,              
        'mdlvenfac' => $mdlvenfac,
        'venfacilityData' => $venfacilityData,
        //'venpaytypeData' =>  $venpaytypeData,
        'mdlVendorPaytype' =>$mdlVendorPaytype,
        'mdlspcdlvroptn' => $mdlspcdlvroptn,
    ]) ?>

</div>
