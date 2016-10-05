<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Franchisee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Franchisees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="franchisee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->frid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->frid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
      <?php
            if ($model->idlogo !='')
            {
                if(preg_match("/\.(pdf|gif|png|jpeg)$/", $model->idlogo)){
                     echo '<a href="'.Yii::$app->request->baseUrl. '/../../images/franchiseeid/'.$model->frid.'/'.$model->idlogo.'" target="_blank">'.Html::img(Yii::$app->request->baseUrl. '/../../images/franchiseeid/pdf.jpg', 
                            ['width'=>100, 'height'=>100, 'alt'=>'Blank','class' => 'pull-left img-responsive']).'</a>';      
      
                }else{
                    echo Html::img(Yii::$app->request->baseUrl. '/../../images/franchiseeid/'. $model->frid.'/'. $model->idlogo, 
                            ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']);       
            
                }
                }
            else
            {
                    echo Html::img(Yii::$app->request->baseUrl. '/../../images/franchiseeid/default_image.png', 
                            ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']);       
            }
            ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'frid',
            'name',
            'code',
            'description:ntext',
            //'adrid',
            [
                    'label'=>'Address',                    
                    'value'=> backend\models\Address::findOne($model->adrid)->city
            ],
            /*'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
