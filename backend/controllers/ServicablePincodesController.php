<?php

namespace backend\controllers;

use Yii;
use backend\models\ServicablePincodes;
use backend\models\ServicablePincodesSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServicablePincodesController implements the CRUD actions for ServicablePincodes model.
 */
class ServicablePincodesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ServicablePincodes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicablePincodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServicablePincodes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function saveModel(array $modelarray) {
           $model=$modelarray['model'];        
           $success = false;
           $file=$model->excelfile;
           
          //var_dump($_POST['Pincode']['pincodenew']);
        if(isset($_POST['ServicablePincodes']['pincodenew']) && $_POST['ServicablePincodes']['pincodenew']!=''){
              $model->pincodenew = $_POST['ServicablePincodes']['pincodenew'];
              ServicablePincodes::deleteAll(['cityid'=>$model->cityid]);
              if(isset($model->pincodenew) && $model->pincodenew!=""){
              foreach ($model->pincodenew as $p) {
                  $pncd=new \backend\models\ServicablePincodes(); 
                  $pncd->cityid = $model->cityid;
                  //$pncd->cityid = 0;
                  $pncd->pincode = $p;   
                  $success=$pncd->save();
              }
            }
          }
          else{
              //echo 'hi m in import page....'; 
        $uploadedFile = UploadedFile::getInstance($model, 'excelfile');
        if(($uploadedFile!== null && $uploadedFile!=='' 
                && $uploadedFile->size !== 0 ) 
                || $model->isNewRecord)
        {
           $fileName = $uploadedFile;  //  file name
            //$model->logo = $fileName;
           $fileSavePath = Yii::$app->basePath . '/servicepincode/';
                if (!file_exists($fileSavePath)) {
                    mkdir($fileSavePath, 0755, true);
                }
          $uploadedFile->saveAs($fileSavePath . $fileName);
             
          $importfile=Yii::$app->basePath.'/servicepincode/' .$fileName;
          $data = \moonland\phpexcel\Excel::import($importfile); //  $config   $config is an optional

           //var_dump($data); 
          // var_dump($model->cityid);
           //echo 'hi m in import page....';
        }
       // echo $_POST['Vendor']['franchexecutive'];   
         $msgarr = array();
         $missingcity = array();
           foreach ($data as $dt){
               $pn=new \backend\models\ServicablePincodes();            
              
               $cityname = "%".$dt['city']."%";
               $statename = "%".$dt['state']."%";
               $cityid = \frontend\models\Cities::find()->where('name LIKE :query')
                                                       ->addParams([':query'=>$cityname])->one();
               $stateid = \frontend\models\States::find()->where('name LIKE :query')
                                                       ->addParams([':query'=>$statename])->one();
               
               if($cityid['state_id']==$stateid['id']){
                   $pn->dpid=$model->dpid;
                   $pn->pincode = $dt['pincode'];
                   if(isset($cityid) && $cityid!=''){
                   $pn->cityid = $cityid['id'];
                   }
                 //  $vl->state = $stateid['id'];
                  $success=$pn->save();
                
               }else{
                   if($cityid['name']==NULL){
                       if(!in_array($dt['city'], $missingcity)){
                          array_push($missingcity, $dt['city']);  
                    }
                }
                  //var_dump(sizeof($cityid));
                  //var_dump(sizeof($stateid));
                  // array_push($msgarr, array('pincode'=>$dt['pincode'], 'state'=>$stateid['name'], 'city'=>$cityid['name']));  
                  
                   //var_dump(sizeof($msgarr));
                   
            }
               $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'servicepincode'.DIRECTORY_SEPARATOR.$fileName;       
                 if (file_exists($filepath)) {
                    unlink($filepath);
                 } 
                   
          }         
           //var_dump($missingcity);
          } 
          
          return $missingcity;     
       // var_dump($success);
       
       /*    if($success)
           {
              
               \Yii::$app->session->setFlash('info', 'Save successfully.'); 
               $this->redirect(['index']);   
          }else{
                return $this->render('create', [
                'model' => $model,              
            ]);
           } 
           */
                
    
   } 
   
    
    
    /**
     * Creates a new ServicablePincodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServicablePincodes();

        if ($model->load(Yii::$app->request->post()) ) {
            //return $this->redirect(['view', 'id' => $model->pinid]);
             try {
                $result=$this->saveModel(array(
                        'model' => $model,                                     
                    ));
               $searchModel = new ServicablePincodesSearch();
               $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

              return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                 'result' => $result, 
             ]); 
                // get uploaded file name to save the pincode model
            } catch (Exception $e) {
                //$transaction->rollBack();
                throw $e;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServicablePincodes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         $pncodedata= ServicablePincodes::find()->where(['cityid'=>$model->cityid])->all();            
        foreach ($pncodedata as $p){
            array_push($model->pincodenew, $p['pincode']);      
        }
        $pins=  implode(',', $model->pincodenew);
        if($pins!=''){
        $pinsid = \backend\models\ServicablePincodes::findBySql("select pincode from servicable_pincodes where pincode IN(" . $pins . ")")->all();
        $pinData = ArrayHelper::map($pinsid, 'pincode', 'pincode');
        }
        
        if ($model->load(Yii::$app->request->post()) ) {
            //return $this->redirect(['view', 'id' => $model->pinid]);
            try {
                $result=$this->saveModel(array(
                        'model' => $model,                                     
                    ));
               $searchModel = new ServicablePincodesSearch();
               $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

              return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                 'result' => $result, 
             ]); 
                // get uploaded file name to save the pincode model
            } catch (Exception $e) {
                //$transaction->rollBack();
                throw $e;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'pinData'=> $pinData,
            ]);
        }
    }

    /**
     * Deletes an existing ServicablePincodes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServicablePincodes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServicablePincodes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServicablePincodes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetcity()
    {
        
        $state=$_POST['stateid'];                 
        
        $data= \frontend\models\Cities::find()
                 ->select(['id', 'name'])                 
                 ->where(['state_id'=>$state])                
                 ->all();        
        $cityresult=array();
        foreach ($data as $dt)
        {
            array_push($cityresult, array('id'=>$dt['id'], 'name'=>$dt['name']));  
        }
        echo json_encode($cityresult);
        
    }
}
