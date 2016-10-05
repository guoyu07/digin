<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorleadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vendor leads');
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/vendorleads.js"></script>

<div class="vendorleads-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
       <?php $auth=Yii::$app->authManager;
          $users=array();
          if(!Yii::$app->user->isGuest){
          $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);          
          if ($userRole) {
            foreach ($userRole as $role) {
               $roles[] = $role->name;
            }
            // if user have 1 role then $userRole will be a string containing it
            // othewhise let $userRole be an array containing them all
            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
          } 
        }
        if($userRole=='Admin' || $userRole=='Superadmin') { ?>
        <?php echo Html::a(Yii::t('app', 'Import Vendor leads'), ['create'], ['class' => 'btn btn-success']) ?>
        <a href="<?php echo Yii::$app->request->baseUrl?>/template_file.xls">&nbsp;Template_File</a>
        <?php } ?>
    </p>
   <?php 
     if(isset($arraydata) && $arraydata != ''){ 
  if($arraydata==null){ ?>
    <div class="alert alert-success" id="import">
  <strong>Success!</strong> Import has done successfully.
    </div> <?php }} ?>
   
  <?php   
  if(isset($arraydata) && $arraydata != '' && sizeof($arraydata)>0){?>
   
    <div class="alert alert-danger" id="importfl">
        Please Set atleast one of email,phone1,phone2 for following records and upload these records only.<br><br>
        <table width="700" border="0">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Businessname</th>
    <th>City</th>
    <th>State</th>
  </tr>
  <?php foreach ($arraydata as $a) {?>
  <tr>
      <td><font color="#a94442"><?php echo $a['firstname'];?></font></td>
    <td><font color="#a94442"><?php echo $a['lastname'];?></font></td>
    <td><font color="#a94442"><?php echo $a['businessname'];?></font></td>
    <td><font color="#a94442"><?php echo $a['city'];?></font></td>
    <td><font color="#a94442"><?php echo $a['state'];?></font></td>
  </tr>
  <?php } ?>
</table>
        
  </div> 
    <?php  } ?>
    
    <p>
        <?php $auth=Yii::$app->authManager;
              $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);
           ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'dataProvider1' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'vlid',
              
            'firstname',
            //'lastname',
            'email:email',
            'phone1',
            //'phone2',
            //'website',
                      [
                        // ... more columns configuration here
                        
                        'attribute' => 'phone2',
                        'value' => function($data){
                       
                        return $data->phone2 != '0' ? $data->phone2 : "-";
                        
                    },
                        
                        ],
                       [
                        // ... more columns configuration here
                        
                        'attribute' => 'franchisee',
                        'value' => 'franchisee.name',
                        'visible'=> array_keys($userRole)[0]=='Admin' ?true:false,
                        ],

                      [
                        'label'=>'Franchisee Executive',
                       'attribute'=>'Is_converted_by',
                       'format'=>'raw',
                        'visible'=> array_keys($userRole)[0]=='Franchisee Manager' ?true:false,
                        
                        'value'=>function($model){
                        $fnchnm=$model->getFranchexecutive(); 
                        return $fnchnm;
                        
                    },
                   ],
          
            // 'businessname',
            // 'vendor_type',
            // 'phone1',
            // 'phone2',
            // 'address1',
            // 'address2',
            // 'city',
            // 'state',
            // 'pin',
            // 'plan',
            // 'crtby',
            // 'updby',
            // 'conversion_date',

            ['class' => 'yii\grid\ActionColumn',
                   
                'template'=>'{convert}',                          
                            'buttons'=>[
                              //'convert' => function ($url, $model) {     
                                //return Html::a('<span class="glyphicon glyphicon-share"></span>', ['/vendor/create', 'id'=>$model->vlid,],['title'=>'Convert']);                                
                              
                                'convert' => function ($url, $data) { 
                                    $auth=Yii::$app->authManager;
                                    $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);
                                    //return array_keys($userRole)[0]!='Franchisee Manager' ? Html::a('<span class="glyphicon glyphicon-share"></span>', ['vendor/create','id'=>$data->vlid],['title'=>'Convert', 'id'=>'convertdoc_'.$data->vlid, 'class'=>'convertdoc']): '';                                                         
                                    //return (array_keys($userRole)[0]!='Franchisee Manager') ? '': Html::a('<span class="glyphicon glyphicon-share"></span>',['vendor/create','vlid'=>$data->vlid],['title'=>'Convert', 'id'=>'convertdoc_'.$data->vlid, 'class'=>'convertdoc']);                                                         
                     if(array_keys($userRole)[0]=='Franchisee Manager' || array_keys($userRole)[0]=='Franchisee Executive'){
                                      return Html::a('<span class="glyphicon glyphicon-share"></span>',['vendor/create','vlid'=>$data->vlid],['title'=>'Convert', 'id'=>'convertdoc_'.$data->vlid, 'class'=>'convertdoc']);
                                   }else{
                                       return '';
                                   }
                                },
                     
                           ]
                   
            ],
        ],
    ]); ?>

</div>

<script type="text/javascript">
$(document).ready(function() {
    <?php 
    if(isset($arraydata) && $arraydata != '' && sizeof($arraydata)>0){ ?>
        $('#importfl').css('display','block');
   <?php }
    ?>
});
</script>
