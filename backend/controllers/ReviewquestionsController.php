<?php

namespace backend\controllers;

use Yii;
use backend\models\Reviewquestions;
use backend\models\ReviewquestionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewquestionsController implements the CRUD actions for Reviewquestions model.
 */
class ReviewquestionsController extends Controller
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
     * Lists all Reviewquestions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Reviewquestions(); 
        $searchModel = new ReviewquestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         if ($model->load(Yii::$app->request->post())) {
             try{
                $this->saveModel(array('model'=>$model));
             }
             catch (Exception $ex) {
                    $transaction->rollBack();
                    throw $ex;
             }    
        }
        else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        }
    }
    
    public function saveModel($modelque)
    {
        $model=$modelque['model'];
        $connection = Yii::$app->db;
        
        
        $transaction = $connection->beginTransaction();        
        if($model->save())
        {
            $transaction->commit();
            $questions=  \backend\models\Reviewquestions::find()->all();
            $quecount=sizeof($questions);            
            echo "1_".$quecount; 
        }
        else{
            $transaction->rollBack();
            echo 0;                
        } 
    }

    /**
     * Displays a single Reviewquestions model.
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
     * Creates a new Reviewquestions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reviewquestions();        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->qid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reviewquestions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new ReviewquestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if ($model->load(Yii::$app->request->post()) ) {
            $this->saveModel(array('model'=>$model));            
        } else {
            return $this->render('index', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Reviewquestions model.
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
     * Finds the Reviewquestions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reviewquestions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviewquestions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
