<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\diginleadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Digin Leads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diginleads-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'vid',
             [
              'label'=>'Vendor Name.',
              'attribute'=>'vid',
              'value'=> function ($model) {
                     $vanname = $model->getVendername($model->vid);
                     return $vanname;
                    
                },
              
            ],
            'leadType',
            'leadName',
            'leadEmail:email',
             'leadPhone',
             'crtdt',

           ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]); ?>
</div>
