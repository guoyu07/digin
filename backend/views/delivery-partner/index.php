<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DeliveryPartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Delivery Partners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-partner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Delivery Partner'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo "&nbsp;&nbsp;<a href='index.php?r=upload/import'>Import Cities</a>"; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dpid',
            'name',
            'fuelsurcharge',
            'CODmin',
            'COD',
            'volwtdenominator',
            // 'RTOCharge',
            // 'reversepickupsurcharge',
            // 'COF',           
            // 'octroisurcharge',
            // 'holidaydeliverycharge',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
