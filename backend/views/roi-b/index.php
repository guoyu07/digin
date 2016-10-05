<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoiBSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'RoI-B');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roi-b-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Roi B'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                 'label' => 'Delivery Partner',
                 'attribute' => 'deliverypartner',               
                 'value' => 'deliverypartner.name',
            ], 
            //'cityid',
            [
                 'label' => 'City',
                 'attribute' => 'city',               
                 'value' => function($data){
                    return $data->getCity($data->dpid);
                 },
            ],
            
//            'id',
//            'dpid',
//            'cityid',
//            'crtdt',
//            'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
