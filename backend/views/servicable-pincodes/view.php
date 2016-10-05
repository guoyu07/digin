<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicablePincodes */

$this->title = $model->getCity($model->cityid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicable Pincodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicable-pincodes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->pinid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->pinid], [
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
            [
                'label' => 'City',
                'attribute' => 'cityid',
                'value' => $model->getCity($model->cityid),
            ],
            
            [
                'label' => 'Pincode',
                'attribute' => 'pincode',
                'value' =>  $model->getPincode($model->cityid),
                        
            ],
//            'pinid',
//            'dpid',
//            'cityid',
//            'pincode',
//            'crtdt',
//            'crtby',
//            'upddt',
//            'updby',
        ],
    ]) ?>

</div>
