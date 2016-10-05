<?php

namespace frontend\api\controllers;

use Yii;
use backend\models\Userreview;
use backend\models\UserreviewSearch;
use backend\models\UserreviewComments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserreviewController implements the CRUD actions for Userreview model.
 */
class UserreviewController extends Controller
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
     * Lists all Userreview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserreviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Userreview model.
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
     * Creates a new Userreview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Userreview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->urid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Userreview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->urid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Userreview model.
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
     * Finds the Userreview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Userreview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userreview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionShowreview()
    {        
        $reviews=  \backend\models\Reviewquestions::find()->all();
        $reviewqst=array();
        $data=array();
        foreach ($reviews as $r)
        {
            $reviewqst['qid']=$r['qid'];
            $reviewqst['question']=$r['question'];
            array_push($data, $reviewqst);
        }
        echo json_encode($data);
    }
    
    public function actionAdduserreview()
    {        
        $userid=$_REQUEST['userid'];
        $vid=$_REQUEST['vid'];        
        $cmnt=$_REQUEST['cmnt'];
        
        $success1=false;
        $success2=false;
        $result=array();  
       
        $userreviewcmnt=new UserreviewComments();
        $userreviewcmnt->userid=$userid;
        $userreviewcmnt->vid=$vid;
        $userreviewcmnt->comments=$cmnt;
        $userreviewcmnt->crtdt=date('Y-m-d H:i:s');
        $userreviewcmnt->crtby=$userid; 
        $userreviewcmnt->upddt=date('Y-m-d H:i:s');
        $userreviewcmnt->updby=$userid;        
        $success1=$userreviewcmnt->save(); 
        
        foreach($_REQUEST as $r=>$v)
        {            
            if(strpos($r,'q_') !== false)
            {
              $userreview=new Userreview();
              $userreview->questionid=explode('_',$r)[1];
              $userreview->answer=$v;
              $userreview->ucid=$userreviewcmnt->ucid;
              $userreview->userid=$_REQUEST['userid'];
              $userreview->vid=$_REQUEST['vid'];
              $userreview->crtdt=date('Y-m-d H:i:s');
              $userreview->crtby=$userid; 
              $userreview->upddt=date('Y-m-d H:i:s');
              $userreview->updby=$userid;              
              $success2=$userreview->save();             
            } 
        }
        
        if($success1 && $success2)
        {
            $result=["status"=>1,"error"=>''];   
        }        
        else
        {           
           $result=["status"=>0,"error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);          
     }
     
     public function actionShowvendorrating()
     {
         $vid=$_GET['vid'];
        
         $query = (new \yii\db\Query())   
               ->select(['vid','avg(answer) as average'])
               ->from('userreview')
               ->where(['vid'=>$vid]);
        $userreview=$query->all();        
        echo json_encode($userreview);
     }
     
     public function actionShowreviewbyuser()
     {
         $vid=$_GET['vid'];
                  
         $query = (new \yii\db\Query()) 
                 ->select(['u.vid', 'r.username', 'c.comments', 'avg(answer) as average'])
                 ->from(['userreview u'])
                 ->join('inner join','userreview_comments c', 'c.ucid=u.ucid')
                 ->join('inner join', 'user r', 'c.userid=r.id')
                 ->where(['u.vid'=>$vid])                           
                 ->groupBy('u.userid');
         $review=$query->all();
         echo json_encode($review);
     }
    
}
