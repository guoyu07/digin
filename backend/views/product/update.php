<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . ' ' . $model->prodname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prodname, 'url' => ['view', 'id' => $model->prid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mdlproductimage'=> $mdlproductimage,
        'mdlProductCategory'=>$mdlProductCategory,
        'prodcatdata'=>$prodcatdata,
  'mdlvendorproduct'=>$mdlvendorproduct,
        'mdlBrandproduct'=>$mdlBrandproduct
        //'prodimage' =>$prodimage
    ]) ?>

</div>
