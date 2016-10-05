<?php

namespace backend\controllers;
use Yii;
use backend\models\ZoneCities;
use backend\models\ZoneCitiesSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UploadController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionImport()
    {
        $model = new ZoneCities();
        
        //$result=array();
        $success=false;
        if ($model->load(Yii::$app->request->post())) {
            //var_dump($_POST);
            try {
                $result=$this->saveModel(array(
                        'model' => $model,                                     
                    ));
                $success=true;
                //  var_dump($result);
              return $this->render('upload', [
                'model' => $model,
                'result' => $result, 
                'success' => $success,
             ]);  
            } catch (Exception $e) {
                //$transaction->rollBack();
                throw $e;
            }
        }
        else{
        return $this->render('upload', [
            'model' => $model,
            //'result' => $result,
            'success' => $success,
        ]);
        }
    }
    
    public function saveModel(array $modelarray) {
           $model=$modelarray['model'];        
           $success = false;
       
        $uploadedFile = UploadedFile::getInstance($model, 'excelfile');
        //var_dump($uploadedFile);
        if(($uploadedFile!== null && $uploadedFile!=='' 
                && $uploadedFile->size !== 0 ) 
                || $model->isNewRecord)
        {
           $fileName = $uploadedFile;  //  file name           
           $fileSavePath = Yii::$app->basePath . '/upload/';
                if (!file_exists($fileSavePath)) {
                    mkdir($fileSavePath, 0755, true);
                }
          $uploadedFile->saveAs($fileSavePath . $fileName);
             
          $importfile=Yii::$app->basePath.'/upload/' .$fileName;
          $data = \moonland\phpexcel\Excel::import($importfile); //  $config   $config is an optional
        } 
        //var_dump($data);
        //echo $model->dpid;
        $missing=array();
         $missingcity = array();
         $missingstates =array();
         $count=0;
           foreach ($data as $dt){
               $mdlzonecity= new ZoneCities();
               $mdlmetro= new \backend\models\Metro();
               $mdlroia= new \backend\models\RoiA();
               $mdlroib= new \backend\models\RoiB();
               $mdlspldest= new \backend\models\Specialdestination(); 
                             
               $cityname = "%".trim($dt['city'])."%";                 
               $statename = "%".trim($dt['state'])."%";                         
               $zonename = "%".trim($dt['zone'])."%";
               
               $cityid = \frontend\models\Cities::find()->where('name LIKE :query')
                                                       ->addParams([':query'=>$cityname])->one();
               $stateid = \frontend\models\States::find()->where('name LIKE :query')
                                                       ->addParams([':query'=>$statename])->one();
               $zoneid=  \backend\models\Zone::find()->where('name LIKE :query')
                                                       ->addParams([':query'=>$zonename])->one();
               if($cityid['state_id']==$stateid['id'] || $cityid!=""){    // try to do.. && $cityid!=null
                   $mdlzonecity->zid=$zoneid['zid'];
                   $mdlzonecity->dpid=$model->dpid;
                   $mdlzonecity->cityid=$cityid['id'];
                   $mdlzonecity->save();
                   if($dt['city_category']=='METRO'){
                       $mdlmetro->dpid=$model->dpid;
                       $mdlmetro->cityid=$cityid['id'];
                       $mdlmetro->save();
                   }
                   if($dt['city_category']=='ROI-A'){
                       $mdlroia->dpid=$model->dpid;
                       $mdlroia->cityid=$cityid['id'];
                       $mdlroia->save();
                   }
                   if($dt['city_category']=='ROI-B'){
                       $mdlroib->dpid=$model->dpid;
                       $mdlroib->cityid=$cityid['id'];
                       $mdlroib->save();
                   }
                   if($dt['city_category']=='SPECIAL DESTINATION'){
                       $mdlspldest->dpid=$model->dpid;
                       $mdlspldest->cityid=$cityid['id'];
                       $mdlspldest->save();
                   }                
               }else{
                   $count=$count+1;
                   //if($cityid['name']==NULL){
                       if(!in_array($dt['city'], $missingcity)){
                          array_push($missingcity, $dt['city']);  
                   // }
                }
                if($stateid==""){
                 if(!in_array($dt['state'], $missingstates))
                         array_push($missingstates, $dt['state']); 
                }                                                      
            }  
            $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.$fileName;       
            if (file_exists($filepath)) {
                  unlink($filepath);
            } 
                
          }
          //var_dump($missingcity);
          array_push($missing, $missingcity);
          array_push($missing, $missingstates);
          //array_push($missing, $count);
           //var_dump($missingcity);
           //var_dump($missingstates);
          return $missing;     
      
   } 
   
   public function actionExport()
   {       
       $expdata=array();
       //$data=array();
       
       $states=  \frontend\models\States::find()->all();
       $query=(new \yii\db\Query()) 
               ->select(['s.name as state', 'c.name as city', 'p.pincode as pin'])
               ->from('states s')
               ->join('inner join', 'cities c', 'c.state_id=s.id')
               ->join('inner join', 'pincode p', 'p.cityid=c.id')
               ->orderBy('state asc');
        $data=$query->all();
        foreach ($data as $dt){
            $exp=new \backend\models\Exportpin();
            $exp->state=$dt['state'];
            $exp->city=$dt['city'];
            $exp->pincode=$dt['pin'];
            array_push($expdata, $exp);
        }
        
        \moonland\phpexcel\Excel::widget([
        'models' => $expdata,    // here data of model is required..not only simple array
        'mode' => 'export', //default value as 'export'
        'columns' => ['state','city','pincode'], //without header working, because the header will be get label from attribute label.       
        ]);
        //return true;
      /* Above one query can be written separately as below,
       * foreach ($states as $st){
           $cities=  \frontend\models\Cities::find()->where(['state_id'=>$st['id']])->all();
           foreach ($cities as $ct){
               $pincodes=  \backend\models\Pincode::find()->where(['cityid'=>$ct['id']])->all();
               foreach ($pincodes as $p){
                   //$data=['State'=>$st['name'], 'City'=>$ct['name'], 'Pincode'=>$p['pincode']];
                   //array_push($expdata, $data);
                   $exp=new \backend\models\Exportpin();
                   $exp->state=$st['name'];
                   $exp->city=$ct['name'];
                   $exp->pincode=$p['pincode'];
                   array_push($expdata, $exp);
               }
           }
       }*/      
       //var_dump($expdata);
       
   }
}
