<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pincode */

$this->title = $model->getCity($model->cityid);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pincodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pincode-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->pnid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->pnid], [
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
//            'pnid',
//            'city_id',
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
           
//            'crtdt',
//            'crtby',
//            'upddt',
//            'updby',
            
        ],
    ]) ?>

</div>
