<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServicablePincodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Servicable Pincodes');
$this->params['breadcrumbs'][] = $this->title;
?>
  <?php 
   
   if(isset($result) && $result != ''){
   if($result==null){ ?>
    <div class="alert alert-success" id="import">
  <strong>Success!</strong> Import has done successfully.
   </div> <?php } }?>
   
  <?php   
  if(isset($result) && $result != '' && sizeof($result)>0){?>   
    <div class="alert alert-danger" id="importfl">
        Following cities pincodes are not saved due to some error.
        <br><br> 
        <?php $cities=  implode(", ", $result);
            echo $cities;?>
  </div> 
    <?php  } ?>

<div class="servicable-pincodes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add Servicable Pincodes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pinid',
            //'dpid',
            //'cityid',
          /*  [
                 'label' => 'Delivery Partner',
                 'attribute' => 'dpid',               
                 'value' => function($data){
                    return $data->getPartner($data->dpid);
                 },
            ], */
            [
                 'label' => 'Delivery Partner',
                 'attribute' => 'deliverypartner',               
                 'value' => 'deliverypartner.name',
            ],
            [
                 'label' => 'City',
                 'attribute' => 'city',               
                 'value' => function($data){
                    return $data->getCity($data->cityid);
                 },
            ],
           // 'pincode',
            [
                'label' => 'Pincode',
                'attribute' => 'pincode',
                'value' => function($data){
                          return $data->getPincode($data->cityid);
                },
            ],
            //'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
