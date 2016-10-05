<?php

namespace backend\controllers;

use Yii;
use backend\models\Metro;
use backend\models\MetroSearch;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MetroController implements the CRUD actions for Metro model.
 */
class MetroController extends Controller
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
     * Lists all Metro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MetroSearch();        

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
     * Displays a single Metro model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
   
    /** saves Metro model      
     * @param type $modelarray
     * @return success value
     */
    public function saveModel($modelarray)
    {
        $model=$modelarray['model'];
        $connection = Yii::$app->db;
        $success=false;
        
        if(isset($_POST['Metro']['cityarray'])){
                $model->cityarray=$_POST['Metro']['cityarray']; 
            }
            //var_dump($model->cityarray);
         $transaction = $connection->beginTransaction();
            Metro::deleteAll(['dpid'=>$model->dpid]);
            if(isset($model->cityarray) && $model->cityarray!=''){
            foreach($model->cityarray as $c)
            {      
                 $mt=new Metro();            
                 $mt->dpid=$model->dpid;                 
                 $mt->cityid=$c;                
                 $success=$mt->save();
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
     * Creates a new Metro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Metro();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->mid]);
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
     * Updates an existing Metro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $deliverypt= Metro::find()->where(['dpid'=>$model->dpid])->all();            
        foreach ($deliverypt as $d){
            array_push($model->cityarray, $d['cityid']);      
        }
        $citis=  implode(',', $model->cityarray);
        if($citis!=''){
        $cities = \frontend\models\Cities::findBySql("select id, name from cities where id IN(" . $citis . ")")->all();
        $cityData = ArrayHelper::map($cities, 'id', 'name');
        }
    
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->mid]);
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
     * Deletes an existing Metro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);

        $metros=  Metro::deleteAll(['dpid'=>$model->dpid]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Metro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Metro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Metro::findOne($id)) !== null) {
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
