<?php

namespace backend\controllers;

use Yii;
use backend\models\ZoneCities;
use backend\models\ZoneCitiesSearch;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZoneCitiesController implements the CRUD actions for ZoneCities model.
 */
class ZoneCitiesController extends Controller
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
     * Lists all ZoneCities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZoneCitiesSearch();       

        $dpid= Yii::$app->request->get('id'); 
        if(isset($dpid) && $dpid!=""){
             $dataProvider = $searchModel->searchBydp(Yii::$app->request->queryParams, $dpid);
        }else{
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ZoneCities model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function saveModel($modelarray)
    {
        $model=$modelarray['model'];
        $connection = Yii::$app->db;
        $success=false;
        
        if(isset($_POST['ZoneCities']['cityarray'])){
                $model->cityarray=$_POST['ZoneCities']['cityarray']; 
            }        
         $transaction = $connection->beginTransaction();
             //Delete all the zone cities before saving new.        
            ZoneCities::deleteAll(['zid'=>$model->zid]);         
            if(isset($model->cityarray) && $model->cityarray!=''){
            foreach($model->cityarray as $c)
            {
                 $zc=  ZoneCities::find()->where(['cityid'=>$c])->one();
                 if($zc==""){
                    $zc=new ZoneCities();                    
                 }
                 $zc->zid=$model->zid;
                 $zc->dpid=$model->dpid;
                 $zc->cityid=$c; 
                 //var_dump($zc->attributes);
                 $success=$zc->save();
            }
            }
            if($success)
            {
                $transaction->commit();
                return $this->redirect(['index']);
            }
            else{
                $transaction->rollBack();
                return $this->render('create', [
                'model' => $model,
                ]);
            }
    }
    /**
     * Creates a new ZoneCities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ZoneCities();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
            try {               
                $this->saveModel(array('model'=>$model));
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }                
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ZoneCities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $zonecitis= ZoneCities::find()->where(['zid'=>$model->zid])->all();            
        foreach ($zonecitis as $z){
            array_push($model->cityarray, $z['cityid']);      
        }
        
        $citis=  implode(',', $model->cityarray);
      
        if($citis!=''){
        $cities = \frontend\models\Cities::findBySql("select id, name from cities where id IN(" . $citis . ")")->all();
        $cityData = ArrayHelper::map($cities, 'id', 'name');
        }
        //var_dump($cityData);
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
           try {               
                $this->saveModel(array('model'=>$model));
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }    
        } else {
            return $this->render('update', [
                'model' => $model,
                'cityData' => $cityData,
            ]);
        } 
    }

    /**
     * Deletes an existing ZoneCities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        
        $zones= ZoneCities::deleteAll(['zid'=>$model->zid]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the ZoneCities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ZoneCities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ZoneCities::findOne($id)) !== null) {
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
