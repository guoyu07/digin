<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PackageratesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packagerates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packagerates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Packagerates'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rid',
            'pkgid',
            'initialweight',
            'withincityrate',
            'zonerate',
            'metrorate',
            // 'RoI-Arate',
            // 'RoI-Brate',
            // 'spldestrate',
            // 'addweightmultiple',
            // 'addwithincityrate',
            // 'addzonerate',
            // 'addmetrorate',
            // 'addRoI-Arate',
            // 'addRoI-Brate',
            // 'addspldestrate',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
