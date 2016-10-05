<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DppackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Delivery Partner Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dppackage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Delivery Partner Package'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'dpid',            
            [
                 'label' => 'Delivery Partner',
                 'attribute' => 'deliverypartner',               
                 'value' => 'deliverypartner.name',
            ],
            'packagename',
            //'crtdt',
            //'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
