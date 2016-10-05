<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorCurrencySettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vendor Currency Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-currency-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!--?= Html::a(Yii::t('app', 'Create Vendor Currency Setting'), ['create'], ['class' => 'btn btn-success']) ?-->
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'vid',
             [
                'label'=>'Vendor Name',
                'attribute'=>'vid',
                'format'=>'raw',
                'value'=>function($model){
                        $vennam=$model->getVendorname($model->vid); 
                        return $vennam;
                        
                    },
                   ],
            'base_currency',
            'country',
            'currency',
            // 'currency_rate',
            // 'percentaddition',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
