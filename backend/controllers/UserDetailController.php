<?php

namespace backend\controllers;

use Yii;
use backend\models\UserDetail;
use backend\models\UserDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserDetailController implements the CRUD actions for UserDetail model.
 */
class UserDetailController extends Controller
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
     * Lists all UserDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);     
                
         return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDetail model.
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
     * Creates a new UserDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);        
        $mdlUser=new \dektrium\user\models\User();
        $user= \dektrium\user\models\User::find()->where(['id'=>$model->user_id])->one();
        
        $usersuccess=false;
        $userdetsuccess=false;
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post()) ) {
            //var_dump(Yii::$app->request->post());           
            $user->email=$_POST['UserDetail']['email'];
            $user->phone=$_POST['UserDetail']['phone'];            
            $mdlUser->role=$_POST['UserDetail']['role'];
            $newrole=$mdlUser->role;
            //var_dump($user->attributes);    
            
            $roles=Yii::$app->authManager->getRolesByUser($model->user_id);
            $oldrole='';
            foreach ($roles as $role)
            {
                $oldrole=$role->name;
            }
            $auth = \Yii::$app->authManager;
            $transaction = $connection->beginTransaction();
            $user->setScenario('update');
            $usersuccess=$user->save();
            if($usersuccess)
            {   
                if(Yii::$app->user->can($oldrole)){
                    $auth->revoke($auth->getRole($oldrole), $user->id);
                }                
                $auth->assign($auth->getRole($newrole),$user->id);
                $userdetsuccess=$model->save();
            }
            if($usersuccess && $userdetsuccess)
            {
                 $transaction->commit();
                 $session = Yii::$app->session;
                 $session->setFlash('success', 'The user has been updated successfully.');
                 return $this->redirect(['index']);
            }
            else{
                $transaction->rollBack();
                return $this->render('update', [
                'model' => $model,
                'mdlUser' => $mdlUser,
            ]);
            }           
        } else {
            return $this->render('update', [
                'model' => $model,
                'mdlUser' => $mdlUser,
            ]);
        }
    }

    /**
     * Deletes an existing UserDetail model.
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
     * Finds the UserDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
