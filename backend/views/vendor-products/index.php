<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vendor Products');
$this->params['breadcrumbs'][] = $this->title;
$vendorid= Yii::$app->request->get('id'); 
?>
<div class="vendor-products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Vendor Products'), ['create', 'id'=>$vendorid], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                       'label' => 'Product',
                       'attribute' => 'product',
                       'value' => function ($data) {                           
                            return \backend\models\Product::findOne($data->prid)->prodname;                          
                },
            ],           
            [
                       'label' => 'Unit',
                       'attribute' => 'unit',
                       'value' => function ($data) {                           
                            return ($data->unit==0 ? 'None' :\backend\models\Units::findOne($data->unit)->unitname);                         
                },
            ],
            'price',            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
