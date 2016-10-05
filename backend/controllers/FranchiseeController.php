<?php

namespace backend\controllers;

use Yii;
use backend\models\Franchisee;
use backend\models\FranchiseeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FranchiseeController implements the CRUD actions for Franchisee model.
 */
class FranchiseeController extends Controller
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
     * Lists all Franchisee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FranchiseeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Franchisee model.
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
     * Creates a new Franchisee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Franchisee();
        $modeladdress = new \backend\models\Address();
        

        if ($model->load(Yii::$app->request->post()) && $modeladdress->load(\Yii::$app->request->post()) ) {
           // return $this->redirect(['view', 'id' => $model->frid]);
            
           //var_dump($modeladdress->attributes);
           try {
                               
                $this->saveAllModels(array('model'=>$model,
                                           'modeladdress'=>$modeladdress));
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }                  
            
        } 
        else 
        {      
            return $this->render('create', [
              'model' => $model,
              'modeladdress'=>$modeladdress,
            ]);
        }      
    }

   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modeladdress = \backend\models\Address::find()->where(['adrid'=>$model->adrid])->one();
     
        $datearray = [$model->fromdate,$model->todate];
        $model->daterange = implode('_', $datearray); 
     
        if ($model->load(Yii::$app->request->post()) && $modeladdress->load(\Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->frid]);
              $this->saveAllModels(array('model'=>$model,
                                       'modeladdress'=>$modeladdress));
        } else {
            return $this->render('update', [
                'model' => $model,
                'modeladdress' => $modeladdress,
            ]);
        }
    }
   public function saveAllModels($modelsArray)
    {
        $model=$modelsArray['model'];
        $modeladdress=$modelsArray['modeladdress'];  
        $connection = Yii::$app->db;
        $success=FALSE;  
        
         //$modeladdress->userid = 0;
        $modeladdress->name = $model->name;
        //var_dump($modeladdress->attributes);

       if(isset($_POST['Franchisee']['daterange']))
        {
            $fdate = $_POST['Franchisee']['daterange'];
            $daterange = explode('_',$fdate);
            $model->fromdate = $daterange[0];
            $model->todate = $daterange[1];
        }
         //todo check if uploaded
        $oldlogo=$model->idlogo;
        $uploadedFile = UploadedFile::getInstance($model, 'idlogo');

        
        if(($uploadedFile!== null && $uploadedFile!=='' 
                && $uploadedFile->size !== 0 ) 
                || $model->isNewRecord)
        {
            $fileName = $uploadedFile;  //  file name
            $model->idlogo = $fileName;
        }
        else
        {
            $model->idlogo=Franchisee::findOne($model->frid)->idlogo;
        }
        
        
         $transaction = $connection->beginTransaction();
         if($modeladdress->save())
         {
            
             $model->adrid = $modeladdress->adrid;
             $success=$model->save();
         
          if($success)
             {
               if(($uploadedFile!= null && $uploadedFile!='' ) 
                || $model->isNewRecord)
             {
                $fileSavePath = Yii::$app->basePath . '/../images/franchiseeid/' . $model->frid . '/';
                if (!file_exists($fileSavePath)) {
                    mkdir($fileSavePath, 0755, true);
                }
                $uploadedFile->saveAs($fileSavePath . $fileName);
             }
               $transaction->commit();
               return $this->redirect(['index']);
             }else{
                 $transaction->rollBack();
                 return $this->render('create', [
                 'model' => $model,
                 'modeladdress'=>$modeladdress,
                  ]);
             }
         }else
         {
              return $this->render('create', [
              'model' => $model,
              'modeladdress'=>$modeladdress,
            ]);
         } 
    }
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $modeladdress = \backend\models\Address::find()->where(['adrid'=>$model->adrid])->one();  
        if($modeladdress->delete()){
                $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Franchisee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Franchisee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Franchisee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCheck()
    {
        $code=$_POST['code'];        
        $franchiseedata= Franchisee::find()->where(['code'=>$code])->all();
       //var_dump(sizeof($franchiseedata));      
        if(sizeof($franchiseedata)==1)
        {
            echo "Code already exists";
        }
        else {
            echo "Code is available";
        }        
    }

  public function actionImport()
   {
       
         return $this->render('importfile');
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
    
   public function actionGetstate()
    {
        $country=$_POST['countryid'];                 
        
        $data= \frontend\models\States::find()
                 ->select(['id', 'name'])                 
                 ->where(['country_id'=>$country])                
                 ->all();        
        $stateresult=array();
        foreach ($data as $dt)
        {
            array_push($stateresult, array('id'=>$dt['id'], 'name'=>$dt['name']));  
        }
        echo json_encode($stateresult);
        
    }
    
}
