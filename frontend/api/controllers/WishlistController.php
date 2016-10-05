<?php

namespace frontend\api\controllers;

use Yii;
use backend\models\Wishlist;
use backend\models\WishlistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WishlistController implements the CRUD actions for Wishlist model.
 */
class WishlistController extends Controller
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
     * Lists all Wishlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WishlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wishlist model.
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
     * Creates a new Wishlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wishlist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->wid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Wishlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->wid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wishlist model.
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
     * Finds the Wishlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wishlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wishlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddtowishlist()
    {
       $userid=$_GET['userid'];
       $type=$_GET['type'];
       $vpid=$_GET['vpid'];
       //echo $userid."......".$type."......".$vpid."<br>";
       
       $success=false;
       $result=array();
       $wishlist=new Wishlist();
       $wishlist->userid=$userid;
       if($type=='product'){
            $wishlist->type=1;
       }
       elseif ($type=='vendor') {
            $wishlist->type=2;
       }
       $wishlist->vpid=$vpid;
       $wishlist->crtdt=date('Y-m-d H:i:s');
       $wishlist->crtby=$userid;
       $wishlist->upddt=date('Y-m-d H:i:s');
       $wishlist->updby=$userid;
       //var_dump($wishlist->attributes);
       $success=$wishlist->save(false);
       if($success)
       {
           $result=["status"=>1, "fav"=>1, "wishlistid"=>$wishlist->wid, "error"=>''];   
       }
       else
       {           
           $result=["status"=>0, "fav"=>0, "wishlistid"=>0, "error"=>'One or more parameter missing.'];   
       }
       echo json_encode($result);
    }
    
    public function actionShowwishlist()
    {
        $userid=$_GET['userid'];      
        
        $url=$_SERVER['SERVER_NAME'];
        $favourites=array();        
        
        $url1="http:/".$url."/images/productimages/";           
        
        $query1 = (new \yii\db\Query())                           
                ->select(['w.wid','p.prid','p.prodname', '("product") as type','description','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image'])
                ->from('wishlist w')                
                ->join('inner join', 'product p', 'p.prid=w.vpid')
                ->join('inner join', 'product_images i', 'i.prid=w.vpid')                              
                ->where(['w.userid'=>$userid])
                ->andWhere(['w.type'=>1]);                 
        $product=$query1->all(); 
       
        array_push($favourites, $product);    
        
        $url2="http:/".$url."/images/vendorlogo/";
        $query = (new \yii\db\Query())                
                 ->select(['w.wid','vid','v.businessname', '("vendor") as type', 'email', 'website', 'CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(vid,"/",logo))) as Logo', 'aboutme', 'phone1 as phone', 'CONCAT(address1,if(address2 IN (NULL, ""), "",CONCAT("",",",address2)),",",city,",",state,",",pin) as Address','lat','lng'])
                 ->from('vendor v') 
                 ->join('inner join', 'wishlist w', 'w.vpid=v.vid')
                 ->where(['w.userid'=>$userid])
                 ->andWhere(['w.type'=>2]);                            
        $vendor=$query->all();
        
        array_push($favourites, $vendor);  
        echo json_encode($favourites);
    }
    
    public function actionRemovefromwishlist() 
    {
        $wid=$_GET['wid'];
        $result=array();
        $success=Wishlist::deleteAll(['wid'=>$wid]);
        if($success)
        {
             $result=["status"=>1, "fav"=>0, "error"=>''];   
        }
        else{
            $result=["status"=>0, "fav"=>"", "error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);
    }
}
