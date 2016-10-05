<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\VendorProducts */

$vendorid= Yii::$app->request->get('id'); 
if($model->isNewRecord)
    $vendor=  \backend\models\Vendor::find()->where(['vid'=>$vendorid])->one(); 
else{
    $updatevendorid= \backend\models\VendorProducts::findOne($vendorid);
    $vendor=  \backend\models\Vendor::find()->where(['vid'=>$updatevendorid->vid])->one(); 
}
$this->title = Yii::t('app', $vendor->businessname. ' Products');  
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendor Products'), 'url' => ['index', 'id'=>$vendorid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,        
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
