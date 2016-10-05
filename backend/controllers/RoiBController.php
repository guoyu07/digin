<?php

namespace backend\controllers;

use Yii;
use backend\models\RoiB;
use backend\models\RoiBSearch;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoiBController implements the CRUD actions for RoiB model.
 */
class RoiBController extends Controller
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
     * Lists all RoiB models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoiBSearch();
        
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
     * Displays a single RoiB model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    /** saves Roi B model      
     * @param type $modelarray
     * @return success value
     */
    public function saveModel($modelarray)
    {
        $model=$modelarray['model'];
        $connection = Yii::$app->db;
        $success=false;
        
        if(isset($_POST['RoiB']['cityarray'])){
                $model->cityarray=$_POST['RoiB']['cityarray']; 
            }
            //var_dump($model->cityarray);
         $transaction = $connection->beginTransaction();
         RoiB::deleteAll(['dpid'=>$model->dpid]);
            if(isset($model->cityarray) && $model->cityarray!=''){
            foreach($model->cityarray as $c)
            {      
                 $rb=new RoiB();            
                 $rb->dpid=$model->dpid;                 
                 $rb->cityid=$c;                
                 $success=$rb->save();
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
     * Creates a new RoiB model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RoiB();

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
     * Updates an existing RoiB model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $deliverypt= RoiB::find()->where(['dpid'=>$model->dpid])->all();            
        foreach ($deliverypt as $d){
            array_push($model->cityarray, $d['cityid']);      
        }
        $citis=  implode(',', $model->cityarray);
        if($citis!=''){
        $cities = \frontend\models\Cities::findBySql("select id, name from cities where id IN(" . $citis . ")")->all();
        $cityData = ArrayHelper::map($cities, 'id', 'name');
        }
        
        if ($model->load(Yii::$app->request->post()) ) {
           // return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing RoiB model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        
        $roibs= RoiB::deleteAll(['dpid'=>$model->dpid]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the RoiB model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RoiB the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoiB::findOne($id)) !== null) {
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
