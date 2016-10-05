<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SkillsOccupation;
use frontend\models\SkillsOccupationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SkillsOccupationController implements the CRUD actions for SkillsOccupation model.
 */
class SkillsOccupationController extends Controller
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
     * Lists all SkillsOccupation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SkillsOccupationSearch();
        $dataProvider1 = $searchModel->search(Yii::$app->request->queryParams);

        //var_dump($dataProvider1);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider1' => $dataProvider1,
        ]); 
    }

    /**
     * Displays a single SkillsOccupation model.
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
     * Creates a new SkillsOccupation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SkillsOccupation();
        $userskillmodel= new \frontend\models\UserSkills();
        $testmodel= new \frontend\models\SkillsTestimonials();
        $consultantmodel= new \frontend\models\SkillsConsultants();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ocid]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'userskillmodel' => $userskillmodel,
                'testmodel' => $testmodel,
                'consultantmodel' => $consultantmodel,
            ]);
        }
    }

    /**
     * Updates an existing SkillsOccupation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ocid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SkillsOccupation model.
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
     * Finds the SkillsOccupation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SkillsOccupation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SkillsOccupation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
