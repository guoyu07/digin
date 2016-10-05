<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SkillsOccupationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skills Occupations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-occupation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Skills Occupation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'filterModel' => $searchModel,
        //'showFooter'=>true,
        //'showHeader' => true,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ocid',
            //'userid',
         /*   'occupationtype',
            'company',
            'designation',
            // 'tenure',
             'fromdate',
             'todate',       */
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            [
                'label'=>'Occupation Details',
                'format' => 'raw',
                'value'=>function ($data) {                                   
                   $htmlvalue="<table>
                <thead>
                  <tr>
                    <th style='width:130px;'>Type: </th>
                    <td style='width:160px;'>".$data->occupationtype."</td>
                    <th style='width:130px;'>Designation: </th>
                    <td >".$data->designation."</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>     
                    <th>Company: </th>
                    <td>".$data->company."</td>
                  </tr>    
                  <tr>
                    <th>From: </th>
                    <td>".$data->fromdate."</td>
                    <th>To:</th>
                    <td>".$data->todate."</td>
                  </tr>
                  <tr>
                    <th>Description: </th>      

                  </tr>
                  <td colspan='4'>".$data->description."</td>   
                </tbody>
              </table>";                           
                    return $htmlvalue;
                 },
            ],
                
            ['class' => 'yii\grid\ActionColumn',
                 'template'=>'{update} {delete}'],
        ],
        
        
    ]); ?>
    
  
</div>
<style type="text/css">
    table {
  //border-collapse: collapse;
  //width: 500px;
}

td, th {
  //border: 1px solid #999;
  padding: 0.5rem;
  text-align: left;  
}

</style>