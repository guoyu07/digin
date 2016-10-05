<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->prodname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $sourcepath=\yii\helpers\Url::to('/advanced/vendor/kartik-v/bootstrap-fileinput/css/fileinput.css'); 
$this->registerCssFile($sourcepath);
?>
<!--link rel="stylesheet" type="text/css" href="< ?php echo $sourcepath; ?>" /-->
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->prid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->prid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php   $count=0;
    echo "<div class=row><div class=col-xs-12>";
foreach ($mdlproductimage as $prodimg){   
   $bgcolor=''; 
  if($prodimg->image !='')
  {
    //echo Html::img(Yii::$app->request->baseUrl. '/../../images/productimages/'. $model->prid.'/'. $prodimg->image, ['width'=>'auto', 'height'=>160, 'alt'=>'Blank','class' =>'file-preview-image','style'=>'margin:10px 10px 10px 10px;' ]); 
    $imgpath=Yii::getAlias("@frontendimageurl"). '/images/productimages/'. $model->prid.'/';
    if($prodimg->ismain==1){
        $bgcolor='#F1D8D8';
    }
    $displayimg=Html::img($imgpath.$prodimg->image,['class'=>'file-preview-image', 'name'=>'dbimage','width'=>'auto', 'height'=>160,'title'=>$prodimg->image]);                   
    echo "<div class=file-preview-frame id=img_$count style=background-color:$bgcolor;>".$displayimg."<span class=file-footer-caption>$prodimg->image</span></div>";
    }
   else
   {
    echo Html::img(Yii::getAlias("@frontendimageurl"). '/images/productimages/default_image.png', ['width'=>'auto', 'height'=>160, 'alt'=>'Blank','class' => 'file-preview-image']);       
   }
  $count++;
}
   echo "</div></div>";
    
   ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'prid',
            'prodname',
            //'categoryid',            
            [
                'label'=>'Product Categories',
                'format'=>'raw',
                'value'=> Html::beginTag('div').$model->getProductCategory($model->prid).Html::endTag('div'),
            ],
            //'description:ntext',
             [
                'label'=>'Brand',
                'value'=>$model->getBrandName($model->prid),
            ],
            [
                'label'=>'Description',
                'format'=>'html',
                'value'=> $model->description,
            ],
           
            /*'crtdt', 
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
