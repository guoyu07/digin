<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\Models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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

  <?php  
  if($model->image !='')
  {
    echo Html::img(Yii::$app->request->baseUrl. '/../../images/categoryimages/'. $model->id.'/'. $model->image, ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']);       
   }
   else
   {
    echo Html::img(Yii::$app->request->baseUrl. '/../../images/categoryimages/default_image.png', ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']);       
   }
    
   ?>
   
    
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'parentid',
            'description',
            'tags', 
            'path',
            [
                'label'=>'Facilities',
                'value'=>$model->getFacility($model->id),
            ],
           
            /*'crtdt',            
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
