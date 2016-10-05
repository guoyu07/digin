<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorProducts */

$this->title = \backend\models\Product::findOne( $model->prid)->prodname ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendor Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->vpid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->vpid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'vpid',
            //'vid',
            //'prid',
            [
                       'label' => 'Product',
                       'attribute' => 'prid',
                       'value' => \backend\models\Product::findOne( $model->prid)->prodname                          
             ],
            //'unit',
            'price',
             [
                       'label' => 'unit',
                       'attribute' => 'unit',
                       'value' => \backend\models\Units::findOne($model->unit)->unitname
                            
               
            ],
           /* 'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
