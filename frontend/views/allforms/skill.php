<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\jui\DatePicker;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <!-- Bootstrap Core CSS -->   
    <!--link href="css/bootstrap.min.css" rel="stylesheet"-->

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/sidecss/simple-sidebar.css" />
    <!--link href="css/simple-sidebar.css" rel="stylesheet"-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
    <!--link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css"/-->
    <!-- jQuery -->   
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->   
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/bootstrap.min.js"></script>
    
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/location.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/skillform.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/formsubmit.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <div class="container sectionWrap" style="min-height: 900px;">
    <div id="wrapper">

        <div class="row">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <!--li class="sidebar-brand">
                    <a href="#">
                        Sections
                    </a>
                </li-->
                <li>
                    <a href="#" id="link1">Personal</a>
                </li>
                <li>
                    <a href="#" id="link2">Professional</a>
                    <ul> <li><a href="#" id="pr1">Occupation</a></li>
                         <li><a href="#" id="pr2">Skills</a></li>
                         <li><a href="#" id="pr3">Consultant</a></li>
                         <li><a href="#" id="pr4">Testimonials</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="link3">Finance</a>
                    <ul> <li><a href="#" id="fi1">Investment</a></li>
                         <li><a href="#" id="fi2">Banking</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="link4">Education</a>
                </li>
                <li>
                    <a href="#" id="link5">Family</a>
                </li>
                <li>
                    <a href="#" id="link6">Medical</a>
                    <ul> <li><a href="#" id="md1">Health</a></li>
                         <li><a href="#" id="md2">Physician</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="link7">Vehicles</a>
                </li>
                <li>
                    <a href="#" id="link8">Government</a>
                    <ul> <li><a href="#" id="go1">Govern. Ids</a></li>
                         <li><a href="#" id="go2">Passport</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="link9">Intellectual</a>
                    <ul> <li><a href="#" id="in1">Hobbies</a></li>
                         <li><a href="#" id="in2">Plans</a></li>
                         <li><a href="#" id="in3">Creations</a></li>
                         <li><a href="#" id="in4">Achievements</a></li>
                         <li><a href="#" id="in5">Philosophy</a></li>
                         <li><a href="#" id="in6">Memories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="link10">Likings</a>
                </li>
                <li>
                    <a href="#" id="link11">Dislike</a>
                </li>
                <li>
                    <a href="#" id="link12">Belongings</a>
                </li>
                <li>
                    <a href="#" id="link13">Idols</a>
                </li>
                <li>
                    <a href="#" id="link14">Leasure</a>
                </li>
                <li>
                    <a href="#" id="link15">Social</a>
                </li>
                <li>
                    <a href="#" id="link16">Media</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        
        <div class="row">
                    <div class="col-lg-12">
                          <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
       </div>
   <!--************************************************************************************************************************************************-->
   <div class="default_form personal" style="margin-left: 250px;">
        <div class="skill-common-details-form">

    <?php $form = ActiveForm::begin(['id'=>'commondetailsform',
                                     'method' => 'post',
                                     'action' => ['allforms/savecommondetails']]); ?>
    <h1><?= Html::encode('Personal Info') ?></h1>
         
     <fieldset class="scheduler-border" style="width: 90%;">
            <legend class="scheduler-border" style="width: auto;">Personal Details</legend>
     <div class="row">
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'firstname')->textInput(['maxlength' => true]) ?>
        </div>
    
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'middlename')->textInput(['maxlength' => true]) ?>
        </div>
    
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($user, 'email')->textInput() ?>
        </div>
    
        <div class="col-xs-4">
            <?= $form->field($user, 'phone')->textInput() ?>
        </div>
        
         <div class="col-xs-4">
            <?= $form->field($commondetailmodel, 'landline')->textInput() ?>
         </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4">
            <!--?= $form->field($commondetailmodel, 'birthdate')->textInput() ?-->
            <?php 
               echo Html::label('Birth Date');
               echo DatePicker::widget([
                 'model' => $commondetailmodel,                 
                 'attribute' => 'birthdate',                       
                 'dateFormat' => 'yyyy-MM-dd',
                 'options' => ['class' => 'form-control']
              ]); 
               ?> 
        </div>
        
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'address1')->textInput(['maxlength' => true]) ?>
        </div>
    
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'address2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'state')->textInput(['maxlength' => true]) ?>
        </div>
    
        <div class="col-xs-4">
            <?= $form->field($userdetailmodel, 'country')->textInput(['maxlength' => true]) ?>
        </div>
    </div> 
    
   <?= Html::label('Birth Place');?> 
    <div class="row">
         <div class="col-xs-4">
            <?php $condata=array();
                  echo $form->field($country, 'id')->dropDownList($condata,['prompt'=>'Select', 'class'=>'form-control countries']); ?>
         </div>
    
         <div class="col-xs-4">
            <?php $statedata=array();
                  echo $form->field($state, 'id')->dropDownList($statedata,['prompt'=>'Select', 'class'=>'form-control states']); ?>
         </div>
   
         <div class="col-xs-4">
            <?php $citydata=array();
                  echo $form->field($city, 'id')->dropDownList($citydata,['prompt'=>'Select', 'class'=>'form-control cities']); ?>
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-4">
            <?= $form->field($commondetailmodel, 'sex')->textInput(['maxlength' => true]) ?>
         </div>
    
         <div class="col-xs-4">
            <?= $form->field($commondetailmodel, 'marrital_status')->textInput(['maxlength' => true]) ?>
         </div>
    
         <div class="col-xs-4">          
            <?= $form->field($commondetailmodel, 'blog')->textInput(['maxlength' => true]) ?>
         </div>
   </div>  
    
    <div class="row">
         <div class="col-xs-4">
            <?php $reg=  frontend\models\SkillsReligion::find()->all();
                  $religiondata=ArrayHelper::map($reg, 'regid', 'religion_name');
                 echo $form->field($commondetailmodel, 'religionid')->dropDownList($religiondata,['prompt'=>'Select']); ?>
         </div>
        
        <div class="col-xs-4">
             <?= $form->field($religionmodel, 'religion_name')->textInput(['maxlength' => true])->label('Other') ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-4">
            <?php $faith= \frontend\models\SkillsFaith::find()->all();
                  $faithdata= ArrayHelper::map($faith, 'faithid', 'faith');
                  echo $form->field($commondetailmodel, 'faithid')->dropDownList($faithdata,['prompt'=>'Select']); ?>
         </div>
        
        <div class="col-xs-4">
             <?= $form->field($faithmodel, 'faith')->textInput(['maxlength' => true])->label('Other') ?>
        </div>
    </div>
    
    <div class="row">
         <div class="col-xs-4">
            <?php $cast=  \frontend\models\SkillsCast::find()->all();
                  $castdata= ArrayHelper::map($cast, 'castid', 'cast');
                  echo $form->field($commondetailmodel, 'castid')->dropDownList($castdata,['prompt'=>'Select']); ?>
         </div>
        
        <div class="col-xs-4">
             <?= $form->field($castmodel, 'cast')->textInput(['maxlength' => true])->label('Other') ?>
        </div>
    </div>
    <span><b>Astrology Details</b></span>
    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($astrologymodel, 'image')->fileInput() ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($astrologymodel, 'text')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
     </fieldset>
             
    
    <div class="col-xs-3">
    <div class="form-group">
        <?= Html::submitButton($commondetailmodel->isNewRecord ? 'Add' : 'Save', ['class' => $commondetailmodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
  
    <?php ActiveForm::end(); ?>

    </div>                     
   </div>
        
  <!--************************************************************************************************************************************************-->
   <div class="family" style="display: none; margin-left: 250px;">
       <div class="skills-parents-form">
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(['id'=>'familyform',
                                    'method' => 'post',
                                    'action' => ['allforms/savefamily']]); ?>
    
   
     <h1><?= Html::encode('Family Info') ?></h1>
     
     <fieldset class="scheduler-border" >
        <legend class="scheduler-border" style="width: auto;">Parents Info</legend>
         
    <div class="row">
        <?= Html::label('Father');?>
         <div class="col-xs-4">
            <?= $form->field($parentsmodel, 'father_firstname')->textInput(['maxlength' => true]) ?>
        </div>
                    
         <div class="col-xs-4">
            <?= $form->field($parentsmodel, 'father_lastname')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-xs-4">
            <?= $form->field($parentsmodel, 'link1')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    
    <div class="row">
        <?= Html::label('Mother');?>
         <div class="col-xs-4">
            <?= $form->field($parentsmodel, 'mother_firstname')->textInput(['maxlength' => true]) ?>
          </div>
    
         <div class="col-xs-4">
            <?= $form->field($parentsmodel, 'mother_lastname')->textInput(['maxlength' => true]) ?>
         </div>
        
         <div class="col-xs-4">
            <?= $form->field($parentsmodel, 'link2')->textInput(['maxlength' => true]) ?>
         </div>
    </div>   
    </fieldset>
     
   <fieldset class="scheduler-border">
        <legend class="scheduler-border" style="width: auto;">Spouse Info</legend>
     <div class="row">
         <div class="col-xs-6">
            <?= $form->field($spousemodel, 'firstname')->textInput(['maxlength' => true]) ?>
         </div>
    
         <div class="col-xs-6">
            <?= $form->field($spousemodel, 'lastname')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
         
    <div class="row">         
        <div class="col-xs-6">
            <?= $form->field($spousemodel, 'relation')->textInput(['maxlength' => true]) ?>
         </div>
        <div class="col-xs-6">                   
            <?php 
               echo Html::label('Anniversary Date', ['class'=>'anivdt']);
               echo DatePicker::widget([
                 'model' => $spousemodel,                 
                 'attribute' => 'anniversary_date',                       
                 'dateFormat' => 'yyyy-MM-dd',
                 'options' => ['class' => 'form-control']
              ]); 
               ?>                            
         </div>
    </div>
    
    <div class="row">
         <div class="col-xs-12">
            <?= $form->field($spousemodel, 'link')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    </fieldset>
     
     <fieldset class="scheduler-border">
        <legend class="scheduler-border" style="width: auto;">Sibblings Info</legend>
    <div class="row">
         <div class="col-xs-6">
            <?= $form->field($sibblingmodel, 'firstname')->textInput(['maxlength' => true]) ?>
         </div>
    
         <div class="col-xs-6">
            <?= $form->field($sibblingmodel, 'lastname')->textInput(['maxlength' => true]) ?>
         </div>        
    </div>
    
    <div class="row">
         <div class="col-xs-8">
            <?= $form->field($sibblingmodel, 'link')->textInput(['maxlength' => true]) ?>
         </div>   
         <div class="col-xs-4">
            <?= $form->field($sibblingmodel, 'relation')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    </fieldset>
        <input type="hidden" id="updsib" name="updatesibbling" value="">
    <div class="row">  
    <div class="col-xs-3">
    <div class="form-group">
        <?= Html::submitButton($parentsmodel->isNewRecord ? 'Add' : 'Save', ['class' => $parentsmodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    </div>  
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
     
    <?php Pjax::begin(['id'=>'sibblinggrid']); ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider8,
            //'filterModel' => $searchsibblingModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'sibid',                
                'firstname',
                'lastname',
                'link:ntext',
                 'relation',                

                 ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatesibbling', 'id'=>$data->sibid],['title'=>'Update', 'id'=>'updsib_'.$data->sibid, 'class'=>'updsib']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletesibbling', 'id'=>$data->sibid],['title'=>'Delete', 'id'=>'delsib_'.$data->sibid, 'class'=>'delsib']);                                                         
                              }
                          ]
                 ],
            ],
        ]); ?>
     <?php Pjax::end(); ?>
    </div>
            </div>
    <!--***************************************************************************************************************************************************-->     
            
    <div class="professional" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Professional Info') ?></h1>                
            <div class="skills-occupation-form" style="display: none;">             
            <style type="text/css">
            td, th {  
              padding: 0.5rem;
              text-align: left;  
            }
            </style>
             <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'occupationform',
                                    'method' => 'post',
                                    'action' => ['allforms/saveoccupation']]); ?>

            <fieldset class="scheduler-border">
            <legend class="scheduler-border" style="width: auto;">Occupational Details</legend>
           <div class="row">
                 <div class="col-xs-5">
                    <?= $form->field($occupationmodel, 'occupationtype')->textInput(['maxlength' => true]) ?>
                 </div>
                 <div class="col-xs-5">
                    <?= $form->field($occupationmodel, 'designation')->textInput(['maxlength' => true]) ?>
                 </div>
           </div>

           <div class="row">
                 <div class="col-xs-5">
                    <?= $form->field($occupationmodel, 'company')->textInput(['maxlength' => true]) ?>
                </div>
          
                 <div class="col-xs-5">
                    <?= $form->field($occupationmodel, 'tenure')->textInput() ?>
                </div>
           </div>
            
            <div class="row">
                 <div class="col-xs-5">
                    <!--?= $form->field($occupationmodel, 'fromdate')->textInput() ?-->
                      <?php 
                        echo Html::label('From Date');
                        echo DatePicker::widget([
                          'model' => $occupationmodel,                 
                          'attribute' => 'fromdate',                       
                          'dateFormat' => 'yyyy-MM-dd',
                          'options' => ['class' => 'form-control']
                       ]); 
               ?>    
                </div>
            
                 <div class="col-xs-5">
                    <!--?= $form->field($occupationmodel, 'todate')->textInput() ?-->
                     <?php 
                        echo Html::label('To Date');
                        echo DatePicker::widget([
                          'model' => $occupationmodel,                 
                          'attribute' => 'todate',                       
                          'dateFormat' => 'yyyy-MM-dd',
                          'options' => ['class' => 'form-control']
                       ]); 
                    ?>    
                </div>
            </div>
            
            <div class="row">
                 <div class="col-xs-10">
                    <?= $form->field($occupationmodel, 'description')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            </fieldset>
            <input type="hidden" id="upd" name="update" value="">
            
            <div class="row">
            <div class="col-xs-3" style="margin-top: 20px;">
            <div class="form-group">
                <?= Html::submitButton($occupationmodel->isNewRecord ? 'Add' : 'Save', ['class' => $occupationmodel->isNewRecord ? 'btn btn-success occadd' : 'btn btn-primary occsave']) ?>
            </div>
            </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
          <?php Pjax::begin(['id'=>'occupationgrid']); ?>
              <?= GridView::widget([
                    'dataProvider' => $dataProvider1,
                    //'filterModel' => $searchoccupationModel,

                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],


                        [
                            'label'=>'Occupation Details',
                            'format' => 'raw',
                            'value'=>function ($data) {   
                                $date1 = date_create($data->fromdate);
                                $data->fromdate=date_format($date1, 'd-M-Y'); 
                                $date2 = date_create($data->todate);
                                $data->todate=date_format($date2, 'd-M-Y');                                 
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
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateoccupation', 'id'=>$data->ocid],['title'=>'Update', 'id'=>'updoc_'.$data->ocid, 'class'=>'updoc']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteoccupation', 'id'=>$data->ocid],['title'=>'Delete', 'id'=>'deloc_'.$data->ocid, 'class'=>'deloc']);                                                         
                              }
                          ]
                            ],
                                 
                    ],

                ]); ?>   
             <?php Pjax::end(); ?>                    
        </div>
        
       
        <div class="userskills-form" style="display: none;">             
             <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'userskillsform',
                                    'method' => 'post',
                                    'action' => ['allforms/saveuserskills']]); ?>
            
            <fieldset class="scheduler-border">
            <legend class="scheduler-border" style="width: auto;">Skills</legend>
            <?php $skills= frontend\models\Skills::find()->all();
              $skillsdata= \yii\helpers\ArrayHelper::map($skills, 'sid','skill')?>
            <div class="row">
            <div class="col-xs-6"> 
                <?= $form->field($userskillmodel, "skillid")->dropDownList($skillsdata,['prompt'=>'Select']) ?>
            </div>  
            
             <?php /*
                $skillid=array(); 
                if(isset($skilldata)&& $skilldata!=NULL)
                {
                  $skillid=array_keys($skilldata);  
                }  

                $skills= \frontend\models\Skills::find()->select('sid, skill')->where(['not in','sid',$skillid])->all();         

                $skillsData=ArrayHelper::map($skills,'sid','skill');  
             */   
                ?>
                <!--div class="row">
                    <div class="col-xs-3"> 
                    < ?php $skill=new \frontend\models\Skills();
                     echo Html::label('Skills');
                     echo  $form->field($skill, 'sid')-> listBox(
                            $skillsData,               
                            array('id'=>'list1','size'=>'4','multiple' => 'true')
                            )->label(false); 
                     ?>
                 
                < ?php echo Html::Button('>',['id'=>'btnAdd']); 
                      echo Html::Button('<',['id'=>'btnRemove']); ?>
               
                    < ?php         
                    if(!isset($skilldata))
                    {
                        $skilldata=array();
                    }
                    echo $form->field($userskillmodel, 'skillarray')-> listBox($skilldata,
                            array('id'=>'list2','size'=>4,'multiple' => 'true')
                            )->label(''); ?>
                    </div>
                </div-->
                             
                    <div class="col-xs-6">
                        <?php  echo Html::label('Other');
                              echo $form->field($skillmodel, 'skill')->textInput()->label(false); ?>
                    </div>
                </div>
              <!--input type="button" id="btnAdd" value=">" -->
                <div class="row">
                     <div class="col-xs-12">
                        <?= $form->field($userskillmodel, 'description')->textarea(['rows' => 4]) ?>
                    </div>
                </div>
            </fieldset>
             <input type="hidden" id="updsk" name="updateskill" value="">
            <div class="row">
               <div class="col-xs-3">
               <div class="form-group">
                    <?= Html::submitButton($userskillmodel->isNewRecord ? 'Add' : 'Save', ['class' => $userskillmodel->isNewRecord ? 'btn btn-success skilladd' : 'btn btn-primary skillsave']) ?>
                </div>
                </div>
             </div>
             <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'skillsgrid']); ?>
                    <?= GridView::widget([
                'dataProvider' => $dataProvider2,
                //'filterModel' => $searchskillsModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                                       
                    //'skillid',
                     [
                       'label' => 'Skill',
                       'attribute' => 'skillid',
                       'value' => function ($data) {                            
                             $skill=frontend\models\Skills::find('skill')->where(['sid'=>$data->skillid])->one();
                             return $skill['skill'];
                        },
                     ],
                    'description:ntext',                    
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateskill', 'id'=>$data->usid],['title'=>'Update', 'id'=>'updsk_'.$data->usid, 'class'=>'updsk']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteskill', 'id'=>$data->usid],['title'=>'Delete', 'id'=>'delsk_'.$data->usid, 'class'=>'delsk']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
        
         <div class="consultant-form" style="display: none;">             
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'consultantform',
                                    'method' => 'post',
                                    'action' => ['allforms/saveconsultant']]); ?>
             
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Consultant</legend>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($consultantmodel, 'consultant_type')->textInput(['maxlength' => true]) ?>
                    </div>
                
                     <div class="col-xs-6">
                        <?= $form->field($consultantmodel, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                     <div class="col-xs-6">
                        <?= $form->field($consultantmodel, 'phone')->textInput(['maxlength' => true]) ?>
                    </div>
                
                     <div class="col-xs-6">
                        <?= $form->field($consultantmodel, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
               </div>
             </fieldset>
               <input type="hidden" id="updcon" name="updateconsultant" value="">
             <div class="row">
               <div class="col-xs-3">
               <div class="form-group">
                    <?= Html::submitButton($consultantmodel->isNewRecord ? 'Add' : 'Save', ['class' => $consultantmodel->isNewRecord ? 'btn btn-success conadd' : 'btn btn-primary consave']) ?>
                </div>
                </div>
              </div>
            <?php ActiveForm::end(); ?>
             <?php Pjax::end(); ?>
             
             <?php Pjax::begin(['id'=>'consultantgrid']); ?>
             <?= GridView::widget([
                'dataProvider' => $dataProvider3,
                //'filterModel' => $searchconsultantModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'consultant_type',
                    'name',
                    'phone',
                     'email:email',            

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateconsultant', 'id'=>$data->cid],['title'=>'Update', 'id'=>'updcon_'.$data->cid, 'class'=>'updcon']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteconsultant', 'id'=>$data->cid],['title'=>'Delete', 'id'=>'delcon_'.$data->cid, 'class'=>'delcon']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
        
        <div class="testimonial-form" style="display: none;">             

            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                                           'action' => ['allforms/savetestimonial'],                                                           
                                                           'id'=>'testimonialform',
                                            ]);  ?>
            
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Testimonial</legend>
              <div class="row">
                    <div class="col-xs-10">
                       <?= $form->field($testmodel, 'quotes')->textarea(['rows' => 6]) ?>
                   </div>
              </div>

              <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($testmodel, 'name')->textInput(['maxlength' => true]) ?>
                  </div>
              </div>

               <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($testmodel, 'image')->fileInput() ?>
                        <!--?php  echo $form->field($testmodel, 'image')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*']                      
                            ]);    ?-->
                   </div>
              </div>
            </fieldset>
            <input type="hidden" id="updtest" name="updatetest" value="">
            <div class="row">
               <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($testmodel->isNewRecord ? 'Add' : 'Save', ['class' => $testmodel->isNewRecord ? 'btn btn-success testadd' : 'btn btn-primary testsave']) ?>
               </div>
               </div>
              </div>
             <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'testgrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider4,
                //'filterModel' => $searchtestModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'testid',                    
                    //'quotes:ntext',
                    //'name', 
                    [
                            'label'=>'Testimonials',
                            'format' => 'raw',
                            'value'=>function ($data) {                                   
                               $htmlvalue="<table>                            
                            <tbody>
                              <tr>                                
                                <td>".$data->quotes."</td>
                              </tr>    
                              <tr> 
                                <th>By: ".$data->name."</th>                                                                
                              </tr>                              
                            </tbody>
                          </table>";                           
                                return $htmlvalue;
                             },
                        ],
                        [
                            'label'=>'Image',
                            'format'=>'raw',
                            'value' => function($data){
                                $url = \Yii::$app->request->baseUrl. '/../../subscriberimg/testimonialimg/'. $data->testid.'/'. $data->image;
                                return Html::img($url,['width'=>60, 'height'=>60, 'alt'=>'Blank']);  //'class' => 'pull-left img-responsive'
                            }
                        ],
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatetest', 'id'=>$data->testid],['title'=>'Update', 'id'=>'updtest_'.$data->testid, 'class'=>'updtest']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletetest', 'id'=>$data->testid],['title'=>'Delete', 'id'=>'deltest_'.$data->testid, 'class'=>'deltest']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
      
  <!--***************************************************************************************************************************************************-->     
            
    <div class="finance" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Financial Info') ?></h1>   
          <div class="skills-investment-form" style="display: none;">             

            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'investmentform',
                                             'method' => 'post',
                                             'action' => ['allforms/saveinvestment']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Investment Details</legend>
              <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($investmodel, 'investment_type')->textInput(['maxlength' => true]) ?>
                   </div>
              
                    <div class="col-xs-6">
                       <?= $form->field($investmodel, 'valuation')->textInput() ?>
                  </div>
              </div>

               <div class="row">
                    <div class="col-xs-12">
                       <?= $form->field($investmodel, 'description')->textarea(['rows' => 6]) ?>
                   </div>
              </div>

              <div class="row">    
                <div class="col-xs-6">
                   <?= $form->field($commondetailmodel, 'annual_income')->textInput() ?>
                </div>
              </div>
            </fieldset>
               <input type="hidden" id="updinv" name="updateinvest" value="">
               <div class="row">   
               <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($investmodel->isNewRecord ? 'Add' : 'Save', ['class' => $investmodel->isNewRecord ? 'btn btn-success invadd' : 'btn btn-primary invsave']) ?>
               </div>
               </div>
               </div>
             <?php ActiveForm::end(); ?>
              <?php Pjax::end(); ?>
              
              <?php Pjax::begin(['id'=>'investgrid']); ?>
              <?= GridView::widget([
                'dataProvider' => $dataProvider5,
                //'filterModel' => $searchinvestModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'invid',                    
                    'investment_type',
                    'valuation',
                    'description:ntext',                    
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateinvest', 'id'=>$data->invid],['title'=>'Update', 'id'=>'updinv_'.$data->invid, 'class'=>'updinv']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteinvest', 'id'=>$data->invid],['title'=>'Delete', 'id'=>'delinv_'.$data->invid, 'class'=>'delinv']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        
        <div class="skills-banks-form" style="display: none;">             
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'bankform',
                                             'method' => 'post',
                                             'action' => ['allforms/savebank']]); ?>
            
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Bank Details</legend>
              <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($bankmodel, 'bankname')->textInput(['maxlength' => true]) ?>
                   </div>
              
                    <div class="col-xs-6">
                       <?= $form->field($bankmodel, 'branchname')->textInput(['maxlength' => true]) ?>
                  </div>
              </div>

               <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($bankmodel, 'account_no')->textInput() ?>
                   </div>
              
                   <div class="col-xs-6">
                       <?= $form->field($bankmodel, 'IFSC_no')->textInput(['maxlength' => true]) ?>
                  </div>
               </div>
             </fieldset>
                <input type="hidden" id="updbank" name="updatebank" value="">
            <div class="row">
               <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($bankmodel->isNewRecord ? 'Add' : 'Save', ['class' => $bankmodel->isNewRecord ? 'btn btn-success bankadd' : 'btn btn-primary banksave']) ?>
               </div>
               </div>
             </div>
             <?php ActiveForm::end(); ?>
             <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'bankgrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider6,
                //'filterModel' => $searchbankModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'bid',                    
                    'bankname',
                    'branchname',
                    'account_no',
                     'IFSC_no',                   

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatebank', 'id'=>$data->bid],['title'=>'Update', 'id'=>'updbank_'.$data->bid, 'class'=>'updbank']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletebank', 'id'=>$data->bid],['title'=>'Delete', 'id'=>'delbank_'.$data->bid, 'class'=>'delbank']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
  
   <!--***************************************************************************************************************************************************-->     
           
    <div class="education" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Educational Info') ?></h1> 
        <div class="skills-education-form">
        <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin(['id'=>'educationform',
                                             'method' => 'post',
                                             'action' => ['allforms/saveeducation']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Educational Details</legend>
            <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($educationmodel, 'qualification')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-xs-6">
                       <?= $form->field($educationmodel, 'year')->textInput(['maxlength' => true]) ?>
                   </div>
              </div>
            
            <div class="row">
                    <div class="col-xs-12">
                       <?= $form->field($educationmodel, 'institute')->textarea(['rows' => 3]) ?>
                   </div>
            </div>            
            </fieldset>
                 <input type="hidden" id="updedu" name="updateeducation" value="">
            <div class="row">
            <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($educationmodel->isNewRecord ? 'Add' : 'Save', ['class' => $educationmodel->isNewRecord ? 'btn btn-success eduadd' : 'btn btn-primary edusave']) ?>
               </div>
            </div>
            </div>
        <?php ActiveForm::end(); ?>
         <?php Pjax::end(); ?>
            
         <?php Pjax::begin(['id'=>'educationgrid']); ?>
         <?= GridView::widget([
                'dataProvider' => $dataProvider7,
                //'filterModel' => $searcheducationModel,                
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'eid',                   
                    /*'qualification',
                    'institute:ntext',
                    'year',*/
                    
                    [
                            'label'=>'Education Details',
                            'format' => 'raw',
                            'value'=>function ($data) {                                   
                               $htmlvalue="<table>                            
                            <tbody>
                              <tr>     
                                <th>Institute: </th>
                                <td>".$data->institute."</td>
                              </tr>    
                              <tr>
                                <th>Qualification: </th>
                                <td style='width:400px;'>".$data->qualification."</td>
                                <th>Year:</th>
                                <td>".$data->year."</td>
                              </tr>                               
                            </tbody>
                          </table>";                           
                                return $htmlvalue;
                             },
                        ],
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateeducation', 'id'=>$data->eid],['title'=>'Update', 'id'=>'updedu_'.$data->eid, 'class'=>'updedu']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteeducation', 'id'=>$data->eid],['title'=>'Delete', 'id'=>'deledu_'.$data->eid, 'class'=>'deledu']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
   
   <!--***************************************************************************************************************************************************-->     
            
    <div class="medical" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Medical Info') ?></h1>   
        <div class="skills-healthdetails-form" style="display: none;">             
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'healthdetailsform',
                                             'method' => 'post',
                                             'action' => ['allforms/savehealthdetails']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Health Details</legend>
              <div class="row">
                    <div class="col-xs-4">
                       <?= $form->field($healthmodel, 'bloodgroup')->textInput(['maxlength' => true]) ?>
                   </div>
              
                   <div class="col-xs-4">
                       <?= $form->field($healthmodel, 'height')->textInput() ?>
                  </div>
              
                   <div class="col-xs-4">
                       <?= $form->field($healthmodel, 'weight')->textInput() ?>
                  </div>
               </div>
            
               <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($healthmodel, 'medication')->textInput(['maxlength' => true]) ?>
                   </div>
              </div>

              <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($diseasemodel, 'disease')->textInput(['maxlength' => true]) ?>
                   </div>
              </div>
            </fieldset>
                <input type="hidden" id="upddis" name="updatehealth" value="">
            <div class="row">
               <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($healthmodel->isNewRecord ? 'Add' : 'Save', ['class' => $healthmodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
               </div>
               </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'diseasegrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider9,
                //'filterModel' => $searchdiseaseModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'disid',                    
                    'disease',                    

                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatedisease', 'id'=>$data->disid],['title'=>'Update', 'id'=>'upddis_'.$data->disid, 'class'=>'upddis']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletedisease', 'id'=>$data->disid],['title'=>'Delete', 'id'=>'deldis_'.$data->disid, 'class'=>'deldis']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        
        <div class="skills-physicians-form" style="display: none;">             
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'physicianform',
                                             'method' => 'post',
                                             'action' => ['allforms/savephysician']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Physician</legend>                                
              <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($physicianmodel, 'physician_name')->textInput(['maxlength' => true]) ?>
                   </div>
              
                    <div class="col-xs-6">
                       <?= $form->field($physicianmodel, 'speciality')->textInput(['maxlength' => true]) ?>
                  </div>
              </div>

              <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($physicianmodel, 'phone')->textInput(['maxlength' => true]) ?>
                  </div>
               
                  <div class="col-xs-6">
                       <?= $form->field($physicianmodel, 'email')->textInput(['maxlength' => true]) ?>
                   </div>
              </div>
            </fieldset> 
                          <input type="hidden" id="updphy" name="updatephysician" value="">                    
              <div class="row">
               <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($physicianmodel->isNewRecord ? 'Add' : 'Save', ['class' => $physicianmodel->isNewRecord ? 'btn btn-success phyadd' : 'btn btn-primary physave']) ?>
               </div>
               </div>
               </div>
             <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'physiciangrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider10,
                //'filterModel' => $searchphysicianModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',                   
                    'physician_name',
                    'speciality',
                    'phone',
                    'email:email',                    

                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatephysician', 'id'=>$data->id],['title'=>'Update', 'id'=>'updphy_'.$data->id, 'class'=>'updphy']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletephysician', 'id'=>$data->id],['title'=>'Delete', 'id'=>'delphy_'.$data->id, 'class'=>'delphy']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
   
    <!--***************************************************************************************************************************************************-->     
     
       
    <div class="vehicle" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Vehicle Info') ?></h1> 
        <div class="skills-vehicles-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'vehiclesform',
                                             'method' => 'post',
                                             'action' => ['allforms/savevehicles']]); ?>
           <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Vehicles</legend>                                
                <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($vehiclemodel, 'vehicle_type')->textInput(['maxlength' => true]) ?>
                   </div>
                
                    <div class="col-xs-6">
                       <?= $form->field($vehiclemodel, 'make')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($vehiclemodel, 'year')->textInput(['maxlength' => true]) ?>
                   </div>
                
                   <div class="col-xs-6">
                       <?= $form->field($vehiclemodel, 'registration_no')->textInput() ?>
                   </div>
                </div>
           </fieldset>
                 <input type="hidden" id="updvehcl" name="updatevehicle" value="">          
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($vehiclemodel->isNewRecord ? 'Add' : 'Save', ['class' => $vehiclemodel->isNewRecord ? 'btn btn-success vecadd' : 'btn btn-primary vecsave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'vehiclegrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider11,
                //'filterModel' => $searchvehicleModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'vcid',                   
                    'vehicle_type',
                    'make',
                    'year',
                    'registration_no',
                   
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatevehicle', 'id'=>$data->vcid],['title'=>'Update', 'id'=>'updvehcl_'.$data->vcid, 'class'=>'updvehcl']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletevehicle', 'id'=>$data->vcid],['title'=>'Delete', 'id'=>'delvehcl_'.$data->vcid, 'class'=>'delvehcl']);                                                         
                              }
                          ]
                     ],                    
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
   <!--***************************************************************************************************************************************************-->     
            
    <div class="government" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Government Info') ?></h1> 
        <div class="skills-government-ids-form" style="display: none;">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'governmentidsform',
                                             'method' => 'post',
                                             'action' => ['allforms/savegovernmentids']]); ?>  
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Government Identity</legend>                 
                <div class="row">
                    <div class="col-xs-6">
                       <?php $doctype= \frontend\models\GovernDocumentType::find()->all();
                             $doctypedata=  \yii\helpers\ArrayHelper::map($doctype, 'id', 'doc_name');
                             echo $form->field($govidmodel, 'governdoc_type')->dropDownList($doctypedata,['prompt'=>'Select']); ?>
                   </div>
               
                   <div class="col-xs-6">
                       <?php echo Html::label('Other');
                       echo $form->field($govdocmodel, 'doc_name')->textInput()->label(false) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($govidmodel, 'govern_no')->textInput() ?>
                   </div>
                </div>
            </fieldset>
                     <input type="hidden" id="updgov" name="updategov" value="">          
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($govidmodel->isNewRecord ? 'Add' : 'Save', ['class' => $govidmodel->isNewRecord ? 'btn btn-success govadd' : 'btn btn-primary govsave']) ?>
                    </div>
                </div>
              </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'govgrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider12,
                //'filterModel' => $searchgovModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'gid',                   
                    //'governdoc_type',
                    [                      
                       'attribute' => 'governdoc_type',
                       'value' => function ($data) {                            
                             $doctyp=  frontend\models\GovernDocumentType::find('doc_name')->where(['id'=>$data->governdoc_type])->one();
                             return $doctyp['doc_name'];
                        },
                     ],
                    'govern_no',                                       
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updategovid', 'id'=>$data->gid],['title'=>'Update', 'id'=>'updgov_'.$data->gid, 'class'=>'updgov']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletegovid', 'id'=>$data->gid],['title'=>'Delete', 'id'=>'delgov_'.$data->gid, 'class'=>'delgov']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        
        <div class="skills-passport-form" style="display: none;">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                                           'action' => ['allforms/savepassport'],                                                           
                                                           'id'=>'passportform',
                                            ]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Passport Details</legend>                 
                <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($passportmodel, 'nationality')->textInput(['maxlength' => true]) ?>
                   </div>
                
                   <div class="col-xs-6">
                       <?= $form->field($passportmodel, 'passport_no')->textInput() ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-6">
                       <!--?= $form->field($passportmodel, 'issuedate')->textInput() ?-->
                        <?php 
                        echo Html::label('Issue Date');
                        echo DatePicker::widget([
                          'model' => $passportmodel,                 
                          'attribute' => 'issuedate',                       
                          'dateFormat' => 'yyyy-MM-dd',
                          'options' => ['class' => 'form-control']
                       ]); 
                    ?>  
                   </div>
                
                    <div class="col-xs-6">
                       <!--?= $form->field($passportmodel, 'expirydate')->textInput() ?-->
                        <?php 
                        echo Html::label('Expiry Date');
                        echo DatePicker::widget([
                          'model' => $passportmodel,                 
                          'attribute' => 'expirydate',                       
                          'dateFormat' => 'yyyy-MM-dd',
                          'options' => ['class' => 'form-control']
                       ]); 
                    ?>  
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-4">
                       <?= $form->field($passportmodel, 'scancopy')->fileInput() ?>
                   </div>
                </div>
            </fieldset>
                     <input type="hidden" id="updpass" name="updatepass" value="">         
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($passportmodel->isNewRecord ? 'Add' : 'Save', ['class' => $passportmodel->isNewRecord ? 'btn btn-success passadd' : 'btn btn-primary passsave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'passgrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider13,
                //'filterModel' => $searchpassModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'pid',                    
                    'nationality',
                    'passport_no',
                    //'issuedate',
                    //'expirydate',  
                    [
                        'label'=>'Issue Date', 
                        'attribute'=>'issuedate',
                        'value' => function($data){
                                $date = date_create($data->issuedate);
                                return date_format($date, 'd-M-Y'); 
                        }
                    ],
                    [
                        'label'=>'Expiry Date', 
                        'attribute'=>'expirydate',
                        'value' => function($data){
                                $date = date_create($data->expirydate);
                                return date_format($date, 'd-M-Y'); 
                        }
                    ],  
                    [
                            'label'=>'Scan Copy',
                            'format'=>'raw',
                            'value' => function($data){
                                $url = \Yii::$app->request->baseUrl. '/../../subscriberimg/passportimg/'. $data->pid.'/'. $data->scancopy;
                                return Html::img($url,['width'=>60, 'height'=>60, 'alt'=>'Blank']);  //'class' => 'pull-left img-responsive'
                            }
                    ],

                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatepassport', 'id'=>$data->pid],['title'=>'Update', 'id'=>'updpass_'.$data->pid, 'class'=>'updpass']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletepassport', 'id'=>$data->pid],['title'=>'Delete', 'id'=>'delpass_'.$data->pid, 'class'=>'delpass']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
   <!--***************************************************************************************************************************************************-->     
            
    <div class="intellectual" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Intellectual') ?></h1> 
        <div class="user-hobbies-form" style="display: none;">   
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'userhobbiesform',
                                             'method' => 'post',
                                             'action' => ['allforms/saveuserhobbies']]); ?>               
              <?php 
                /*$hobbyid=array(); 
                if(isset($hobbydata)&& $hobbydata!=NULL)
                {
                  $hobbyid=array_keys($hobbydata);  
                }
                 * ->where(['not in','hbid',$hobbyid]) */  

                $hobbies= \frontend\models\SkillsHobbies::find()->select('hbid, hobby')->all();         

                $hobbyData=ArrayHelper::map($hobbies,'hbid','hobby');  

                ?>
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Hobby</legend>                 
                <div class="row">
                    <div class="col-xs-5"> 
                    <?php $hobby=new \frontend\models\SkillsHobbies();
                     echo Html::label('Hobbies');
                     echo  $form->field($hobby, 'hbid')-> listBox(
                            $hobbyData,               
                            array('id'=>'listA','size'=>4,'multiple' => 'true')
                            )->label(false); ?>
                                      
                    <?php echo Html::Button('>',['id'=>'btnadd1']); ?>
                    <?php echo Html::Button('<',['id'=>'btnremove1']); ?>
                               
                    <?php         
                    if(!isset($hobbydata))
                    {
                        $hobbydata=array();
                    }
                    echo $form->field($userhobbymodel, 'hobbyarray')-> listBox($hobbydata,
                            array('id'=>'listB','size'=>4,'multiple' => 'true')
                            )->label(''); ?>
                    </div>
                </div>
               
                <div class="row">
                     <div class="col-xs-5">
                        <?php  echo Html::label('Other');
                              echo $form->field($hobbymodel, 'hobby')->textInput()->label(false); ?>
                    </div>
                </div>
             </fieldset>
                    <input type="hidden" id="updhby" name="updatehobby" value="">  
            <div class="row">               
               <div class="col-xs-3">
               <div class="form-group">
                    <?= Html::submitButton($userhobbymodel->isNewRecord ? 'Add' : 'Save', ['class' => $userhobbymodel->isNewRecord ? 'btn btn-success hobyadd' : 'btn btn-primary hobysave']) ?>
                </div>
                </div>
                </div>
             <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'hobbygrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider14,
                //'filterModel' => $searchhobyModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'uhbid',                    
                    //'hobbyid',                    
                    [    
                       'label' => 'Hobby',
                       'attribute' => 'hobbyid',
                       'value' => function ($data) {                            
                             $hobby= frontend\models\SkillsHobbies::find('hobby')->where(['hbid'=>$data->hobbyid])->one();
                             return $hobby['hobby'];
                        },
                     ],
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatehobby', 'id'=>$data->uhbid],['title'=>'Update', 'id'=>'updhby_'.$data->uhbid, 'class'=>'updhby']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletehobby', 'id'=>$data->uhbid],['title'=>'Delete', 'id'=>'delhby_'.$data->uhbid, 'class'=>'delhby']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        
        <div class="skills-plans-form" style="display: none;">   
             <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'planform',
                                    'method' => 'post',
                                    'action' => ['allforms/saveplan']]); ?>
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Plans</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($planmodel, 'plantype')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($planmodel, 'description')->textarea(['rows' => 4]) ?>
                   </div>
                </div>
             </fieldset>
                     <input type="hidden" id="updplan" name="updateplan" value="">  
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($planmodel->isNewRecord ? 'Add' : 'Save', ['class' => $planmodel->isNewRecord ? 'btn btn-success planadd' : 'btn btn-primary plansave']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'plangrid']); ?>
             <?= GridView::widget([
                'dataProvider' => $dataProvider15,
                //'filterModel' => $searchplanModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'planid',                    
                    'plantype',
                    'description:ntext',
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateplan', 'id'=>$data->planid],['title'=>'Update', 'id'=>'updplan_'.$data->planid, 'class'=>'updplan']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteplan', 'id'=>$data->planid],['title'=>'Delete', 'id'=>'delplan_'.$data->planid, 'class'=>'delplan']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>   
        
        <div class="skills-creations-form" style="display: none;">   
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                                           'action' => ['allforms/savecreations'],                                                           
                                                           'id'=>'creationsform',
                                            ]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Creations</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($creationmodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($creationmodel, 'note')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($creationmodel, 'youtoube_link')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($creationmodel, 'image')->fileInput() ?>
                   </div>
                </div>                           
            </fieldset>
                 <input type="hidden" id="updcrt" name="updatecrt" value="">  
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($creationmodel->isNewRecord ? 'Add' : 'Save', ['class' => $creationmodel->isNewRecord ? 'btn btn-success crtadd' : 'btn btn-primary crtsave']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'creategrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider16,
                //'filterModel' => $searchcrtModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'crid',                    
                    'title:ntext',
                    'note:ntext',
                    //'image',
                     'youtoube_link:ntext',
                    [
                            'label'=>'Image',
                            'format'=>'raw',
                            'value' => function($data){
                                $url = \Yii::$app->request->baseUrl. '/../../subscriberimg/creationimg/'. $data->crid.'/'. $data->image;
                                return Html::img($url,['width'=>60, 'height'=>60, 'alt'=>'Blank']);  //'class' => 'pull-left img-responsive'
                            }
                    ],
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatecreation', 'id'=>$data->crid],['title'=>'Update', 'id'=>'updcrt_'.$data->crid, 'class'=>'updcrt']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletecreation', 'id'=>$data->crid],['title'=>'Delete', 'id'=>'delcrt_'.$data->crid, 'class'=>'delcrt']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>  
        
        <div class="skills-achievements-form" style="display: none;"> 
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'achievementsform',
                                             'method' => 'post',
                                             'action' => ['allforms/saveachievements']]); ?>
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Achievements</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($achievementmodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($achievementmodel, 'note')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($achievementmodel, 'professional_plan')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
             </fieldset>
                     <input type="hidden" id="updach" name="updateachieve" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($achievementmodel->isNewRecord ? 'Add' : 'Save', ['class' => $achievementmodel->isNewRecord ? 'btn btn-success achadd' : 'btn btn-primary achsave']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'achievegrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider17,
                //'filterModel' => $searchachieveModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',                    
                    'title:ntext',
                    'note:ntext',
                    'professional_plan:ntext',
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateachievement', 'id'=>$data->id],['title'=>'Update', 'id'=>'updach_'.$data->id, 'class'=>'updach']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteachievement', 'id'=>$data->id],['title'=>'Delete', 'id'=>'delach_'.$data->id, 'class'=>'delach']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>  
        
        <div class="skills-philosophy-form" style="display: none;"> 
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'philosophyform',
                                             'method' => 'post',
                                             'action' => ['allforms/savephilosophy']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Philosophy</legend> 
                <div class="row">
                    <div class="col-xs-12">
                       <?= $form->field($philosophymodel, 'philosophytext')->textarea(['rows' => 6]) ?>
                   </div>
                </div>            
            </fieldset>
                    <input type="hidden" id="updphilo" name="updatephilospy" value="">  
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($philosophymodel->isNewRecord ? 'Add' : 'Save', ['class' => $philosophymodel->isNewRecord ? 'btn btn-success phiadd' : 'btn btn-primary phisave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'philospygrid']); ?>
             <?= GridView::widget([
                'dataProvider' => $dataProvider18,
                //'filterModel' => $searchphilospyModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'phid',                    
                    'philosophytext:ntext',
                    
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatephilosophy', 'id'=>$data->phid],['title'=>'Update', 'id'=>'updphilo_'.$data->phid, 'class'=>'updphilo']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletephilosophy', 'id'=>$data->phid],['title'=>'Delete', 'id'=>'delphilo_'.$data->phid, 'class'=>'delphilo']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div> 
        
        <div class="skills-memories-form" style="display: none;">    
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'memoryform',
                                    'method' => 'post',
                                    'action' => ['allforms/savememory']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Memories</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($memorymodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div> 
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($memorymodel, 'note')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
            </fieldset>
                    <input type="hidden" id="updmem" name="updatemem" value="">  
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($memorymodel->isNewRecord ? 'Add' : 'Save', ['class' => $memorymodel->isNewRecord ? 'btn btn-success memadd' : 'btn btn-primary memsave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'memorygrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider19,
                //'filterModel' => $searchmemoryModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'memoid',                    
                    'title:ntext',
                    'note:ntext',                    

                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatememory', 'id'=>$data->memoid],['title'=>'Update', 'id'=>'updmem_'.$data->memoid, 'class'=>'updmem']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletememory', 'id'=>$data->memoid],['title'=>'Delete', 'id'=>'delmem_'.$data->memoid, 'class'=>'delmem']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div> 
    </div>
   
    <!--***************************************************************************************************************************************************-->     
     
       
    <div class="liking" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Likings') ?></h1> 
        <div class="skills-likings-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'likingsform',
                                             'method' => 'post',
                                             'action' => ['allforms/savelikings']]); ?>
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Likings</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($likingmodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($likingmodel, 'note')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
             </fieldset>
                        <input type="hidden" id="updlyk" name="updatelike" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($likingmodel->isNewRecord ? 'Add' : 'Save', ['class' => $likingmodel->isNewRecord ? 'btn btn-success lykadd' : 'btn btn-primary lyksave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'likegrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider20,
                //'filterModel' => $searchlikeModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'likeid',                    
                    'title:ntext',
                    'note:ntext',
                    
                     ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateliking', 'id'=>$data->likeid],['title'=>'Update', 'id'=>'updlyk_'.$data->likeid, 'class'=>'updlyk']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteliking', 'id'=>$data->likeid],['title'=>'Delete', 'id'=>'dellyk_'.$data->likeid, 'class'=>'dellyk']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
    <!--***************************************************************************************************************************************************-->     
            
    <div class="dislike" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Dislikes') ?></h1> 
        <div class="skills-dislike-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'dislikeform',
                                             'method' => 'post',
                                             'action' => ['allforms/savedislike']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Dislike</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($dislikemodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($dislikemodel, 'note')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
            </fieldset>
                    <input type="hidden" id="upddislyk" name="updatedislike" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($dislikemodel->isNewRecord ? 'Add' : 'Save', ['class' => $dislikemodel->isNewRecord ? 'btn btn-success dlykadd' : 'btn btn-primary dlyksave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'dislikegrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider21,
                //'filterModel' => $searchdislikeModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',                   
                    'title:ntext',
                    'note:ntext',                   
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatedislike', 'id'=>$data->id],['title'=>'Update', 'id'=>'upddislyk_'.$data->id, 'class'=>'upddislyk']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletedislike', 'id'=>$data->id],['title'=>'Delete', 'id'=>'deldislyk_'.$data->id, 'class'=>'deldislyk']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
    <!--***************************************************************************************************************************************************-->     
            
    <div class="belonging" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Belongings') ?></h1> 
        <div class="skills-belongings-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                                           'action' => ['allforms/savebelongings'],                                                           
                                                           'id'=>'belongingsform',
                                            ]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Belongings</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($belongingmodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($belongingmodel, 'note')->textarea(['rows' => 6]) ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($belongingmodel, 'image')->fileInput() ?>
                   </div>
                </div>
            </fieldset>
                    <input type="hidden" id="updbel" name="updatebelong" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($belongingmodel->isNewRecord ? 'Add' : 'Save', ['class' => $belongingmodel->isNewRecord ? 'btn btn-success beladd' : 'btn btn-primary belsave']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'belonggrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider22,
                //'filterModel' => $searchbelongModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',                   
                    'title:ntext',
                    'note:ntext',
                    //'image', 
                    [
                            'label'=>'Image',
                            'format'=>'raw',
                            'value' => function($data){
                                $url = \Yii::$app->request->baseUrl. '/../../subscriberimg/belongingimg/'. $data->id.'/'. $data->image;
                                return Html::img($url,['width'=>60, 'height'=>60, 'alt'=>'Blank']);  //'class' => 'pull-left img-responsive'
                            }
                    ],

                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatebelonging', 'id'=>$data->id],['title'=>'Update', 'id'=>'updbel_'.$data->id, 'class'=>'updbel']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletebelonging', 'id'=>$data->id],['title'=>'Delete', 'id'=>'delbel_'.$data->id, 'class'=>'delbel']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
    <!--***************************************************************************************************************************************************-->     
            
    <div class="idols" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Idols') ?></h1> 
        <div class="skills-idols-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'idolsform',
                                             'method' => 'post',
                                             'action' => ['allforms/saveidols']]); ?>
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Idols</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($idolmodel, 'name')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>                          
             </fieldset>
                     <input type="hidden" id="updid" name="updateidol" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($idolmodel->isNewRecord ? 'Add' : 'Save', ['class' => $idolmodel->isNewRecord ? 'btn btn-success idoladd' : 'btn btn-primary idolsave']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'idolgrid']); ?>
             <?= GridView::widget([
                'dataProvider' => $dataProvider23,
                //'filterModel' => $searchidolModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',                    
                    'name',
                    
                   ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updateidol', 'id'=>$data->id],['title'=>'Update', 'id'=>'updid_'.$data->id, 'class'=>'updid']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deleteidol', 'id'=>$data->id],['title'=>'Delete', 'id'=>'delid_'.$data->id, 'class'=>'delid']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
    </div>
    
    <!--***************************************************************************************************************************************************-->     
            
    <div class="leasure" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Travel Details') ?></h1> 
        <div class="skills-travel-details-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id'=>'traveldetailsform',
                                             'method' => 'post',
                                             'action' => ['allforms/savetraveldetails']]); ?>
             <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Travel Details</legend> 
                <div class="row">
                    <div class="col-xs-6">
                       <?= $form->field($travelmodel, 'place')->textInput(['maxlength' => true]) ?>
                   </div>
               
                   <div class="col-xs-6">
                       <?= $form->field($travelmodel, 'year')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>  
            
                <div class="row">
                    <div class="col-xs-12">
                       <?= $form->field($travelmodel, 'description')->textarea(['rows' => 6]) ?>
                   </div>
                </div>  
             </fieldset>
                        <input type="hidden" id="updtrv" name="updatetravel" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($travelmodel->isNewRecord ? 'Add' : 'Save', ['class' => $travelmodel->isNewRecord ? 'btn btn-success trvadd' : 'btn btn-primary trvsave']) ?>
                    </div>
                </div>
             </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'travelgrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider24,
                //'filterModel' => $searchtravelModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'trid',            
                    'place',
                    'year',
                    'description:ntext',

                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatetravel', 'id'=>$data->trid],['title'=>'Update', 'id'=>'updtrv_'.$data->trid, 'class'=>'updtrv']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletetravel', 'id'=>$data->trid],['title'=>'Delete', 'id'=>'deltrv_'.$data->trid, 'class'=>'deltrv']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
     <!--***************************************************************************************************************************************************-->     
            
    <div class="socialmedia" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Social Media Info') ?></h1> 
        <div class="skills-socialmedia-form">
            <?php $form = ActiveForm::begin(['id'=>'socialmediaform',
                                             'method' => 'post',
                                             'action' => ['allforms/savesocialmedia']]); ?>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Socialmedia</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($socialmediamodel, 'socialmedia_site')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>                          
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($socialmediamodel, 'link')->textarea(['rows' => 6]) ?>
                   </div>
                </div>                               
            </fieldset>
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($socialmediamodel->isNewRecord ? 'Add' : 'Save', ['class' => $socialmediamodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
     
     <!--***************************************************************************************************************************************************-->     
            
    <div class="media" style="display: none; margin-left: 250px;">
        <h1><?= Html::encode('Media Info') ?></h1> 
        <div class="skills-media-form">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                                           'action' => ['allforms/savemedia'],                                                           
                                                           'id'=>'mediaform',
                                            ]); ?>
              <fieldset class="scheduler-border">
                <legend class="scheduler-border" style="width: auto;">Media</legend> 
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($mediamodel, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                </div>                          
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($mediamodel, 'note')->textarea(['rows' => 6])  ?>
                   </div>
                </div> 
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($mediamodel, 'link')->textarea(['rows' => 6])  ?>
                   </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                       <?= $form->field($mediamodel, 'image')->fileInput()  ?>
                   </div>
                </div>
              </fieldset>
                         <input type="hidden" id="updmed" name="updatemedia" value=""> 
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <?= Html::submitButton($mediamodel->isNewRecord ? 'Add' : 'Save', ['class' => $mediamodel->isNewRecord ? 'btn btn-success medadd' : 'btn btn-primary medsave']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            
            <?php Pjax::begin(['id'=>'mediagrid']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider26,
                //'filterModel' => $searchmediaModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'mid',                    
                    'title:ntext',
                    'note:ntext',
                    'link:ntext',
                    // 'image',
                    [
                            'label'=>'Image',
                            'format'=>'raw',
                            'value' => function($data){
                                $url = \Yii::$app->request->baseUrl. '/../../subscriberimg/mediaimg/'. $data->mid.'/'. $data->image;
                                return Html::img($url,['width'=>60, 'height'=>60, 'alt'=>'Blank']);  //'class' => 'pull-left img-responsive'
                            }
                    ],
                            
                    ['class' => 'yii\grid\ActionColumn',
                             'template'=>'{update} {delete}',
                              'buttons'=>[
                                    'update' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['allforms/updatemedia', 'id'=>$data->mid],['title'=>'Update', 'id'=>'updmed_'.$data->mid, 'class'=>'updmed']);                                                         
                              },
                                      'delete' => function ($url, $data) {     
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['allforms/deletemedia', 'id'=>$data->mid],['title'=>'Delete', 'id'=>'delmed_'.$data->mid, 'class'=>'delmed']);                                                         
                              }
                          ]
                     ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
        <!-- /#page-content-wrapper -->
       
        </div>
    </div>
    <!-- /#wrapper -->

    </div>
    <!-- /#container end -->
    
    <!-- Menu Toggle Script -->
    <script>
     $(document).ready(function(){
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });         
      /**********Show Personal div*************/
      $("#link1").click(function(){          
          $(".professional").css('display','none');
          $(".finance").css('display','none'); 
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');   
          $(".vehicle").css('display','none');
          $(".government").css('display','none');  
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".personal").css('display','block');          
      });
      
      /*$("#link2").click(function(){
          $(".family").css('display','none');
          $(".personal").css('display','none');   
          $(".professional").css('display','block');   
      });*/
      
     $("#pr1").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none');
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','block'); 
               $(".skills-occupation-form").css('display','block');   
            });
      
      $("#pr2").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none');
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".skills-occupation-form").css('display','none'); 
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','block'); 
               $(".userskills-form").css('display','block');   
            });
            
       $("#pr3").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".skills-occupation-form").css('display','none');  
               $(".userskills-form").css('display','none');  
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','block'); 
               $(".consultant-form").css('display','block'); 
            });
            
      $("#pr4").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".skills-occupation-form").css('display','none');  
               $(".userskills-form").css('display','none');   
               $(".consultant-form").css('display','none');
               $(".professional").css('display','block'); 
               $(".testimonial-form").css('display','block'); 
            });
            
      
      /****************Show Investment div*****************/
      $("#fi1").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".education").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','none');
               $(".skills-banks-form").css('display','none'); 
               $(".finance").css('display','block');   
               $(".skills-investment-form").css('display','block');   
            });
            
      /****************Show Banks div*****************/
      $("#fi2").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".education").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".skills-investment-form").css('display','none');   
               $(".finance").css('display','block');   
               $(".skills-banks-form").css('display','block');   
            });
            
     /**********Show Education div*************/       
     $("#link4").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none'); 
          $(".family").css('display','none');
          $(".finance").css('display','none');
          $(".medical").css('display','none'); 
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".education").css('display','block');
      });
      
      /**********Show Family div*************/
      $("#link5").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".medical").css('display','none'); 
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".family").css('display','block');
      });
      
       /****************Show Health div*****************/
      $("#md1").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".skills-physicians-form").css('display','none');
               $(".medical").css('display','block');   
               $(".skills-healthdetails-form").css('display','block');   
            });
            
      /****************Show Physician div*****************/
      $("#md2").click(function(){
               $(".personal").css('display','none');
               $(".family").css('display','none');
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".skills-healthdetails-form").css('display','none');
               $(".medical").css('display','block');   
               $(".skills-physicians-form").css('display','block');   
            });
      
      /**********Show Vehicle div*************/
      $("#link7").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".medical").css('display','none'); 
          $(".government").css('display','none'); 
          $(".family").css('display','none');
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".vehicle").css('display','block');
      });
      
       /****************Show gov.Id div*****************/
      $("#go1").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none');  
               $(".government").css('display','block');   
               $(".skills-government-ids-form").css('display','block');   
            });
            
      /****************Show passport div*****************/
      $("#go2").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".intellectual").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-government-ids-form").css('display','none'); 
               $(".government").css('display','block');   
               $(".skills-passport-form").css('display','block');   
            });
      
       /****************Show Hobbies div*****************/
      $("#in1").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none');
               $(".skills-plans-form").css('display','none');  
               $(".skills-creations-form").css('display','none');
               $(".skills-achievements-form").css('display','none'); 
               $(".skills-philosophy-form").css('display','none');  
               $(".skills-memories-form").css('display','none');
               $(".intellectual").css('display','block');   
               $(".user-hobbies-form").css('display','block');   
            });
            
       /****************Show Plans div*****************/
      $("#in2").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none'); 
               $(".user-hobbies-form").css('display','none');  
               $(".skills-creations-form").css('display','none');
               $(".skills-achievements-form").css('display','none');
               $(".skills-philosophy-form").css('display','none');  
               $(".skills-memories-form").css('display','none');
               $(".intellectual").css('display','block');   
               $(".skills-plans-form").css('display','block');   
            });
            
        /****************Show Creation div*****************/
      $("#in3").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none'); 
               $(".user-hobbies-form").css('display','none');  
               $(".skills-plans-form").css('display','none');
               $(".skills-achievements-form").css('display','none');
               $(".skills-philosophy-form").css('display','none');
               $(".skills-memories-form").css('display','none');
               $(".intellectual").css('display','block');   
               $(".skills-creations-form").css('display','block');   
            });
            
        /****************Show Achievement div*****************/
      $("#in4").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none'); 
               $(".user-hobbies-form").css('display','none');  
               $(".skills-plans-form").css('display','none'); 
               $(".skills-creations-form").css('display','none');
               $(".skills-philosophy-form").css('display','none');
               $(".skills-memories-form").css('display','none');
               $(".intellectual").css('display','block');   
               $(".skills-achievements-form").css('display','block');   
            });
            
       /****************Show Philosophy div*****************/
      $("#in5").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none'); 
               $(".user-hobbies-form").css('display','none');  
               $(".skills-plans-form").css('display','none'); 
               $(".skills-creations-form").css('display','none'); 
               $(".skills-achievements-form").css('display','none'); 
               $(".skills-memories-form").css('display','none');
               $(".intellectual").css('display','block');   
               $(".skills-philosophy-form").css('display','block');   
            });
            
        /****************Show Memories div*****************/
      $("#in6").click(function(){
               $(".personal").css('display','none'); 
               $(".professional").css('display','none'); 
               $(".finance").css('display','none');
               $(".education").css('display','none');
               $(".family").css('display','none');
               $(".medical").css('display','none'); 
               $(".vehicle").css('display','none');
               $(".government").css('display','none'); 
               $(".liking").css('display','none');
               $(".dislike").css('display','none');
               $(".belonging").css('display','none');
               $(".idols").css('display','none');
               $(".leasure").css('display','none');
               $(".socialmedia").css('display','none');
               $(".media").css('display','none');
               $(".userskills-form").css('display','none');
               $(".consultant-form").css('display','none'); 
               $(".testimonial-form").css('display','none');                
               $(".skills-physicians-form").css('display','none');
               $(".skills-passport-form").css('display','none'); 
               $(".user-hobbies-form").css('display','none');  
               $(".skills-plans-form").css('display','none'); 
               $(".skills-creations-form").css('display','none'); 
               $(".skills-achievements-form").css('display','none');
               $(".skills-philosophy-form").css('display','none');  
               $(".intellectual").css('display','block');   
               $(".skills-memories-form").css('display','block');   
            });
            
      /**********Show Liking div*************/
      $("#link10").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');           
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".liking").css('display','block');
      });
      
      /**********Show Dislike div*************/
      $("#link11").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');  
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".dislike").css('display','block');
      });
      
       /**********Show Belonging div*************/
      $("#link12").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');  
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".belonging").css('display','block');
      });
      
        /**********Show Idols div*************/
      $("#link13").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');  
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".idols").css('display','block');
      });
      
        /**********Show Leasure div*************/
      $("#link14").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');  
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','none');
          $(".leasure").css('display','block');
      });
      
          /**********Show Social div*************/
      $("#link15").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".education").css('display','none');
          $(".finance").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');  
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".media").css('display','none');
          $(".socialmedia").css('display','block');
      });
      
         /**********Show Media div*************/
      $("#link16").click(function(){
          $(".personal").css('display','none');
          $(".professional").css('display','none');
          $(".finance").css('display','none');
          $(".education").css('display','none');
          $(".family").css('display','none');
          $(".medical").css('display','none');  
          $(".vehicle").css('display','none');
          $(".government").css('display','none'); 
          $(".intellectual").css('display','none'); 
          $(".liking").css('display','none');
          $(".dislike").css('display','none');
          $(".belonging").css('display','none');
          $(".idols").css('display','none');
          $(".leasure").css('display','none');
          $(".socialmedia").css('display','none');
          $(".media").css('display','block');
      });
      
     });
    </script>





 

