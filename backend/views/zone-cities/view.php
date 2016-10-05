<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ZoneCities */

$this->title = $model->getZonename($model->zid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zone Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-cities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            //'id',
            //'zid',
            [
                'label' => 'Zone',
                'attribute' => 'zid',
                'value' => $model->getZonename($model->zid),
            ],
            //'cityid',
            [
                'label' => 'Delivery Partner',
                'attribute' => 'dpid',
                'value' => $model->getPartner($model->dpid),                
            ],
            [
                'label' => 'City',
                'attribute' => 'cityid',
                'value' => $model->getCity($model->zid),
            ],
          /*  'crtdt',
            'crtby',
            'upddt',
            'updby', */
        ],
    ]) ?>

</div>
