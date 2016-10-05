<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */
if(Yii::$app->user->isGuest)
{
    $this->title = Yii::t('app', 'Vendor Registration');
    //$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendors'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;  
}else{
$this->title = Yii::t('app', 'Create Vendor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="row">
    <div class="col-md-12">
<div class="vendor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php    
       echo $this->render('_form', [
        'model' => $model,
        'mdlVendorWorkinghours' => $mdlVendorWorkinghours,        
        //'mdlVendorWorkinghours1' => $mdlVendorWorkinghours1,   
        'mdlvenfac' => $mdlvenfac,
        'mdlVendorPaytype' => $mdlVendorPaytype,        
    ])  ?>

</div>
</div>
</div>
