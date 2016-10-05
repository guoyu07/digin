<?php

namespace backend\controllers;

use Yii;
use backend\models\Specialdestination;
use backend\models\SpecialdestinationSearch;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecialdestinationController implements the CRUD actions for Specialdestination model.
 */
class SpecialdestinationController extends Controller
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
     * Lists all Specialdestination models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialdestinationSearch();        

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
     * Displays a single Specialdestination model.
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
        
        if(isset($_POST['Specialdestination']['cityarray'])){
                $model->cityarray=$_POST['Specialdestination']['cityarray']; 
            }
            //var_dump($model->cityarray);
         $transaction = $connection->beginTransaction();
         Specialdestination::deleteAll(['dpid'=>$model->dpid]);
            if(isset($model->cityarray) && $model->cityarray!=''){
            foreach($model->cityarray as $c)
            {      
                 $sp=new Specialdestination();            
                 $sp->dpid=$model->dpid;                 
                 $sp->cityid=$c;                
                 $success=$sp->save();
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
     * Creates a new Specialdestination model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Specialdestination();

        if ($model->load(Yii::$app->request->post())) {
           // return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Specialdestination model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $deliverypt= Specialdestination::find()->where(['dpid'=>$model->dpid])->all();            
        foreach ($deliverypt as $d){
            array_push($model->cityarray, $d['cityid']);      
        }
        $citis=  implode(',', $model->cityarray);
        if($citis!=''){
        $cities = \frontend\models\Cities::findBySql("select id, name from cities where id IN(" . $citis . ")")->all();
        $cityData = ArrayHelper::map($cities, 'id', 'name');
        }
        
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
     * Deletes an existing Specialdestination model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);

        $spcl= Specialdestination::deleteAll(['dpid'=>$model->dpid]);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Specialdestination model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Specialdestination the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Specialdestination::findOne($id)) !== null) {
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
