<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\DeliveryPartner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delivery Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<div class="delivery-partner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->dpid], ['class' => 'btn btn-primary']) ?>
        <!--?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->dpid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?-->
    </p>

    <!--?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dpid',
            'name',
            'fuelsurcharge',
            'CODmin',
            'COD',
            'RTOCharge',
            'reversepickupsurcharge',
            'COF',
            'volwtdenominator',
            'octroisurcharge',
            'holidaydeliverycharge',
            /*'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?-->
        
</div>

<?php $dppackages= \backend\models\Dppackage::find()->where(['dpid'=>$model->dpid])->all();
      $totaldppackages=sizeof($dppackages);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>D P Packages</h3>
                      <p><?= $totaldppackages ?></p>
                    </div>                
                <a href="<?= Url::to(['/dppackage/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $zones= \backend\models\Zone::find()->where(['dpid'=>$model->dpid])->all();
      $totalzones=sizeof($zones);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Zones</h3>
                      <p><?= $totalzones ?></p>
                    </div>                
                <a href="<?= Url::to(['/zone/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $zonecities= \backend\models\ZoneCities::find()->where(['dpid'=>$model->dpid])->all();
      $totalzonecities=sizeof($zonecities);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Zone Cities</h3>
                      <p><?= $totalzonecities ?></p>
                    </div>                
                <a href="<?= Url::to(['/zone-cities/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $metro= \backend\models\Metro::find()->where(['dpid'=>$model->dpid])->all();  //->groupBy('dpid')
      $totalmetros=sizeof($metro);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Metros</h3>
                      <p><?= $totalmetros ?></p>
                    </div>                
                <a href="<?= Url::to(['/metro/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $roia= \backend\models\RoiA::find()->where(['dpid'=>$model->dpid])->all();
      $totalroia=sizeof($roia);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>RoI-A</h3>
                      <p><?= $totalroia ?></p>
                    </div>                
                <a href="<?= Url::to(['/roi-a/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $roib= \backend\models\RoiB::find()->where(['dpid'=>$model->dpid])->all();
      $totalroib=sizeof($roib);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>RoI-B</h3>
                      <p><?= $totalroib ?></p>
                    </div>                
                <a href="<?= Url::to(['/roi-b/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $specialdestinations= \backend\models\Specialdestination::find()->where(['dpid'=>$model->dpid])->all();
      $totalspecialdestinations=sizeof($specialdestinations);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Spl Destinations</h3>
                      <p><?= $totalspecialdestinations ?></p>
                    </div>                
                <a href="<?= Url::to(['/specialdestination/index', 'id'=>$model->dpid])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
