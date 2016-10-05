<?php

namespace frontend\controllers;
use yii\helpers\ArrayHelper;

class ViewallController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
  public function actionViewalluser()
    {
      
      
       $user= \dektrium\user\models\User::find()->where(['id'=>\Yii::$app->user->identity->id])->one();
       $commondetailmodel= \frontend\models\SkillCommonDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
       $reg=  \frontend\models\SkillsReligion::find()->where(['regid'=> $commondetailmodel['religionid']])->one();
       $cast=  \frontend\models\SkillsCast::find()->where(['castid'=> $commondetailmodel['castid']])->one();
       $faith= \frontend\models\SkillsFaith::find()->where(['faithid'=> $commondetailmodel['faithid']])->one();
       
      $userskillmdl=\frontend\models\UserSkills::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $usrskllmd = array();
      $usrskllmdnew = array();
      foreach ($userskillmdl as $usersklmdl) {
      $skill=  \frontend\models\Skills::find()->select('skill')->where(['sid'=> $usersklmdl['skillid']])->one();
      $usrskllmdnew['skill']=$skill['skill'];
      $usrskllmdnew['description'] = $usersklmdl['description'];
      array_push($usrskllmd,$usrskllmdnew);
      }
      
      $consultantmodel=  \frontend\models\SkillsConsultants::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $testmodel=  \frontend\models\SkillsTestimonials::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $usrdetail = \backend\models\UserDetail::find()->where(['user_id'=>  \yii::$app->user->identity->id])->one();
      
      
       $parentsmodel=  \frontend\models\SkillsParents::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
       $sibblingmodel=  \frontend\models\SkillsSibblings::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
       $spousemodel=  \frontend\models\SkillsSpouse::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
      
       $educationmodel=  \frontend\models\SkillsEducation::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
       
       $healthmodel=  \frontend\models\SkillsHealthdetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
       $physicianmodel=  \frontend\models\SkillsPhysicians::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
       $diesiesmdl= \frontend\models\SkillsDiseases::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      
       
       $govidmodel=  \frontend\models\SkillsGovernmentIds::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
       $passportmodel=  \frontend\models\SkillsPassport::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
       
       $govdocnm = array();
       $govdocnew= array();
       foreach ($govidmodel as $gov){
            $govdocmodel= \frontend\models\GovernDocumentType::find()->select('doc_name')->where(['id'=> $gov['gid']])->one();
            $govdocnew['doc_name']=$govdocmodel['doc_name'];
            $govdocnew['govern_no']=$gov['govern_no'];
           array_push($govdocnm, $govdocnew);  
       }
      // var_dump($govdocnm);
      $vehiclemodel=  \frontend\models\SkillsVehicles::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $userdetailmodel=  \backend\models\UserDetail::find()->where(['user_id'=>\Yii::$app->user->identity->id])->one();
      $skillachivement = \frontend\models\SkillsAchievements::find()->where(['userid'=>\yii::$app->user->identity->id])->one();
      $skillmodel= \frontend\models\UserSkills::find()->where(['userid'=>\yii::$app->user->identity->id])->all();
      
      $userhbymdl=  \frontend\models\UserHobbies::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $hbarry= array();
      foreach ($userhbymdl as $usrhb){
      $hbby = \frontend\models\SkillsHobbies::find()->select('hobby')->where(['hbid'=> $usrhb['hobbyid']])->one();
         array_push($hbarry, $hbby);  
      }
      
      $planmodel= \frontend\models\SkillsPlans::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $creationmodel= \frontend\models\SkillsCreations::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $achievementmodel= \frontend\models\SkillsAchievements::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $philosophymodel= \frontend\models\SkillsPhilosophy::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $memorymodel= \frontend\models\SkillsMemories::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
       
      $likingmodel= \frontend\models\SkillsLikings::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $dislikemodel= \frontend\models\SkillsDislike::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $belongingmodel= \frontend\models\SkillsBelongings::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $idolmodel= \frontend\models\SkillsIdols::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $travelmodel= \frontend\models\SkillsTravelDetails::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $socialmediamodel= \frontend\models\SkillsSocialmedia::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $mediamodel= \frontend\models\SkillsMedia::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      
      $investmodel=  \frontend\models\SkillsInvestment::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      $bankmodel=  \frontend\models\SkillsBanks::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
      
      $occupationmodel= \frontend\models\SkillsOccupation::find()->where(['userid'=>\Yii::$app->user->identity->id])->all();
     
              
              return $this->render('viewall',
               
                  ['skillsmodel'=>$skillmodel,
                    'user' => $user,
                   'sklachivemntmodel'=>$skillachivement,
                   'commondetailmodel' => $commondetailmodel,
                   'userdetailmodel' => $userdetailmodel,
                      
                   'religion'=> $reg,
                   'cast'=> $cast,
                   'faith'=>$faith,
                   
                   'skill'=>$skill,
                      
                   'parentsmodel'=>$parentsmodel,
                   'sibblingmodel' => $sibblingmodel,
                   'spousemodel' => $spousemodel,
                      
                   'educationmodel' => $educationmodel,
                      
                   'physicianmodel' => $physicianmodel,
                   'healthmodel' => $healthmodel,
                   'diesiesmdl'=> $diesiesmdl,
                      
                    //'govdocmodel' => $govdocmodel,
                    'govidmodel' => $govidmodel,
                    'passportmodel' => $passportmodel,
                    'govdocmodel'=> $govdocmodel,
                     'govdocnm' => $govdocnm,
                     'vehiclemodel'=> $vehiclemodel,
                     'hbarry'=> $hbarry,
                     'planmodel'=> $planmodel,
                      'creationmodel'=> $creationmodel,
                      'achievementmodel'=> $achievementmodel,
                      'philosophymodel' => $philosophymodel,
                      'memorymodel' => $memorymodel,
                      'likingmodel' => $likingmodel,
                      'dislikemodel' => $dislikemodel,
                      'belongingmodel' => $belongingmodel,
                      'idolmodel' => $idolmodel,
                      'travelmodel' => $travelmodel,
                      'socialmediamodel' => $socialmediamodel,
                      'mediamodel' => $mediamodel,
                      'investmodel' => $investmodel,
                      'bankmodel' => $bankmodel,
                      'occupationmodel' => $occupationmodel,
                      'usrskllmd' => $usrskllmd,
                      'usrskllmd'=> $usrskllmd,
                      'consultantmodel' =>$consultantmodel,
                      'testmodel'=>$testmodel,
                      'usrdetail' =>$usrdetail,
                   ]);
               //var_dump($commondetailmodel['castid']);
     // var_dump($skillmodel);
       // var_dump($skillachivement);
       
    }

}
