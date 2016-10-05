<?php

namespace frontend\controllers;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

class AllformsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFetch()
    {
        $user= \dektrium\user\models\User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
        $commondetailmodel= \frontend\models\SkillCommonDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($commondetailmodel) && $commondetailmodel== "")
            $commondetailmodel = new \frontend\models\SkillCommonDetails();
        /*else {
            $bpid=$commondetailmodel->birthplaceid;
            //echo "Birthplace id...".$bpid;
        }*/
        $userdetailmodel=  \backend\models\UserDetail::find()->where(['user_id'=>\Yii::$app->user->identity->id])->one();
        if(!isset($userdetailmodel) && $userdetailmodel== "")
            $userdetailmodel= new \backend\models\UserDetail();
        $astrologymodel=  \frontend\models\SkillsAstrology::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($astrologymodel) && $astrologymodel== "")
            $astrologymodel=  new \frontend\models\SkillsAstrology();
        
        /*if($bpid!="")
        {
            $ids=  explode('_', $bpid);
            //echo "<br>".$ids[0].".......".$ids[1]."...........".$ids[2];
            $condata=[$ids[0]];
            $country=  \frontend\models\Countries::find()->where(['id'=>$ids[0]])->one();
            $state=  \frontend\models\States::find()->where(['id'=>$ids[1]])->one();
            $city=  \frontend\models\Cities::find()->where(['id'=>$ids[2]])->one();                   
        }*/
        $country= new \frontend\models\Countries();            
        $state= new \frontend\models\States();
        $city= new \frontend\models\Cities();
        $religionmodel=new \frontend\models\SkillsReligion();
        $faithmodel=new \frontend\models\SkillsFaith();
        $castmodel=new \frontend\models\SkillsCast();
            
        //$occupationmodel=  \frontend\models\SkillsOccupation::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($occupationmodel) && $occupationmodel== "")
        $occupationmodel = new \frontend\models\SkillsOccupation();
        $searchoccupationModel = new \frontend\models\SkillsOccupationSearch();
        $dataProvider1 = $searchoccupationModel->search(\Yii::$app->request->queryParams);
        
        
        $skillmodel= new \frontend\models\Skills();
        //$userskillmodel=\frontend\models\UserSkills::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
        //if(!isset($userskillmodel) && $userskillmodel=="")         
       $userskillmodel= new \frontend\models\UserSkills();
       $searchskillsModel=new \frontend\models\UserSkillsSearch();
       $dataProvider2=$searchskillsModel->search(\Yii::$app->request->queryParams);
       /* else{
            $userskillmodel=new \frontend\models\UserSkills();
            // Now add those to newly created models facidarray

            foreach ($userskillmdl as $usk) {           
                array_push($userskillmodel->skillarray, $usk->skillid);
            }
            // We also need the names of those skills so get it from skills table.        
            $skillids = implode(',', $userskillmodel->skillarray); 
            $skilldata=array();
            if($skillids!=''){
            $skill = \frontend\models\Skills::findBySql("select sid, skill from skills where sid IN(" . $skillids . ")")->all();
            $skilldata = ArrayHelper::map($skill, 'sid', 'skill');
            }
        }*/
        
        
        //$testmodel=  \frontend\models\SkillsTestimonials::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($testmodel) && $testmodel=="") 
        $testmodel= new \frontend\models\SkillsTestimonials();
        $searchtestModel=new \frontend\models\SkillsTestimonialsSearch();
        $dataProvider4=$searchtestModel->search(\Yii::$app->request->queryParams);
        
        //$consultantmodel=  \frontend\models\SkillsConsultants::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($consultantmodel) && $consultantmodel=="") 
        $consultantmodel= new \frontend\models\SkillsConsultants();
        $searchconsultantModel=new \frontend\models\SkillsConsultantsSearch();
        $dataProvider3=$searchconsultantModel->search(\Yii::$app->request->queryParams);
        
        //$investmodel=  \frontend\models\SkillsInvestment::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($investmodel) && $investmodel=="") 
        $investmodel= new \frontend\models\SkillsInvestment();
        $searchinvestModel=new \frontend\models\SkillsInvestmentSearch();
        $dataProvider5=$searchinvestModel->search(\Yii::$app->request->queryParams);
        
        //$bankmodel=  \frontend\models\SkillsBanks::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($bankmodel) && $bankmodel=="") 
        $bankmodel= new \frontend\models\SkillsBanks();
        $searchbankModel=new \frontend\models\SkillsBanksSearch();
        $dataProvider6=$searchbankModel->search(\Yii::$app->request->queryParams);
        
        //$educationmodel=  \frontend\models\SkillsEducation::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($educationmodel) && $educationmodel=="") 
        $educationmodel= new \frontend\models\SkillsEducation();
        $searcheducationModel=new \frontend\models\SkillsEducationSearch();
        $dataProvider7=$searcheducationModel->search(\Yii::$app->request->queryParams);
        
        $parentsmodel=  \frontend\models\SkillsParents::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($parentsmodel) && $parentsmodel=="") 
            $parentsmodel=new \frontend\models\SkillsParents();
        //$sibblingmodel=  \frontend\models\SkillsSibblings::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($sibblingmodel) && $sibblingmodel=="")             
        $spousemodel=  \frontend\models\SkillsSpouse::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($spousemodel) && $spousemodel=="") 
            $spousemodel=new \frontend\models\SkillsSpouse();
        $sibblingmodel=new \frontend\models\SkillsSibblings();
        $searchsibblingModel=new \frontend\models\SkillsSibblingsSearch();
        $dataProvider8=$searchsibblingModel->search(\Yii::$app->request->queryParams);
        
        $healthmodel=  \frontend\models\SkillsHealthdetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($healthmodel) && $healthmodel=="") 
            $healthmodel= new \frontend\models\SkillsHealthdetails();
        $diseasemodel= new \frontend\models\SkillsDiseases();
        $searchdiseaseModel=new \frontend\models\SkillsDiseasesSearch();
        $dataProvider9=$searchdiseaseModel->search(\Yii::$app->request->queryParams);
        
        //$physicianmodel=  \frontend\models\SkillsPhysicians::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($physicianmodel) && $physicianmodel=="") 
        $physicianmodel= new \frontend\models\SkillsPhysicians();
        $searchphysicianModel=new \frontend\models\SkillsPhysiciansSearch();
        $dataProvider10=$searchphysicianModel->search(\Yii::$app->request->queryParams);
        
        //$vehiclemodel=  \frontend\models\SkillsVehicles::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($vehiclemodel) && $vehiclemodel=="") 
        $vehiclemodel= new \frontend\models\SkillsVehicles();
        $searchvehicleModel=new \frontend\models\SkillsVehiclesSearch();
        $dataProvider11=$searchvehicleModel->search(\Yii::$app->request->queryParams);
        
        $govdocmodel=new \frontend\models\GovernDocumentType();
        //$govidmodel=  \frontend\models\SkillsGovernmentIds::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($govidmodel) && $govidmodel=="") 
        $govidmodel= new \frontend\models\SkillsGovernmentIds();
        $searchgovModel=new \frontend\models\SkillsGovernmentIdsSearch();
        $dataProvider12=$searchgovModel->search(\Yii::$app->request->queryParams);        
        
        //$passportmodel=  \frontend\models\SkillsPassport::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($passportmodel) && $passportmodel=="") 
        $passportmodel= new \frontend\models\SkillsPassport();
        $searchpassModel=new \frontend\models\SkillsPassportSearch();
        $dataProvider13=$searchpassModel->search(\Yii::$app->request->queryParams);        
        
        $hobbymodel= new \frontend\models\SkillsHobbies();
        $userhobbymodel= new \frontend\models\UserHobbies();
        $searchhobyModel=new \frontend\models\UserHobbiesSearch();
        $dataProvider14=$searchhobyModel->search(\Yii::$app->request->queryParams);        
        //$userhbymdl=  \frontend\models\UserHobbies::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
        //if(!isset($userhbymdl) && $userhbymdl=="")                    
        /*else{
            $userhobbymodel= new \frontend\models\UserHobbies();
            // Now add those to newly created models hobbyarray

            foreach ($userhbymdl as $uhb) {           
                array_push($userhobbymodel->hobbyarray, $uhb->hobbyid);
            }
            // We also need the names of those skills so get it from skills table.        
            $hobbyids = implode(',', $userhobbymodel->hobbyarray); 
            $hobbydata=array();
            if($hobbyids!=''){
            $hobby = \frontend\models\SkillsHobbies::findBySql("select hbid, hobby from skills_hobbies where hbid IN(" . $hobbyids . ")")->all();
            $hobbydata = ArrayHelper::map($hobby, 'hbid', 'hobby');
            }
        } */
             
        
        //$planmodel= \frontend\models\SkillsPlans::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($planmodel) && $planmodel=="") 
        $planmodel= new \frontend\models\SkillsPlans();
        $searchplanModel=new \frontend\models\SkillsPlansSearch();
        $dataProvider15=$searchplanModel->search(\Yii::$app->request->queryParams);        
        
        //$creationmodel= \frontend\models\SkillsCreations::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($creationmodel) && $creationmodel=="") 
        $creationmodel= new \frontend\models\SkillsCreations();
        $searchcrtModel=new \frontend\models\SkillsCreationsSearch();
        $dataProvider16=$searchcrtModel->search(\Yii::$app->request->queryParams);        
        
        //$achievementmodel= \frontend\models\SkillsAchievements::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($achievementmodel) && $achievementmodel=="") 
        $achievementmodel= new \frontend\models\SkillsAchievements();
        $searchachieveModel=new \frontend\models\SkillsAchievementsSearch();
        $dataProvider17=$searchachieveModel->search(\Yii::$app->request->queryParams);        
        
        //$philosophymodel= \frontend\models\SkillsPhilosophy::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($philosophymodel) && $philosophymodel=="") 
        $philosophymodel= new \frontend\models\SkillsPhilosophy();
        $searchphilospyModel=new \frontend\models\SkillsPhilosophySearch();
        $dataProvider18=$searchphilospyModel->search(\Yii::$app->request->queryParams);        
        
        //$memorymodel= \frontend\models\SkillsMemories::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($memorymodel) && $memorymodel=="") 
        $memorymodel= new \frontend\models\SkillsMemories();
        $searchmemoryModel=new \frontend\models\SkillsMemoriesSearch();
        $dataProvider19=$searchmemoryModel->search(\Yii::$app->request->queryParams);        
        
        //$likingmodel= \frontend\models\SkillsLikings::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($likingmodel) && $likingmodel=="") 
        $likingmodel= new \frontend\models\SkillsLikings();
        $searchlikeModel=new \frontend\models\SkillsLikingsSearch();
        $dataProvider20=$searchlikeModel->search(\Yii::$app->request->queryParams);   
        
       
        //$dislikemodel= \frontend\models\SkillsDislike::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($dislikemodel) && $dislikemodel=="") 
        $dislikemodel= new \frontend\models\SkillsDislike();
        $searchdislikeModel=new \frontend\models\SkillsDislikeSearch();
        $dataProvider21=$searchdislikeModel->search(\Yii::$app->request->queryParams);   
        
        //$belongingmodel= \frontend\models\SkillsBelongings::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($belongingmodel) && $belongingmodel=="") 
        $belongingmodel= new \frontend\models\SkillsBelongings();
        $searchbelongModel=new \frontend\models\SkillsBelongingsSearch();
        $dataProvider22=$searchbelongModel->search(\Yii::$app->request->queryParams);   
        
        //$idolmodel= \frontend\models\SkillsIdols::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($idolmodel) && $idolmodel=="") 
        $idolmodel= new \frontend\models\SkillsIdols();
        $searchidolModel=new \frontend\models\SkillsIdolsSearch();
        $dataProvider23=$searchidolModel->search(\Yii::$app->request->queryParams);   
        
        //$travelmodel= \frontend\models\SkillsTravelDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($travelmodel) && $travelmodel=="") 
        $travelmodel= new \frontend\models\SkillsTravelDetails();
        $searchtravelModel=new \frontend\models\SkillsTravelDetailsSearch();
        $dataProvider24=$searchtravelModel->search(\Yii::$app->request->queryParams);   
        
        //$socialmediamodel= \frontend\models\SkillsSocialmedia::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($socialmediamodel) && $socialmediamodel=="") 
        $socialmediamodel= new \frontend\models\SkillsSocialmedia();
        
        //$mediamodel= \frontend\models\SkillsMedia::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($mediamodel) && $mediamodel=="") 
        $mediamodel= new \frontend\models\SkillsMedia();
        $searchmediaModel=new \frontend\models\SkillsMediaSearch();
        $dataProvider26=$searchmediaModel->search(\Yii::$app->request->queryParams);   
        
        
        return $this->render('skill', [
                'commondetailmodel' => $commondetailmodel,
                'userdetailmodel' => $userdetailmodel,
                'astrologymodel' => $astrologymodel,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'user' => $user,
                'religionmodel' => $religionmodel,
                'faithmodel' => $faithmodel,
                'castmodel' => $castmodel,                
            
                'occupationmodel' => $occupationmodel,
                'skillmodel' => $skillmodel,
                'userskillmodel' => $userskillmodel,
                //'skilldata' => $skilldata,
                'testmodel' => $testmodel,
                'searchtestModel' => $searchtestModel,
                'dataProvider4' => $dataProvider4,
                'consultantmodel' => $consultantmodel,
                'searchconsultantModel' => $searchconsultantModel,
                'dataProvider3' => $dataProvider3,
                'searchoccupationModel' => $searchoccupationModel,
                'dataProvider1' => $dataProvider1,
                'searchskillsModel' =>$searchskillsModel,
                'dataProvider2' => $dataProvider2,
            
                'investmodel' => $investmodel,
                'searchinvestModel' => $searchinvestModel,
                'dataProvider5' => $dataProvider5,
                'bankmodel' => $bankmodel,
                'searchbankModel' => $searchbankModel,
                'dataProvider6' => $dataProvider6,
            
                'educationmodel' => $educationmodel,
                'searcheducationModel' => $searcheducationModel,
                'dataProvider7' => $dataProvider7,
            
                'parentsmodel'=>$parentsmodel,                
                'spousemodel' => $spousemodel,
                'sibblingmodel' => $sibblingmodel,
                'searchsibblingModel' => $searchsibblingModel,
                'dataProvider8' => $dataProvider8,
            
                'healthmodel' => $healthmodel,
                'diseasemodel' => $diseasemodel,
                'searchdiseaseModel' => $searchdiseaseModel,
                'dataProvider9' => $dataProvider9,
                'physicianmodel' => $physicianmodel,
                'searchphysicianModel' => $searchphysicianModel,
                'dataProvider10' => $dataProvider10,
            
                'vehiclemodel' => $vehiclemodel,
                'searchvehicleModel' => $searchvehicleModel,
                'dataProvider11' => $dataProvider11,
                
                'govdocmodel' => $govdocmodel,                
                'govidmodel' => $govidmodel,
                'searchgovModel' => $searchgovModel,
                'dataProvider12' => $dataProvider12,
            
                'passportmodel' => $passportmodel,
                'searchpassModel' => $searchpassModel,
                'dataProvider13' => $dataProvider13,
            
                'hobbymodel' => $hobbymodel,
                'userhobbymodel' => $userhobbymodel,
                'searchhobyModel' => $searchhobyModel,
                'dataProvider14' => $dataProvider14,
                //'hobbydata' => $hobbydata,
                'planmodel' => $planmodel,
                'searchplanModel' => $searchplanModel,
                'dataProvider15' => $dataProvider15,
            
                'creationmodel' => $creationmodel,
                'searchcrtModel' => $searchcrtModel,
                'dataProvider16' => $dataProvider16,
            
                'achievementmodel' => $achievementmodel,
                'searchachieveModel' => $searchachieveModel,
                'dataProvider17' => $dataProvider17,
            
                'philosophymodel' => $philosophymodel,
                'searchphilospyModel' => $searchphilospyModel,
                'dataProvider18' => $dataProvider18,
            
                'memorymodel' => $memorymodel,
                'searchmemoryModel' => $searchmemoryModel,
                'dataProvider19' => $dataProvider19,
            
                'likingmodel' => $likingmodel,
                'searchlikeModel' => $searchlikeModel,
                'dataProvider20' => $dataProvider20,
             
                'dislikemodel' => $dislikemodel,
                'searchdislikeModel' => $searchdislikeModel,
                'dataProvider21' => $dataProvider21,
            
                'belongingmodel' => $belongingmodel,
                'searchbelongModel' => $searchbelongModel, 
                'dataProvider22' => $dataProvider22,
            
                'idolmodel' => $idolmodel,
                'searchidolModel' => $searchidolModel,
                'dataProvider23' => $dataProvider23,
            
                'travelmodel' => $travelmodel,
                'searchtravelModel' => $searchtravelModel,
                'dataProvider24' => $dataProvider24,
            
                'socialmediamodel' => $socialmediamodel,
            
                'mediamodel' => $mediamodel,
                'searchmediaModel' => $searchmediaModel,
                'dataProvider26' => $dataProvider26,
            ]); 
    }
    
    public function actionSavecommondetails()
    {
        $religionmodel=new \frontend\models\SkillsReligion();
        $faithmodel=new \frontend\models\SkillsFaith();
        $castmodel=new \frontend\models\SkillsCast();
        
        $user= \dektrium\user\models\User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
        $commondetailmodel= \frontend\models\SkillCommonDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($commondetailmodel) && $commondetailmodel== "")
            $commondetailmodel = new \frontend\models\SkillCommonDetails();
        $userdetailmodel=  \backend\models\UserDetail::find()->where(['user_id'=>\Yii::$app->user->identity->id])->one();
        if(!isset($userdetailmodel) && $userdetailmodel== "")
            $userdetailmodel= new \backend\models\UserDetail();
        $astrologymodel=  \frontend\models\SkillsAstrology::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($astrologymodel) && $astrologymodel== "")
            $astrologymodel=  new \frontend\models\SkillsAstrology();
        $user->scenario='Update';
        
        $success1=false;
        $success2=false;
        $success3=false;
        
        if ($commondetailmodel->load(\Yii::$app->request->post()) && $userdetailmodel->load(\Yii::$app->request->post())) {
            $commondetailmodel->userid=\Yii::$app->user->identity->id;     
            //var_dump($commondetailmodel->attributes);
            //var_dump($userdetailmodel->attributes);
            $astrologymodel->load(\Yii::$app->request->post());
            $email=$_POST['User']['email'];
            $phone=$_POST['User']['phone'];
            $conid=$_POST['Countries']['id'];
            $statid=$_POST['States']['id'];
            $cityid=$_POST['Cities']['id'];
            $commondetailmodel->birthplaceid=$conid."_".$statid."_".$cityid;
           
            if(isset($_POST['SkillsReligion']['religion_name']) && $_POST['SkillsReligion']['religion_name']!="")
            {
                $religionmodel->religion_name=$_POST['SkillsReligion']['religion_name'];
                $religionmodel->Is_approved=0;
                $religionmodel->save();
                $commondetailmodel->religionid=$religionmodel->regid;                
            }            
            if(isset($_POST['SkillsFaith']['faith']) && $_POST['SkillsFaith']['faith']!="")
            {
                $faithmodel->faith=$_POST['SkillsFaith']['faith'];
                $faithmodel->Is_approved=0;
                $faithmodel->save();
                $commondetailmodel->faithid=$faithmodel->faithid;                
            }
            if(isset($_POST['SkillsCast']['cast']) && $_POST['SkillsCast']['cast']!="")
            {
                $castmodel->cast=$_POST['SkillsCast']['cast'];
                $castmodel->Is_approved=0;
                $castmodel->save();
                $commondetailmodel->castid=$castmodel->castid;                
            }
            
            $success1=$commondetailmodel->save();
            
            $userdetailmodel->user_id=\Yii::$app->user->identity->id; 
            $userdetailmodel->role='Subscriber';
            $success2=$userdetailmodel->save();
            
            $user->email=$email;
            $user->phone=$phone;
            $success3=$user->save(false);
            
            $astrologymodel->userid=\Yii::$app->user->identity->id;                         
            $uploadedFile= UploadedFile::getInstance($astrologymodel,'image');  
            //var_dump($uploadedFile);
            
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ))
           {
               $fileName = $uploadedFile;  //  file name
               $astrologymodel->image = $fileName->name;     
           }
           else{
               $astrologymodel->image= \frontend\models\SkillsAstrology::findOne($astrologymodel->astid)->image;
           }
           //var_dump($testmodel->attributes);
           
            if($astrologymodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $astrologymodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/astrologyimg/'. $astrologymodel->astid.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/astrologyimg/
                 }                
            }                   
            
            
            //echo $email."....".$phone."....".$conid."....".$statid.".....".$cityid;
            if($success1 && $success2 && $success3)
            {
                echo 1;
            }
            else {
                echo 0;
            }          
        } else { 
            $this->actionFetch();            
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSaveoccupation()
    {        
        //$occupationmodel=\frontend\models\SkillsOccupation::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($occupationmodel) && $occupationmodel== "")
        if($_POST['update']!="")
            $occupationmodel=\frontend\models\SkillsOccupation::find()->where(['ocid'=>$_POST['update']])->one();
        else{
            $occupationmodel = new \frontend\models\SkillsOccupation();
        }
       
        if ($occupationmodel->load(\Yii::$app->request->post())) {
            $occupationmodel->userid=\Yii::$app->user->identity->id;          
            if($occupationmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    } 
    
    public function actionUpdateoccupation()
    {
        $id=$_REQUEST['id'];
        $occupationmodel=\frontend\models\SkillsOccupation::find()->where(['ocid'=>$id])->one();
        $result=array();            
        //var_dump($occupationmodel);
        array_push($result, array('occupationtype'=>$occupationmodel['occupationtype'], 'company'=>$occupationmodel['company'], 'designation'=>$occupationmodel['designation'], 'tenure'=>$occupationmodel['tenure'],  'fromdate'=>$occupationmodel['fromdate'],  'todate'=>$occupationmodel['todate'], 'description'=>$occupationmodel['description']));       
        echo json_encode($result);
    } 
    
    public function actionDeleteoccupation()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $occupation=  \frontend\models\SkillsOccupation::findOne(['ocid'=>$id]);
        $flag=$occupation->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }
   /**********************************************************************************************************************************/
    public function actionSaveuserskills()
    {
        if($_POST['updateskill']!="")
            $userskillmodel=  \frontend\models\UserSkills::find()->where(['usid'=>$_POST['updateskill']])->one();
        else{
            $userskillmodel= new \frontend\models\UserSkills();
        }
        $skillmodel= new \frontend\models\Skills();       
        
                
        if($userskillmodel->load(\Yii::$app->request->post())){
            $userskillmodel->userid=\Yii::$app->user->identity->id; 
            if(isset($_POST['Skills']['skill']) && $_POST['Skills']['skill']!=""){
                $skillmodel->skill=$_POST['Skills']['skill'];
                $skillmodel->Is_approved=0;
                $skillmodel->save();                
                $userskillmodel->skillid=$skillmodel->sid;
                //$userskillmodel->save();
            }                        
            
            if($userskillmodel->save()){
              echo 1;
            }
            else {
                echo 0;
            }    
            
        }else { 
            $this->actionFetch();            
        }
    }

    public function actionUpdateskill()
    {
        $id=$_REQUEST['id'];
        $userskillmodel=  \frontend\models\UserSkills::find()->where(['usid'=>$id])->one();
        $result=array();         
        array_push($result, array('skillid'=>$userskillmodel['skillid'], 'description'=>$userskillmodel['description']));       
        echo json_encode($result);
    } 
    
    public function actionDeleteskill()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $skills= \frontend\models\UserSkills::findOne(['usid'=>$id]);
        $flag=$skills->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }
    /**********************************************************************************************************************************/
    public function actionSaveconsultant()
    {       
         if($_POST['updateconsultant']!="")
             $consultantmodel=  \frontend\models\SkillsConsultants::find()->where(['cid'=>$_POST['updateconsultant']])->one ();
         else {
              $consultantmodel= new \frontend\models\SkillsConsultants();
         }           
        
        if ($consultantmodel->load(\Yii::$app->request->post())) {
            $consultantmodel->userid=\Yii::$app->user->identity->id;          
            if($consultantmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateconsultant()
    {
        $id=$_REQUEST['id'];
        $consultantmodel= \frontend\models\SkillsConsultants::find()->where(['cid'=>$id])->one();
        $result=array();         
        array_push($result, array('consultant_type'=>$consultantmodel['consultant_type'], 'name'=>$consultantmodel['name'], 'phone'=>$consultantmodel['phone'], 'email'=>$consultantmodel['email']));       
        echo json_encode($result);
    }
     public function actionDeleteconsultant()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $consultant= \frontend\models\SkillsConsultants::findOne(['cid'=>$id]);
        $flag=$consultant->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }
    /**********************************************************************************************************************************/
    public function actionSavetestimonial()
    {
        //$testmodel=  \frontend\models\SkillsTestimonials::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($testmodel) && $testmodel=="") 
        if($_POST['updatetest']!="")
            $testmodel=  \frontend\models\SkillsTestimonials::find()->where(['testid'=>$_POST['updatetest']])->one();
        else{
            $testmodel= new \frontend\models\SkillsTestimonials();
        }
        
        if ($testmodel->load(\Yii::$app->request->post())) {
            $testmodel->userid=\Yii::$app->user->identity->id; 
            
            //var_dump($_POST);
            $uploadedFile= UploadedFile::getInstance($testmodel,'image');  
            //var_dump($uploadedFile);
            
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ))
           {
               $fileName = $uploadedFile;  //  file name
               $testmodel->image = $fileName->name;     
           }
           else{
               $testmodel->image= \frontend\models\SkillsTestimonials::findOne($testmodel->testid)->image;
           }
           //var_dump($testmodel->attributes);
           
            if($testmodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $testmodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/testimonialimg/'. $testmodel->testid.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/testimonialimg/
                 }
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatetest()
    {
        $id=$_REQUEST['id'];
        $testmodel= \frontend\models\SkillsTestimonials::find()->where(['testid'=>$id])->one();
        $result=array();         
        array_push($result, array('quotes'=>$testmodel['quotes'], 'name'=>$testmodel['name']));       
        echo json_encode($result);
    }
    public function actionDeletetest()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $test= \frontend\models\SkillsTestimonials::findOne(['testid'=>$id]);
        $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'subscriberimg'.DIRECTORY_SEPARATOR.'testimonialimg'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$test->image;       
        unlink($filepath);           //to delete file from folder
        $flag=$test->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }  
    /**********************************************************************************************************************************/
    public function actionSaveinvestment()
    {
        //$investmodel=  \frontend\models\SkillsInvestment::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($investmodel) && $investmodel=="") 
        if($_POST['updateinvest']!="")
            $investmodel=  \frontend\models\SkillsInvestment::find()->where(['invid'=>$_POST['updateinvest']])->one();
        else{
            $investmodel= new \frontend\models\SkillsInvestment();
        }        
        $commondetailmodel= \frontend\models\SkillCommonDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        
        if ($investmodel->load(\Yii::$app->request->post())) {
            $investmodel->userid=\Yii::$app->user->identity->id;
            $commondetailmodel->annual_income=$_POST['SkillCommonDetails']['annual_income'];
            $commondetailmodel->save(); 
            if($investmodel->save() )    //&& $commondetailmodel->save()
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateinvest()
    {
        $id=$_REQUEST['id'];
        $investmodel= \frontend\models\SkillsInvestment::find()->where(['invid'=>$id])->one();
        $result=array();         
        array_push($result, array('investment_type'=>$investmodel['investment_type'], 'valuation'=>$investmodel['valuation'], 'description'=>$investmodel['description']));       
        echo json_encode($result);
    }
    public function actionDeleteinvest()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $invest= \frontend\models\SkillsInvestment::findOne(['invid'=>$id]);        
        $flag=$invest->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavebank()
    {
        //$bankmodel=  \frontend\models\SkillsBanks::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($bankmodel) && $bankmodel=="") 
        if($_POST['updatebank']!="")
            $bankmodel=  \frontend\models\SkillsBanks::find()->where(['bid'=>$_POST['updatebank']])->one();
        else{
             $bankmodel= new \frontend\models\SkillsBanks();
        }           
        
        if ($bankmodel->load(\Yii::$app->request->post())) {
            $bankmodel->userid=\Yii::$app->user->identity->id;            
            if($bankmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }           
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatebank()
    {
        $id=$_REQUEST['id'];
        $bankmodel= \frontend\models\SkillsBanks::find()->where(['bid'=>$id])->one();
        $result=array();         
        array_push($result, array('bankname'=>$bankmodel['bankname'], 'branchname'=>$bankmodel['branchname'], 'account_no'=>$bankmodel['account_no'], 'IFSC_no'=>$bankmodel['IFSC_no']));       
        echo json_encode($result);
    }
    public function actionDeletebank()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $bank= \frontend\models\SkillsBanks::findOne(['bid'=>$id]);        
        $flag=$bank->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSaveeducation()
    {
        //$educationmodel=  \frontend\models\SkillsEducation::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($educationmodel) && $educationmodel=="") 
       if($_POST['updateeducation']!="")  
           $educationmodel=  \frontend\models\SkillsEducation::find()->where(['eid'=>$_POST['updateeducation']])->one();
       else{
           $educationmodel= new \frontend\models\SkillsEducation();        
       }
        
        if ($educationmodel->load(\Yii::$app->request->post())) {
            $educationmodel->userid=\Yii::$app->user->identity->id;            
            if($educationmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }           
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateeducation()
    {
        $id=$_REQUEST['id'];
        $educationmodel= \frontend\models\SkillsEducation::find()->where(['eid'=>$id])->one();
        $result=array();         
        array_push($result, array('qualification'=>$educationmodel['qualification'], 'institute'=>$educationmodel['institute'], 'year'=>$educationmodel['year']));       
        echo json_encode($result);
    }
    public function actionDeleteeducation()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $education= \frontend\models\SkillsEducation::findOne(['eid'=>$id]);        
        $flag=$education->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavefamily()
    {
        $parentsmodel=  \frontend\models\SkillsParents::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($parentsmodel) && $parentsmodel=="") 
            $parentsmodel=new \frontend\models\SkillsParents();
        //$sibblingmodel=  \frontend\models\SkillsSibblings::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($sibblingmodel) && $sibblingmodel=="") 
        if($_POST['updatesibbling']!="") 
            $sibblingmodel=  \frontend\models\SkillsSibblings::find()->where(['sibid'=>$_POST['updatesibbling']])->one();
        else{
            $sibblingmodel=new \frontend\models\SkillsSibblings();
        }
        $spousemodel=  \frontend\models\SkillsSpouse::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($spousemodel) && $spousemodel=="") 
            $spousemodel=new \frontend\models\SkillsSpouse();
        
                
        $success=true;
        if($success){
        if($parentsmodel->load(\Yii::$app->request->post()) && $parentsmodel->validate()) {
            $parentsmodel->userid=\Yii::$app->user->identity->id;            
            if($parentsmodel->save())
            {               
                $success=true;
            }            
            else {               
                $success=false;
            } 
        }
        if($sibblingmodel->load(\Yii::$app->request->post()) && $sibblingmodel->validate()){
            $sibblingmodel->userid=\Yii::$app->user->identity->id;            
            if($sibblingmodel->save())
            {               
                $success=true;
            }            
            else {               
                $success=false;
            } 
         }
         if($spousemodel->load(\Yii::$app->request->post()) && $spousemodel->validate()){
             $spousemodel->userid=\Yii::$app->user->identity->id;            
            if($spousemodel->save())
            {               
                $success=true;
            }            
            else {               
                $success=false;
            }
         }
            if($success)
            {
                 echo 1;
            }  else {  
                 echo 0;
            }
        } 
        else { 
            $this->actionFetch();            
        } 
    }
    public function actionUpdatesibbling()
    {
        $id=$_REQUEST['id'];
        $sibblingmodel= \frontend\models\SkillsSibblings::find()->where(['sibid'=>$id])->one();
        $result=array();         
        array_push($result, array('firstname'=>$sibblingmodel['firstname'], 'lastname'=>$sibblingmodel['lastname'], 'link'=>$sibblingmodel['link'], 'relation'=>$sibblingmodel['relation']));       
        echo json_encode($result);
    }
    public function actionDeletesibbling()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $sibbling= \frontend\models\SkillsSibblings::findOne(['sibid'=>$id]);        
        $flag=$sibbling->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavehealthdetails()
    {
        $healthmodel=  \frontend\models\SkillsHealthdetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        if(!isset($healthmodel) && $healthmodel=="") 
            $healthmodel= new \frontend\models\SkillsHealthdetails();
        if($_POST['updatehealth']!="") 
            $diseasemodel= \frontend\models\SkillsDiseases::find()->where(['disid'=>$_POST['updatehealth']])->one();
        else{
            $diseasemodel= new \frontend\models\SkillsDiseases();
        }
        
        
        if ($healthmodel->load(\Yii::$app->request->post())) {
            $healthmodel->userid=\Yii::$app->user->identity->id; 
            $diseasemodel->load(\Yii::$app->request->post());
            $diseasemodel->userid=\Yii::$app->user->identity->id;   
            $diseasemodel->save();
            if($healthmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }           
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatedisease()
    {
        $id=$_REQUEST['id'];
        $diseasemodel= \frontend\models\SkillsDiseases::find()->where(['disid'=>$id])->one();
        $result=array();         
        array_push($result, array('disease'=>$diseasemodel['disease']));       
        echo json_encode($result);
    }
    public function actionDeletedisease()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $disease= \frontend\models\SkillsDiseases::findOne(['disid'=>$id]);        
        $flag=$disease->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavephysician()
    {
        //$physicianmodel=  \frontend\models\SkillsPhysicians::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($physicianmodel) && $physicianmodel=="") 
        if($_POST['updatephysician']!="") 
            $physicianmodel=  \frontend\models\SkillsPhysicians::find()->where(['id'=>$_POST['updatephysician']])->one();
        else{
            $physicianmodel= new \frontend\models\SkillsPhysicians();
        }            
            
        if ($physicianmodel->load(\Yii::$app->request->post())) {
            $physicianmodel->userid=\Yii::$app->user->identity->id;            
            if($physicianmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }           
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatephysician()
    {
        $id=$_REQUEST['id'];
        $physicianmodel= \frontend\models\SkillsPhysicians::find()->where(['id'=>$id])->one();
        $result=array();         
        array_push($result, array('physician_name'=>$physicianmodel['physician_name'], 'speciality'=>$physicianmodel['speciality'], 'phone'=>$physicianmodel['phone'], 'email'=>$physicianmodel['email']));       
        echo json_encode($result);
    }
    public function actionDeletephysician()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $physician= \frontend\models\SkillsPhysicians::findOne(['id'=>$id]);        
        $flag=$physician->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavevehicles()
    {
        //$vehiclemodel=  \frontend\models\SkillsVehicles::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($vehiclemodel) && $vehiclemodel=="") 
        if($_POST['updatevehicle']!="") 
            $vehiclemodel=  \frontend\models\SkillsVehicles::find()->where(['vcid'=>$_POST['updatevehicle']])->one();
        else{
            $vehiclemodel= new \frontend\models\SkillsVehicles();
        }        
            
        if ($vehiclemodel->load(\Yii::$app->request->post())) {
            $vehiclemodel->userid=\Yii::$app->user->identity->id;            
            if($vehiclemodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }           
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatevehicle()
    {
        $id=$_REQUEST['id'];
        $vehiclemodel= \frontend\models\SkillsVehicles::find()->where(['vcid'=>$id])->one();
        $result=array();         
        array_push($result, array('vehicle_type'=>$vehiclemodel['vehicle_type'], 'make'=>$vehiclemodel['make'], 'year'=>$vehiclemodel['year'], 'registration_no'=>$vehiclemodel['registration_no']));       
        echo json_encode($result);
    }
    public function actionDeletevehicle()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $vehicle= \frontend\models\SkillsVehicles::findOne(['vcid'=>$id]);        
        $flag=$vehicle->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavegovernmentids()
    {
        $govdocmodel=new \frontend\models\GovernDocumentType(); 
        //$govidmodel=  \frontend\models\SkillsGovernmentIds::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($govidmodel) && $govidmodel=="") 
        if($_POST['updategov']!="")   
            $govidmodel=  \frontend\models\SkillsGovernmentIds::find()->where(['gid'=>$_POST['updategov']])->one();
        else{
            $govidmodel= new \frontend\models\SkillsGovernmentIds();
        }
                    
        if ($govidmodel->load(\Yii::$app->request->post())) {
            $govidmodel->userid=\Yii::$app->user->identity->id;
            if(isset($_POST['GovernDocumentType']['doc_name']) && $_POST['GovernDocumentType']['doc_name']!="")
            {
                $govdocmodel->doc_name=$_POST['GovernDocumentType']['doc_name'];
                $govdocmodel->Is_approved=0;
                $govdocmodel->save();
                $govidmodel->governdoc_type=$govdocmodel->id;                
            }
            if($govidmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }           
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdategovid()
    {
        $id=$_REQUEST['id'];
        $govidmodel= \frontend\models\SkillsGovernmentIds::find()->where(['gid'=>$id])->one();
        $result=array();         
        array_push($result, array('governdoc_type'=>$govidmodel['governdoc_type'], 'govern_no'=>$govidmodel['govern_no']));       
        echo json_encode($result);
    }
    public function actionDeletegovid()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $govid= \frontend\models\SkillsGovernmentIds::findOne(['gid'=>$id]);        
        $flag=$govid->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavepassport()
    {
        //$passportmodel=  \frontend\models\SkillsPassport::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($passportmodel) && $passportmodel=="") 
        if($_POST['updatepass']!="")   
            $passportmodel=  \frontend\models\SkillsPassport::find()->where(['pid'=>$_POST['updatepass']])->one();
        else{
            $passportmodel= new \frontend\models\SkillsPassport();
        }          
        
        if ($passportmodel->load(\Yii::$app->request->post())) {
            $passportmodel->userid=\Yii::$app->user->identity->id; 
           
            $uploadedFile= UploadedFile::getInstance($passportmodel,'scancopy');  
            //var_dump($uploadedFile);
            
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ))
           {
               $fileName = $uploadedFile;  //  file name
               $passportmodel->scancopy = $fileName->name;     
           }
           else{
               $passportmodel->scancopy= \frontend\models\SkillsPassport::findOne($passportmodel->pid)->scancopy;
           }
           //var_dump($testmodel->attributes);
           
            if($passportmodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $passportmodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/passportimg/'. $passportmodel->pid.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/passportimg/
                 }
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatepassport()
    {
        $id=$_REQUEST['id'];
        $passportmodel= \frontend\models\SkillsPassport::find()->where(['pid'=>$id])->one();
        $result=array();         
        array_push($result, array('nationality'=>$passportmodel['nationality'], 'passport_no'=>$passportmodel['passport_no'], 'issuedate'=>$passportmodel['issuedate'], 'expirydate'=>$passportmodel['expirydate']));       
        echo json_encode($result);
    }
    public function actionDeletepassport()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $passport= \frontend\models\SkillsPassport::findOne(['pid'=>$id]);
        $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'subscriberimg'.DIRECTORY_SEPARATOR.'passportimg'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$passport->scancopy;       
        unlink($filepath);           //to delete file from folder
        $flag=$passport->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }  
    /**********************************************************************************************************************************/
    public function actionSaveuserhobbies()
    {
        $hobbymodel= new \frontend\models\SkillsHobbies();
        if($_POST['updatehobby']!="") 
            $userhobbymodel=  \frontend\models\UserHobbies::find()->where(['uhbid'=>$_POST['updatehobby']])->one();
        else{
            $userhobbymodel= new \frontend\models\UserHobbies();
        }
                        
        $success=false;
        if($userhobbymodel->load(\Yii::$app->request->post())){            
            if(isset($_POST['UserHobbies']['hobbyarray'])){
                $userhobbymodel->hobbyarray=$_POST['UserHobbies']['hobbyarray']; 
            } 
            //\frontend\models\UserHobbies::deleteAll(['userid'=>\Yii::$app->user->identity->id]); 
            if(isset($userhobbymodel->hobbyarray) && $userhobbymodel->hobbyarray!=''){
            foreach ($userhobbymodel->hobbyarray as $hb)
             {                 
                 //var_dump($userhobbymodel->attributes);
                 if($_POST['updatehobby']!="") 
                    $uhb=  \frontend\models\UserHobbies::find()->where(['uhbid'=>$_POST['updatehobby']])->one();
                 else{
                    $uhb=new \frontend\models\UserHobbies();
                 }
                 $uhb->userid=\Yii::$app->user->identity->id;                 
                 $uhb->hobbyid=$hb;                               
                 $success=$uhb->save();
            }
            }
            if(isset($_POST['SkillsHobbies']['hobby']) && $_POST['SkillsHobbies']['hobby']!=""){
                $hobbymodel->hobby=$_POST['SkillsHobbies']['hobby'];
                $hobbymodel->Is_approved=0;
                $hobbymodel->save();
                $userhobbymodel->userid=\Yii::$app->user->identity->id;  
                $userhobbymodel->hobbyid=$hobbymodel->hbid;
                $success=$userhobbymodel->save();
            }
            
            if($success){
              echo 1;
            }
            else {
                echo 0;
            }        
            
        }else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatehobby()
    {
        $id=$_REQUEST['id'];
        $hobbymodel= \frontend\models\UserHobbies::find()->where(['uhbid'=>$id])->one();
        $hobby=  \frontend\models\SkillsHobbies::find()->where(['hbid'=>$hobbymodel['hobbyid']])->one();
        $result=array();         
        array_push($result, array('hobbyid'=>$hobbymodel['hobbyid'], 'hobby'=>$hobby['hobby']));       
        echo json_encode($result);
    }
    public function actionDeletehobby()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $hobby= \frontend\models\UserHobbies::findOne(['uhbid'=>$id]);        
        $flag=$hobby->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSaveplan()
    {
        //$planmodel= \frontend\models\SkillsPlans::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($planmodel) && $planmodel=="") 
        if($_POST['updateplan']!="") 
            $planmodel=  \frontend\models\SkillsPlans::find()->where(['planid'=>$_POST['updateplan']])->one();
        else{
            $planmodel = new \frontend\models\SkillsPlans();
        }          

       if ($planmodel->load(\Yii::$app->request->post())) {
            $planmodel->userid=\Yii::$app->user->identity->id;            
            if($planmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateplan()
    {
        $id=$_REQUEST['id'];
        $planmodel= \frontend\models\SkillsPlans::find()->where(['planid'=>$id])->one();        
        $result=array();         
        array_push($result, array('plantype'=>$planmodel['plantype'], 'description'=>$planmodel['description']));       
        echo json_encode($result);
    }
    public function actionDeleteplan()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $plan= \frontend\models\SkillsPlans::findOne(['planid'=>$id]);        
        $flag=$plan->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavecreations()
    {
        //$creationmodel= \frontend\models\SkillsCreations::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($creationmodel) && $creationmodel=="") 
        if($_POST['updatecrt']!="") 
            $creationmodel=  \frontend\models\SkillsCreations::find()->where(['crid'=>$_POST['updatecrt']])->one();
        else{
            $creationmodel= new \frontend\models\SkillsCreations();
        }            
        
        if ($creationmodel->load(\Yii::$app->request->post())) {
            $creationmodel->userid=\Yii::$app->user->identity->id; 
                       
            $uploadedFile= UploadedFile::getInstance($creationmodel,'image');  
            //var_dump($uploadedFile);
            
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ))
           {
               $fileName = $uploadedFile;  //  file name
               $creationmodel->image = $fileName->name;     
           }
           else{
               $creationmodel->image= \frontend\models\SkillsCreations::findOne($creationmodel->crid)->image;
           }
           //var_dump($testmodel->attributes);
           
            if($creationmodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $creationmodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/creationimg/'. $creationmodel->crid.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/creationimg/
                 }
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatecreation()
    {
        $id=$_REQUEST['id'];
        $creationmodel= \frontend\models\SkillsCreations::find()->where(['crid'=>$id])->one();
        $result=array();         
        array_push($result, array('title'=>$creationmodel['title'], 'note'=>$creationmodel['note'], 'youtoube_link'=>$creationmodel['youtoube_link']));       
        echo json_encode($result);
    }
    public function actionDeletecreation()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $creation= \frontend\models\SkillsCreations::findOne(['crid'=>$id]);
        $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'subscriberimg'.DIRECTORY_SEPARATOR.'creationimg'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$creation->image;       
        unlink($filepath);           //to delete file from folder
        $flag=$creation->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }  
    /**********************************************************************************************************************************/
    public function actionSaveachievements()
    {
        //$achievementmodel= \frontend\models\SkillsAchievements::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($achievementmodel) && $achievementmodel=="") 
         if($_POST['updateachieve']!="") 
             $achievementmodel=  \frontend\models\SkillsAchievements::find()->where(['id'=>$_POST['updateachieve']])->one();
         else{
             $achievementmodel= new \frontend\models\SkillsAchievements();
         }
        
       if ($achievementmodel->load(\Yii::$app->request->post())) {
            $achievementmodel->userid=\Yii::$app->user->identity->id;            
            if($achievementmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateachievement()
    {
        $id=$_REQUEST['id'];
        $achievementmodel= \frontend\models\SkillsAchievements::find()->where(['id'=>$id])->one();        
        $result=array();         
        array_push($result, array('title'=>$achievementmodel['title'], 'note'=>$achievementmodel['note'], 'professional_plan'=>$achievementmodel['professional_plan']));       
        echo json_encode($result);
    }
    public function actionDeleteachievement()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $achievement= \frontend\models\SkillsAchievements::findOne(['id'=>$id]);        
        $flag=$achievement->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavephilosophy()
    {
        //$philosophymodel= \frontend\models\SkillsPhilosophy::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($philosophymodel) && $philosophymodel=="") 
         if($_POST['updatephilospy']!="") 
             $philosophymodel= \frontend\models\SkillsPhilosophy::find()->where(['phid'=>$_POST['updatephilospy']])->one();
         else{
             $philosophymodel= new \frontend\models\SkillsPhilosophy();
         }
        
        if ($philosophymodel->load(\Yii::$app->request->post())) {
            $philosophymodel->userid=\Yii::$app->user->identity->id;            
            if($philosophymodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatephilosophy()
    {
        $id=$_REQUEST['id'];
        $philosophymodel= \frontend\models\SkillsPhilosophy::find()->where(['phid'=>$id])->one();        
        $result=array();         
        array_push($result, array('philosophytext'=>$philosophymodel['philosophytext']));       
        echo json_encode($result);
    }
    public function actionDeletephilosophy()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $philosophy= \frontend\models\SkillsPhilosophy::findOne(['phid'=>$id]);        
        $flag=$philosophy->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavememory()
    {
        //$memorymodel= \frontend\models\SkillsMemories::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($memorymodel) && $memorymodel=="") 
        if($_POST['updatemem']!="") 
            $memorymodel=  \frontend\models\SkillsMemories::find()->where(['memoid'=>$_POST['updatemem']])->one();
        else{
            $memorymodel= new \frontend\models\SkillsMemories();
        }            
        
        if ($memorymodel->load(\Yii::$app->request->post())) {
            $memorymodel->userid=\Yii::$app->user->identity->id;            
            if($memorymodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatememory()
    {
        $id=$_REQUEST['id'];
        $memorymodel= \frontend\models\SkillsMemories::find()->where(['memoid'=>$id])->one();        
        $result=array();         
        array_push($result, array('title'=>$memorymodel['title'], 'note'=>$memorymodel['note']));       
        echo json_encode($result);
    }
    public function actionDeletememory()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $memory= \frontend\models\SkillsMemories::findOne(['memoid'=>$id]);        
        $flag=$memory->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavelikings()
    {
        //$likingmodel= \frontend\models\SkillsLikings::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($likingmodel) && $likingmodel=="") 
        if($_POST['updatelike']!="")
            $likingmodel=  \frontend\models\SkillsLikings::find()->where(['likeid'=>$_POST['updatelike']])->one();
        else{
            $likingmodel= new \frontend\models\SkillsLikings();
        }            
        
        if ($likingmodel->load(\Yii::$app->request->post())) {
            $likingmodel->userid=\Yii::$app->user->identity->id;            
            if($likingmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateliking()
    {
        $id=$_REQUEST['id'];
        $likingmodel= \frontend\models\SkillsLikings::find()->where(['likeid'=>$id])->one();        
        $result=array();         
        array_push($result, array('title'=>$likingmodel['title'], 'note'=>$likingmodel['note']));       
        echo json_encode($result);
    }
    public function actionDeleteliking()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $liking= \frontend\models\SkillsLikings::findOne(['likeid'=>$id]);        
        $flag=$liking->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavedislike()
    {
        //$dislikemodel= \frontend\models\SkillsDislike::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($dislikemodel) && $dislikemodel=="")
        if($_POST['updatedislike']!="")
            $dislikemodel=  \frontend\models\SkillsDislike::find()->where(['id'=>$_POST['updatedislike']])->one();
        else{
            $dislikemodel= new \frontend\models\SkillsDislike();
        }           
        
        if ($dislikemodel->load(\Yii::$app->request->post())) {
            $dislikemodel->userid=\Yii::$app->user->identity->id;            
            if($dislikemodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatedislike()
    {
        $id=$_REQUEST['id'];
        $dislikemodel= \frontend\models\SkillsDislike::find()->where(['id'=>$id])->one();        
        $result=array();         
        array_push($result, array('title'=>$dislikemodel['title'], 'note'=>$dislikemodel['note']));       
        echo json_encode($result);
    }
    public function actionDeletedislike()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $dislike= \frontend\models\SkillsDislike::findOne(['id'=>$id]);        
        $flag=$dislike->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavebelongings()
    {
        //$belongingmodel= \frontend\models\SkillsBelongings::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($belongingmodel) && $belongingmodel=="")
        if($_POST['updatebelong']!="")
            $belongingmodel=  \frontend\models\SkillsBelongings::find ()->where(['id'=>$_POST['updatebelong']])->one ();
        else{
            $belongingmodel= new \frontend\models\SkillsBelongings();
        }            
        
        if ($belongingmodel->load(\Yii::$app->request->post())) {
            $belongingmodel->userid=\Yii::$app->user->identity->id; 
                       
            $uploadedFile= UploadedFile::getInstance($belongingmodel,'image');  
            //var_dump($uploadedFile);
            
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ))
           {
               $fileName = $uploadedFile;  //  file name
               $belongingmodel->image = $fileName->name;     
           }
           else{
               $belongingmodel->image= \frontend\models\SkillsBelongings::findOne($belongingmodel->id)->image;
           }
           //var_dump($testmodel->attributes);
           
            if($belongingmodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $belongingmodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/belongingimg/'. $belongingmodel->id.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/belongingimg/
                 }
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatebelonging()
    {
        $id=$_REQUEST['id'];
        $belongingmodel= \frontend\models\SkillsBelongings::find()->where(['id'=>$id])->one();
        $result=array();         
        array_push($result, array('title'=>$belongingmodel['title'], 'note'=>$belongingmodel['note']));       
        echo json_encode($result);
    }
    public function actionDeletebelonging()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $belonging= \frontend\models\SkillsBelongings::findOne(['id'=>$id]);
        $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'subscriberimg'.DIRECTORY_SEPARATOR.'belongingimg'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$belonging->image;       
        unlink($filepath);           //to delete file from folder
        $flag=$belonging->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }  
    /**********************************************************************************************************************************/
    public function actionSaveidols()
    {
        //$idolmodel= \frontend\models\SkillsIdols::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($idolmodel) && $idolmodel=="") 
        if($_POST['updateidol']!="")
            $idolmodel=  \frontend\models\SkillsIdols::find()->where(['id'=>$_POST['updateidol']])->one ();
        else{
            $idolmodel= new \frontend\models\SkillsIdols();
        }            
        
        if ($idolmodel->load(\Yii::$app->request->post())) {
            $idolmodel->userid=\Yii::$app->user->identity->id;            
            if($idolmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdateidol()
    {
        $id=$_REQUEST['id'];
        $idolmodel= \frontend\models\SkillsIdols::find()->where(['id'=>$id])->one();        
        $result=array();         
        array_push($result, array('name'=>$idolmodel['name']));       
        echo json_encode($result);
    }
    public function actionDeleteidol()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $idol= \frontend\models\SkillsIdols::findOne(['id'=>$id]);        
        $flag=$idol->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavetraveldetails()
    {
        //$travelmodel= \frontend\models\SkillsTravelDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($travelmodel) && $travelmodel=="") 
        if($_POST['updatetravel']!="")
            $travelmodel=  \frontend\models\SkillsTravelDetails::find()->where(['trid'=>$_POST['updatetravel']])->one();
        else{
            $travelmodel= new \frontend\models\SkillsTravelDetails();
        }            
        
        if ($travelmodel->load(\Yii::$app->request->post())) {
            $travelmodel->userid=\Yii::$app->user->identity->id;            
            if($travelmodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatetravel()
    {
        $id=$_REQUEST['id'];
        $travelmodel= \frontend\models\SkillsTravelDetails::find()->where(['trid'=>$id])->one();        
        $result=array();         
        array_push($result, array('place'=>$travelmodel['place'], 'year'=>$travelmodel['year'], 'description'=>$travelmodel['description']));       
        echo json_encode($result);
    }
    public function actionDeletetravel()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $travel= \frontend\models\SkillsTravelDetails::findOne(['trid'=>$id]);        
        $flag=$travel->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    } 
    /**********************************************************************************************************************************/
    public function actionSavesocialmedia()
    {
        //$socialmediamodel= \frontend\models\SkillsSocialmedia::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
        //if(!isset($socialmediamodel) && $socialmediamodel=="") 
        $socialmediamodel= new \frontend\models\SkillsSocialmedia();
        
        if ($socialmediamodel->load(\Yii::$app->request->post())) {
            $socialmediamodel->userid=\Yii::$app->user->identity->id;            
            if($socialmediamodel->save())
            {
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    /**********************************************************************************************************************************/
    public function actionSavemedia()
    {
        //$mediamodel= \frontend\models\SkillsMedia::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
       // if(!isset($mediamodel) && $mediamodel=="") 
        if($_POST['updatemedia']!="")
            $mediamodel= \frontend\models\SkillsMedia::find()->where(['mid'=>$_POST['updatemedia']])->one();
        else{
            $mediamodel= new \frontend\models\SkillsMedia();
        }          
        
        if ($mediamodel->load(\Yii::$app->request->post())) {
            $mediamodel->userid=\Yii::$app->user->identity->id; 
                       
            $uploadedFile= UploadedFile::getInstance($mediamodel,'image');  
            //var_dump($uploadedFile);
            
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ))
           {
               $fileName = $uploadedFile;  //  file name
               $mediamodel->image = $fileName->name;     
           }
           else{
               $mediamodel->image= \frontend\models\SkillsMedia::findOne($mediamodel->mid)->image;
           }
           //var_dump($testmodel->attributes);
           
            if($mediamodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $mediamodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/mediaimg/'. $mediamodel->mid.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/mediaimg/
                 }
                echo 1;
            }
            else {
                echo 0;
            }            
        } else { 
            $this->actionFetch();            
        }
    }
    public function actionUpdatemedia()
    {
        $id=$_REQUEST['id'];
        $mediamodel= \frontend\models\SkillsMedia::find()->where(['mid'=>$id])->one();
        $result=array();         
        array_push($result, array('title'=>$mediamodel['title'], 'note'=>$mediamodel['note'], 'link'=>$mediamodel['link']));       
        echo json_encode($result);
    }
    public function actionDeletemedia()
    {
        $id=$_REQUEST['id'];
        $flag=false;
        $media= \frontend\models\SkillsMedia::findOne(['mid'=>$id]);
        $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'subscriberimg'.DIRECTORY_SEPARATOR.'mediaimg'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$media->image;       
        unlink($filepath);           //to delete file from folder
        $flag=$media->delete();
        if($flag)
        {
            echo "Your record is deleted successfully.";
        }
        else{
            echo "Deletion is failed due to some error.";
        }
    }
    /*  public function actionTest()
    {
         $testmodel= new \frontend\models\SkillsTestimonials();
         
         if ($testmodel->load(\Yii::$app->request->post())) {
            // var_dump($_POST);
             $testmodel->userid=\Yii::$app->user->identity->id;     
             $uploadedFile= UploadedFile::getInstance($testmodel,'image');  
           // var_dump($uploadedFile);
        
            if(($uploadedFile!== null && $uploadedFile!=='' 
                   && $uploadedFile->size !== 0 ) )
           {
               $fileName = $uploadedFile;  //  file name
               $testmodel->image = $fileName->name;     
           }
           //var_dump($testmodel->attributes);
             if($testmodel->save())
            {
                if(($uploadedFile!= null && $uploadedFile!='' ) || $testmodel->isNewRecord)
                {
                     $fileSavePath=\Yii::$app->basePath. '/../subscriberimg/testimonialimg/'. $testmodel->testid.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/subscriberimg/testimonialimg/
                 }
                echo 1;
            }
            else {
                echo 0;
            }    
         }
         else{
            return $this->render('index', ['testmodel'=> $testmodel]);
         }
    } */
}
