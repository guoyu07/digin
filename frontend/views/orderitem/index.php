<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vendor Order Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-12">
		<div class="orderitem-index">
		  <!--?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?-->
			<h1><?= Html::encode($this->title) ?></h1>
			<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

		   
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
			   
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'oritemid',
					//'orid',
					//'vpid',
					 [
					  'label'=>'Order No.',
					  'attribute'=>'orid',
					  'value'=> function ($model) {
							 //$orderitem=new \backend\models\Orderitem();
							$orderid = $model->getOrderNo($model->orid);
							 return $orderid;
							
						},
					  
					],
								
					 [
					  'label'=>'Order Items',
					  'attribute'=>'vpid',
					  'value'=> function ($model) {
							 //$orderitem=new \backend\models\Orderitem();
							$orderitem = $model->getOrderItems($model->vpid);
							 return $orderitem;
							
						},
					  
					],
					  [
					  'label'=>'City',
					  'attribute'=>'city',
					  'value'=> function ($model) {
							 //$address=new \backend\models\Address();
							  $address = $model->getAddress($model->orid);
							 return $address;
						},
					   
				   ],
					 //'delivery_pin',
				   [
					  'label'=>'Delivery_Pin',
					  'attribute'=>'delivery_pin',
					   'format'=>'raw',
					   'value' => function($model, $key, $index, $column) {
							   // $model = new \backend\models\Orderitem();
								 //$id = $model->getDeliveryPin($model->oritemid);
							 if($model->delivery_status!='Delivered'){
								 return $this->render('Deliveryform',[
								  'model' => $model,
							  ]); 
							  }else{
								  return '--';
							  }
						 },
						
					],
					//'rate',
					//'quantity',
					// 'producttotal',
					// 'crtdt',
					// 'crtby',
					// 'upddt',
					// 'updby',
					  'delivery_status',

					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>

		</div>
	</div>
</div>
<!--?php ActiveForm::end(); ?-->