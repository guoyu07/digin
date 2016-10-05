<?php

namespace backend\controllers;

use Yii;
use backend\models\Dppackage;
use backend\models\DppackageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DppackageController implements the CRUD actions for Dppackage model.
 */
class DppackageController extends Controller
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
     * Lists all Dppackage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DppackageSearch();
        
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
     * Displays a single Dppackage model.
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
        $mdlpkgrates=$modelsArray['mdlpkgrates'];
        $mdlbulkrates=$modelsArray['mdlbulkrates'];
        $connection = Yii::$app->db;
        $success=FALSE;  
              
         $transaction = $connection->beginTransaction();
        
         //var_dump($_POST['Bulkrates']['bulk']);
         
         if($model->save())
         {
            
             $mdlpkgrates->pkgid= $model->id;
             $success=$mdlpkgrates->save();
         
             if($_POST['Bulkrates']['bulk']==1){
                $mdlbulkrates->load(Yii::$app->request->post());
                //var_dump($mdlbulkrates->attributes);
                $mdlbulkrates->pkgid=$model->id;
                $mdlbulkrates->save();
            }
          if($success)
             {
               $transaction->commit();
               return $this->redirect(['index']);
             }else{
                 $transaction->rollBack();
                 return $this->render('create', [
                 'model' => $model,
                 'mdlpkgrates' => $mdlpkgrates,
                 'mdlbulkrates' => $mdlbulkrates,
                  ]);
             }
         }else
         {
              return $this->render('create', [
              'model' => $model,
              'mdlpkgrates' => $mdlpkgrates,
              'mdlbulkrates' => $mdlbulkrates,
            ]);
         }  
    }
    /**
     * Creates a new Dppackage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dppackage();
        $mdlpkgrates=new \backend\models\Packagerates();
        $mdlbulkrates=new \backend\models\Bulkrates();

        if ($model->load(Yii::$app->request->post()) && $mdlpkgrates->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
            try {                              
                $this->saveAllModels(array('model'=>$model,
                                           'mdlpkgrates'=>$mdlpkgrates,
                                           'mdlbulkrates' => $mdlbulkrates));  
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }   
        } else {
            return $this->render('create', [
                'model' => $model,
                'mdlpkgrates' => $mdlpkgrates,
                'mdlbulkrates' => $mdlbulkrates,
            ]);
        }
    }

    /**
     * Updates an existing Dppackage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mdlpkgrates=  \backend\models\Packagerates::find()->where(['pkgid'=>$model->id])->one();
        $bulkrates=  \backend\models\Bulkrates::find()->where(['pkgid'=>$model->id])->one();
        $mdlbulkrates=new \backend\models\Bulkrates();
        if(sizeof($bulkrates)>0){
            $mdlbulkrates->bulk=1;
            $mdlbulkrates->attributes=$bulkrates->attributes;
        }
        if ($model->load(Yii::$app->request->post()) && $mdlpkgrates->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
             $this->saveAllModels(array('model'=>$model,
                                        'mdlpkgrates'=>$mdlpkgrates,
                                        'mdlbulkrates' => $mdlbulkrates));
        } else {
            return $this->render('update', [
                'model' => $model,
                'mdlpkgrates'=>$mdlpkgrates,
                'mdlbulkrates' => $mdlbulkrates
            ]);
        }
    }

    /**
     * Deletes an existing Dppackage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $mdlpkgrates=  \backend\models\Packagerates::find()->where(['pkgid'=>$model->id])->one();
        
        if($mdlpkgrates->delete()){
                $model->delete();
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Dppackage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dppackage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dppackage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
