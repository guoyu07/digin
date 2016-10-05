<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Vendor',
]) . ' ' . $model->vid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendors')];
$this->params['breadcrumbs'][] = ['label' => $model->businessname, 'url' => ['view', 'id' => $model->vid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
	<div class="col-md-12">
<div class="vendor-update">

    <h1 class="mLR15"><?= Html::encode($model->businessname) ?></h1>

    <?=    //var_dump($mdlVendorPaytype);
        $this->render('_form', [
        'model' => $model,
        'mdlVendorWorkinghours' => $mdlVendorWorkinghours,              
        'mdlvenfac' => $mdlvenfac,
        'venfacilityData' => $venfacilityData,
        //'venpaytypeData' =>  $venpaytypeData,
        'mdlVendorPaytype' =>$mdlVendorPaytype,
    ]) ?>

</div>
</div>
</div>
