<?php

namespace backend\controllers;

use Yii;
use backend\models\Orders;
use backend\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
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
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddorders()
    {
        $userid=$_GET['userid'];
        $ref=$_GET['ref'];
       
        $randomno=  uniqid();        
        $success1=false;
        $success2=false;
        $orderupdate=false;
        $result=array();
        
        $total=0;
        
        $order= new Orders();
        $order->displayid=uniqid();
        $order->userid=$userid;
        $order->transref=$ref;
        $order->total=0;
        $order->crtdt=date('Y-m-d H:i:s');
        $order->crtby=Yii::$app->user->identity->id;
        $order->upddt=date('Y-m-d H:i:s');
        $order->updby=Yii::$app->user->identity->id;
        $success1=$order->save(false);
        $query1 = (new \yii\db\Query())                           
                ->select(['c.vpid', 'quantity','vp.price', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                  
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')           
                ->where(['c.userid'=>$userid]);                      
        $cart=$query1->all(); 
       
        foreach ($cart as $c){
        $orderitem=new \backend\models\Orderitem();
        $orderitem->orid=$order->orid;
        $orderitem->vpid=$c['vpid'];
        $orderitem->rate=$c['price'];
        $orderitem->quantity=$c['quantity'];
        $orderitem->producttotal=$c['total'];
        $orderitem->crtdt=date('Y-m-d H:i:s');
        $orderitem->crtby=Yii::$app->user->identity->id;
        $orderitem->upddt=date('Y-m-d H:i:s');
        $orderitem->updby=Yii::$app->user->identity->id;       
        $total+=$orderitem->producttotal;
        $success2=$orderitem->save(false);
        }
        if($success2)
        {          
            \backend\models\Cart::deleteAll();
        }                    
       
        $order->total=$total;
        $orderupdate= $order->save(false);
        
        if($orderupdate)
        {
            $result=["status"=>1, "orderid"=>$order->displayid,"error"=>''];   
        }
        else
        {           
           $result=["status"=>0,"error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);    
    }
    
    
    public function actionVieworders()
    {
        $userid=$_GET['userid'];
        
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        $query1 = (new \yii\db\Query())   
               ->select(['orid','userid', 'displayid', 'transref', 'total'])
               ->from('orders')
               ->where(['userid'=>$userid]);
        $order=$query1->all(); 
        //echo json_encode($order);      
        foreach ($order as $or){
            $orderitem=  \backend\models\Orderitem::find()->where(['orid'=>$or['orid']])->all();
            foreach ($orderitem as $i)
            {       
                $orders['orid']=$i['orid'];
                $orders['vpid']=$i['vpid'];
                $orders['rate']=$i['rate'];
                $orders['quantity']=$i['quantity'];
                $orders['producttotal']=$i['producttotal'];
                array_push($orderitems, $orders);                
            }            
        }
        //echo "<br><br>".json_encode($orderitems);
        array_push($ordersdata, $order);
        array_push($ordersdata, $orderitems);
        echo json_encode($ordersdata);
    }
}
