<?php

namespace backend\controllers;

use Yii;
use backend\models\Pincode;
use backend\models\PincodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * PincodeController implements the CRUD actions for Pincode model.
 */
class PincodeController extends Controller
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
     * Lists all Pincode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PincodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pincode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pincode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Pincode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // return $this->redirect(['view', 'id' => $model->pnid]);
             return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Pincode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionCreate()
    {        
        $model = new Pincode();
        
        if ($model->load(Yii::$app->request->post())) {
             //return $this->redirect(['index']);
           // return $this->redirect(['view', 'id' => $model->vlid]);
            
            try {
                $this->saveModel(array(
                        'model' => $model,
                                     
                    ));
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
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $pncodedata= Pincode::find()->where(['cityid'=>$model->cityid])->all();            
        foreach ($pncodedata as $p){
            array_push($model->pincodenew, $p['pincode']);      
        }
        $pins=  implode(',', $model->pincodenew);
        if($pins!=''){
        $pinsid = \backend\models\Pincode::findBySql("select pincode from pincode where pincode IN(" . $pins . ")")->all();
        $pinData = ArrayHelper::map($pinsid, 'pincode', 'pincode');
        }
        
        //var_dump($pinData);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // return $this->redirect(['view', 'id' => $model->pnid]);
             return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'pinData'=> $pinData,
            ]);
        }
    }

    /**
     * Deletes an existing Pincode model.
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
     * Finds the Pincode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pincode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
       public function saveModel(array $modelarray) {
           $model=$modelarray['model'];        
           $success = false;
            $file=$model->excelfile;
          //var_dump($_POST['Pincode']['pincodenew']);
        if(isset($_POST['Pincode']['pincodenew']) && $_POST['Pincode']['pincodenew']!=''){
              $model->pincodenew = $_POST['Pincode']['pincodenew'];
              Pincode::deleteAll(['cityid'=>$model->cityid]);
              if(isset($model->pincodenew) && $model->pincodenew!=""){
              foreach ($model->pincodenew as $p) {
                  $pncd=new \backend\models\Pincode(); 
                  $pncd->cityid = $model->cityid;
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
            $fileSavePath = Yii::$app->basePath . '/pincode/';
                if (!file_exists($fileSavePath)) {
                    mkdir($fileSavePath, 0755, true);
                }
          $uploadedFile->saveAs($fileSavePath . $fileName);
             
          $importfile=Yii::$app->basePath.'/pincode/';
          $data = \moonland\phpexcel\Excel::import($importfile); //  $config   $config is an optional

           //var_dump($data); 
          // var_dump($model->cityid);
           //echo 'hi m in import page....';
        }
       // echo $_POST['Vendor']['franchexecutive'];   
         
           foreach ($data as $dt){
               $vl=new \backend\models\Pincode();            
               $vl->pincode = $dt['pincode'];
               $vl->cityid = $model->cityid;
            //var_dump($model->attributes);            
               $success=$vl->save();
               
              
                    //echo 'file deleted..';
                 }
          } 
        //var_dump($success);
       
           if($success)
           {
                $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'pincode'.DIRECTORY_SEPARATOR.$fileName;       
                 if (file_exists($filepath)) {
                    unlink($filepath);
               \Yii::$app->session->setFlash('info', 'Save successfully.'); 
               $this->redirect(['index']);   
          }else{
                return $this->render('create', [
                'model' => $model,              
            ]);
           } 
           }     
    
   } 
   
    protected function findModel($id)
    {
        if (($model = Pincode::findOne($id)) !== null) {
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
