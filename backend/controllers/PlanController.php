<?php

namespace backend\controllers;

use Yii;
use backend\models\Plan;
use backend\models\PlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\helpers\ArrayHelper;

/**
 * PlanController implements the CRUD actions for Plan model.
 */
class PlanController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index','create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create','index', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['Superadmin','Admin'],
                    ],                   
                ],
            ],
        ];
    }

    /**
     * Lists all Plan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Plan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

     public function saveAllModels($modelsArray)
    {
        $model=$modelsArray['model'];
        $mdlplanfeature=$modelsArray['mdlplanfeature'];  
        $connection = Yii::$app->db;
        $success=FALSE;  
            
        //var_dump($_POST['PlanFeatures']['feature']);
        if(isset($_POST['PlanFeatures']['feature']))
        {
            $mdlplanfeature->feature=$_POST['PlanFeatures']['feature'];
        }
         $transaction = $connection->beginTransaction();
         if($model->save())
         {         
             //Delete all thePlan features before saving new.
             \backend\models\PlanFeatures::deleteAll(['planid'=>$model->id]); 
             if(isset($mdlplanfeature->feature) && $mdlplanfeature->feature!=""){
             foreach ($mdlplanfeature->feature as $f){
                 $pf=new \backend\models\PlanFeatures();
                 $pf->planid=$model->id;
                 $pf->featureid=$f;
                 $success=$pf->save();
             }}
             
            if($success)
             {
               $transaction->commit();
               return $this->redirect(['index']);
             }else{
                 $transaction->rollBack();
                 return $this->render('create', [
                 'model' => $model,
                 'mdlplanfeature' => $mdlplanfeature,
                  ]);
             }
         }else
         {
              return $this->render('create', [
              'model' => $model,
              'mdlplanfeature' => $mdlplanfeature,
            ]);
         }  
    }
    
    /**
     * Creates a new Plan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Plan();
        $mdlplanfeature= new \backend\models\PlanFeatures();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
          try {
                               
                $this->saveAllModels(array('model'=>$model,
                                           'mdlplanfeature'=>$mdlplanfeature));
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }            
        } else {
            return $this->render('create', [
                'model' => $model,
                'mdlplanfeature' => $mdlplanfeature,
            ]);
        }
    }

    /**
     * Updates an existing Plan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $planfeture=  \backend\models\PlanFeatures::find()->where(['planid'=>$model->id])->all();
        $mdlplanfeature= new \backend\models\PlanFeatures();
        // Now add those to newly created models feature array
       
        foreach ($planfeture as $f) {           
            array_push($mdlplanfeature->feature, $f->featureid);
        }
        // We also need the names of those features so get it from Features table.        
        $fechrids = implode(',', $mdlplanfeature->feature); 
        $featureid=  explode(',', $fechrids);
 
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $this->saveAllModels(array('model' => $model,
                                      'mdlplanfeature' => $mdlplanfeature));
        } else {
            return $this->render('update', [
                'model' => $model,
                'mdlplanfeature' => $mdlplanfeature,               
                'featureid' => $featureid,
            ]);
        } 
    }

    /**
     * Deletes an existing Plan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);        
                
        $success=false;
        $success=  \backend\models\PlanFeatures::deleteAll(['planid'=>$id]);
        if($success){
            $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Plan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Plan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
