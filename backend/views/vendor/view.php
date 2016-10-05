<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title =$model->businessname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<div class="vendor-view">

    <h1><?= Html::encode($model->businessname) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->vid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->vid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

     <?php  
            if ($model->logo !='')
            {
                    echo Html::img(Yii::getAlias("@frontendimageurl"). '/images/vendorlogo/'. $model->vid.'/'. $model->logo, 
                            ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']);       
            }
            else
            {
                    echo Html::img(Yii::getAlias("@frontendimageurl"). '/images/vendorlogo/default_image.png', 
                            ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']);       
            }
            ?>
    
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'vid',
            'firstname',
            'lastname',
            'email:email',
            'website',
            'businessname',
            //'logo',
            //'vendtor_type',
            [
                    'label'=>'Vendor Type',                    
                    'value'=> backend\models\Vendortype::findOne($model->vendtor_type)->type
            ],
            'phone1',
            'phone2',
            'aboutme:ntext',
            'address1',
            'address2',
            'city',
            'state',
            'pin',
            //'location',
            'googleaddr',
            //'plan',
            [
                    'label'=>'Plan',                    
                    'value'=>  backend\models\Plan::findOne($model->plan)->name
            ],
            [
                'label'=>'Facilities',
                'value'=>$model->getVendorFacility($model->vid),
            ],
            [
                'label'=>'Payment Types',
                'value'=>$model->getPaymentType($model->vid),
            ],
            'status',   
            /*'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>
   <?php 
    //var_dump(sizeof($VendorWorkinghrs));  
    echo Html::label("Working Hours");      
    /*echo "<table  id='wrkhrtable' border='1' >";   //class='table table-striped'
    echo Html::beginTag('tr');
          echo Html::tag('th', 'Day');  
          echo Html::tag('th', 'Shift');
          echo Html::tag('th','From');          
          echo Html::tag('th','To');
    echo Html::endTag('tr');
    
        foreach ($VendorWorkinghrs1 as $vw){
        echo "<tr>";   
                    $num=$vw['day'];
                    echo "<td class='wrktd' align='center'>".date('l', strtotime("Sunday + $num Days"))."</td>";
                    if($vw['shift']=='M')
                        echo "<td class='wrktd' align='center'>Morning</td>";                    
                    echo "<td class='wrktd' align='center'>".$vw['timefrom']."</td>"; 
                    echo "<td class='wrktd' align='center'>".$vw['timeto']."</td>";                     
        echo "</tr>"; 
        }
        if($model->shift=='D')
        {
        foreach ($VendorWorkinghrs2 as $vw){
        echo "<tr>";      
                    $num=$vw['day'];
                    echo "<td class='wrktd' align='center'>".date('l', strtotime("Sunday + $num Days"))."</td>";
                    if($vw['shift']=='E')
                        echo "<td class='wrktd' align='center'>Evening</td>";                    
                    echo "<td class='wrktd' align='center'>".$vw['timefrom']."</td>"; 
                    echo "<td class='wrktd' align='center'>".$vw['timeto']."</td>"; 
        echo "</tr>"; 
        }
        }
    
      echo "</table>";
      */
     
    //$num = 6;
    //echo date('l', strtotime("Sunday + $num Days"));
      
      echo Html::beginTag('table class="table table-striped"');
          echo Html::beginTag('tr');
          
          //echo Html::tag('th', 'Day'); // for hable head 
          echo Html::tag('th', 'Shift ');
          echo Html::tag('th','');
          echo Html::tag('th','Mon');          
          echo Html::tag('th','Tue');
          echo Html::tag('th','Wed');
          echo Html::tag('th','Thur');
          echo Html::tag('th','Fri');
          echo Html::tag('th','Sat');
          echo Html::tag('th','Sun');          
          echo Html::endTag('tr');
          
          echo Html::beginTag('tr');
          if($model->shift=='S')
            echo Html::tag('td','Single Shift'); 
          if($model->shift=='D')
            echo Html::tag('td','Morning Shift');  
          echo Html::tag('td','From'); 
          foreach ($VendorWorkinghrs1 as $vw){              
                    echo "<td>".$vw['timefrom']."</td>"; 
          }
          echo Html::endTag('tr');
          echo Html::beginTag('tr');
          echo Html::tag('td',''); 
          echo Html::tag('td','To'); 
          foreach ($VendorWorkinghrs1 as $vw){
                echo "<td>".$vw['timeto']."</td>";   
          }
          echo Html::endTag('tr');
          
          if($model->shift=='D')
          {
                echo Html::beginTag('tr');                
                echo Html::tag('td','Evening Shift'); 
                echo Html::tag('td','From'); 
                foreach ($VendorWorkinghrs2 as $vw){              
                          echo "<td>".$vw['timefrom']."</td>"; 
                }
                echo Html::endTag('tr');
                echo Html::beginTag('tr');
                echo Html::tag('td',''); 
                echo Html::tag('td','To'); 
                foreach ($VendorWorkinghrs2 as $vw){
                      echo "<td>".$vw['timeto']."</td>";   
                }
                echo Html::endTag('tr');
          }
          echo Html::endTag('table');
 
?> 
    
</div>
