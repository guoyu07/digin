<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PincodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pincodes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pincode-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add Pincode'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            //'cityid',
            [
                 'label' => 'City',
                 'attribute' => 'cityid',               
                 'value' => function($data){
                    return $data->getCity($data->cityid);
                 },
            ],
            
           // 'pnid',
//            'city_id',
           //'pincode',
             [
                'label' => 'Pincode',
                'attribute' => 'pincode',
                'value' => function($data){
                          return $data->getPincode($data->cityid);
                },
            ],
//            'crtdt',
//            'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
