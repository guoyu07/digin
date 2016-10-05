<?php

namespace frontend\controllers;

use Yii;
use backend\models\VendorCurrencySetting;
use backend\models\VendorCurrencySettingSearch;
use backend\models\Vendor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendorCurrencySettingController implements the CRUD actions for VendorCurrencySetting model.
 */
class VendorCurrencySettingController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VendorCurrencySetting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorCurrencySettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VendorCurrencySetting model.
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
     * Creates a new VendorCurrencySetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VendorCurrencySetting();
        $mdlvendor = new Vendor();
        
        $searchModel = new VendorCurrencySettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $uid = \yii::$app->user->identity->id;
        $venid = Vendor::find()->where(['user_id'=>$uid])->one();
        $model->base_currency = $venid['currencycode'];
        
         
        if ($model->load(Yii::$app->request->post())) {
             
            try {
                $this->saveModel(array(
                        'model' => $model,
                        'mdlvendor' => $mdlvendor,
                        
                    ));
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            //$this->redirect(['index']); 
        } else {
            return $this->render('create', [
                'model' => $model,
                'mdlvendor' => $mdlvendor,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    
    
    
    public function saveModel(array $modelarray)
    {
         $model = $modelarray['model'];
        //$vid = $_GET['id'];
       $uid = \yii::$app->user->identity->id;
       $venid = Vendor::find()->where(['user_id'=>$uid])->one();
       $connection = Yii::$app->db;
       $transaction = $connection->beginTransaction();
       $countpresenrecord = \backend\models\VendorCurrencySetting::findOne(['base_currency'=>$modelarray['model']['base_currency'],'currency'=>$modelarray['model']['currency'],'vid'=>$venid['vid']]);
       $count = sizeof($countpresenrecord);
     
       
       if(!isset($countpresenrecord)){
              
           if($model->isNewRecord){
             $model = new VendorCurrencySetting();
             $model->vid = $venid['vid'];
             $model->base_currency = $modelarray['model']['base_currency'];
             $model->country = $modelarray['model']['country'];
             $model->currency = $modelarray['model']['currency'];
             $model->currency_rate = $modelarray['model']['currency_rate'];
             $model->percentaddition = $modelarray['model']['percentaddition'];
             }
       }
     
       $succs = $model->save();
      //var_dump($model->getErrors());
      
       $result = $model->applyCurrencySetting($modelarray['model']['country'],$modelarray['model']['currency'],$modelarray['model']['currency_rate'],$modelarray['model']['percentaddition']);
       
     if($succs) 
            {
                $transaction->commit();
                echo 1;                
           }
            else{
                $transaction->rollBack();
               echo 0;                
            }  
       
       
  }

    /**
     * Updates an existing VendorCurrencySetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uid = \yii::$app->user->identity->id;
        $venid = Vendor::find()->where(['user_id'=>$uid])->one();
//        $model->vid = $venid['vid'];
        //var_dump($venid['currencycode']);
        $model->base_currency = $venid['currencycode'];
        
        $mdlvendor = new Vendor();
        $searchModel = new VendorCurrencySettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //var_dump($_POST);
        
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $this->saveModel(array('model'=>$model));
            
        } 
        else {
            return $this->render('update', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'mdlvendor' => $mdlvendor,
            ]);
        }
    }

    /**
     * Deletes an existing VendorCurrencySetting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['vendor-currency-setting/create','id'=>$id]);
        //return $this->redirect(['index']);
    }

    /**
     * Finds the VendorCurrencySetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VendorCurrencySetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VendorCurrencySetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetcode()  {   
       
        $id=$_POST['curcode'];                 
        
        $data= \backend\models\CountryCurrency::find()->where(['country_id'=>$id])->one();
        $currcode = \backend\models\Currency::findOne(['id'=>$data['currency_id']]);
       if($currcode['currency_code']!=""){
        return $currcode['currency_code'];
       }else{
         return 'None';
       }
    }
}
