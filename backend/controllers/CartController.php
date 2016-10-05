<?php

namespace backend\controllers;

use Yii;
use backend\models\Cart;
use backend\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
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
     * Lists all Cart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
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
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cart model.
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
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddtocart()
    {
        $userid=$_GET['userid'];
        $vpid=$_GET['vpid'];
        $qty=$_GET['quantity'];
        //echo $userid."......".$vpid."......".$qty."<br>";
        
        $success=false;
        $result=array();        
        
        $cart=  Cart::find()->where(['userid'=>$userid,'vpid'=>$vpid])->one();
        //var_dump($cartdata);
        if($cart == NULL)
        {
            $cart=new Cart();
        }
       
        $cart->userid=$userid;
        $cart->vpid=$vpid;        
        $cart->quantity=$qty;
        $cart->crtdt=date('Y-m-d H:i:s');
        $cart->crtby=Yii::$app->user->identity->id;
        $cart->upddt=date('Y-m-d H:i:s');
        $cart->updby=Yii::$app->user->identity->id;
       
        $success=$cart->save();
       
        if($success)
        {            
            $result=["status"=>1,"error"=>''];   
        }        
        else
        {           
           $result=["status"=>0,"error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);
    }
    
    public function actionDisplaycart()
    {
        $userid=$_GET['userid'];
        //echo $userid."<br>";  
              
        $url=$_SERVER['SERVER_NAME'];
        $selected=array();        
       
        $url1="http:/".$url."/images/productimages/";
                $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image','vp.price', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid') 
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')           
                ->where(['c.userid'=>$userid]);       
               
        $product=$query1->all(); 
        array_push($selected, array($product));  
        echo json_encode($selected);
    }
}
