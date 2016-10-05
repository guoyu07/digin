<?php

namespace backend\controllers;

use Yii;
use backend\models\VendorProducts;
use backend\models\VendorProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use backend\models\Category;
use backend\models\OtherCurrencyRates;
use backend\models\VendorCurrencySetting;
use yii\data\ArrayDataProvider;

/**
 * VendorProductsController implements the CRUD actions for VendorProducts model.
 */
class VendorProductsController extends Controller
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
     * Lists all VendorProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VendorProducts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function saveModel($modelvp)
    {
        $model=$modelvp['model'];
        $searchModel = new VendorProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);  
        
        $connection = Yii::$app->db;
        $success=false;  
         
        $vendorid= Yii::$app->request->get('id'); 
           
         //echo "Id..". $vendorid;
         $transaction = $connection->beginTransaction();
           if(isset($_POST['VendorProducts']['category']) && $_POST['VendorProducts']['category']!=null)
           {
               $model->catid=$_POST['VendorProducts']['category'];
           }
            if(isset($_POST['VendorProducts']['product']) && $_POST['VendorProducts']['product']!=null)
            {
                $model->prid=$_POST['VendorProducts']['product'];
            }
            else{
                $model->prid=0;
            }
           if($model->isNewRecord)
            {            
                if(isset($vendorid))
                {
                    $model->vid=$vendorid;
                }
                else{
                    $model->vid=Yii::$app->user->identity->id;
                }
          }
          else {
             $updatevendorid=  VendorProducts::findOne($vendorid);
             $model->vid=$updatevendorid->vid;
          }
           // var_dump($model->attributes);           
                
       $success=$model->save();
           
         if($success) 
           {   
                $venprocurset = $model->getCurrencySettingsVenProduct();
                $transaction->commit();
                echo 1;                
           }
            else{
               $transaction->rollBack();
               echo 0;                
            }  
    }

    /**
     * Creates a new VendorProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VendorProducts();     
        
        $model->can_book =0;
        $vendorid= Yii::$app->request->get('id'); 
       if(isset($_GET['VendorProducts']['countrylst'])){
        
         $query = array();
         $sql="SELECT vendor_products.prid as prid,other_currency_rates.vpid as vpid,other_currency_rates.ocid as ocid,other_currency_rates.country as country,other_currency_rates.currency as currency,vendor_products.unit as unit, other_currency_rates.rate as price
             FROM vendor_products
             INNER JOIN other_currency_rates
             ON vendor_products.vpid=other_currency_rates.vpid WHERE other_currency_rates.country=".$_GET['VendorProducts']['countrylst']." AND vendor_products.vid=".$vendorid;
       $connection= Yii::$app->db;
       $command= $connection->createCommand($sql);
       $count=$command->query();
       $othrDataProv=$count->readAll();
       
        $dataProvider = new ArrayDataProvider([
       'allModels' => $othrDataProv,
          ]);
       
        $searchModel = new \backend\models\OtherCurrencyRatesSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //var_dump($dataProvider);
        return $this->render('create', [
                'model' => $model,  
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        
        }else{
        $searchModel = new VendorProductsSearch();
        $dataProvider = $searchModel->searchByvendor(Yii::$app->request->queryParams,$vendorid); 
       }
               
        /****************To load multiple models*********************
        $count = count(Yii::$app->request->post('VendorProducts', []));
        $model = [new VendorProducts()];
        for($i = 1; $i < $count; $i++) {
            $model[] = new VendorProducts();
        }
         * */
        //var_dump(Yii::$app->request->queryParams);
        
        $model->price='0.00';
        $model->height='0.00';
        $model->width='0.00';
        $model->lenght='0.00';
        $model->weight='0.00';
        if ( $model->load(Yii::$app->request->post()) ) {
            
            try{
                $this->saveModel(array('model'=>$model));
            }
            catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }    
          
        } else {                 
            return $this->render('create', [
                'model' => $model,  
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } 
    }

    public function actionGetcategory()
    {
        
        $category=$_POST['catname'];       
        
       /*******code for autocomplete*******
         $data = \backend\models\Product::find()
                         ->select(['prodname as value', 'prodname as  label','c.prid as id'])
                         ->from('product p')  
                         ->asArray()
                         ->join('join', 'product_categories c', 'c.prid=p.prid')
                         ->where('c.catid='.$categoryid)
                         ->all();
        echo json_encode($data);*/        
        
        $data= Category::find()
                 ->select(['id', 'path'])                 
                 ->where('path LIKE :query')
                 ->addParams([':query'=>'%'.$category.'%'])
                 ->all();        
        $categoryresult=array();
        foreach ($data as $dat)
        {
            array_push($categoryresult, array('id'=>$dat['id'], 'path'=>$dat['path']));  
        }
        echo json_encode($categoryresult);
        
    }
    
    public function actionGetproduct() 
    {       
       $product=$_POST['prodname']; 
       $categoryid='';
       if(isset($_POST['category'])){
            $categoryid=$_POST['category'];}
       $query = new \yii\db\Query;  
      
       $query->select(['p.prid','prodname', 'c.id as catid', 'c.path as path'])
             ->from(['product p'])              
             ->join('inner join', 'product_categories pc', 'pc.prid=p.prid')             
             ->join('inner join', 'category c', 'c.id=pc.catid')
             ->where(['LIKE', 'prodname', $product]);
      
       if($categoryid!='' && $product!=''){
            $query->andWhere('pc.catid='.$categoryid);                   
       }
       if($categoryid!='' && $product==''){
           $query->andWhere('pc.catid='.$categoryid);
       }      
                  
       $data = $query->all();     
      
       $productresult=array();
       foreach ($data as $dat)
       {
           array_push($productresult, array('prid'=>$dat['prid'], 'prodname'=>$dat['prodname'], 'catid'=>$dat['catid'], 'path'=>$dat['path']));
       }       
       echo json_encode($productresult);       
    }




    /***** This is for to generate autocomplete field dynamically 
    * public function actionCreatecatautocomp()
    {
        $model = new VendorProducts();
        $i=$_POST['category'];
        $outputstring='';
        $outputstring.="<div class='col-xs-3'>";
        $outputstring.=Html::label('Parent Category');
   
         $data = Category::find()
                         ->select(['path as value', 'path as  label','id as id'])
                         ->asArray()
                         ->all();

          $outputstring.= AutoComplete::widget([
                     'name' => 'Category',
                     'id' => 'cat_'.$i,   
                     //'value' => $model->path,    
                     'clientOptions' => [
                         'source' => $data,        
                         'autoFill'=>true,
                         'minLength'=>'3',                        
                      ],
                      'options' => [
                                 'class' => 'form-control catautcomp ui-autocomplete-input'
                              ]
                      ]);  
                  

           $outputstring.= Html::activeHiddenInput($model, "[$i]category"); 
           $outputstring.="</div>";
           echo $outputstring;
        
    }*/
    
    /**
     * Updates an existing VendorProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $vendorid=$model->vid;
       
        $searchModel = new VendorProductsSearch();
        $dataProvider = $searchModel->searchByvendor(Yii::$app->request->queryParams,$vendorid);   
       
        $category=  Category::find()->where(['id'=>$model->catid])->one();
        //$model->categorypath=$category->path;
        $model->category=$model->catid;
                
        $product=  \backend\models\Product::find()->where(['prid'=>$model->prid])->one();
        //$model->prodname=$product->prodname;
        $model->product=$model->prid;               
       
        
        if ($model->load(Yii::$app->request->post())) {
            $this->saveModel(array('model'=>$model));
            //return $this->redirect(['view', 'id' => $model->vpid]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
       
    }

    /**
     * Deletes an existing VendorProducts model.
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
     * Finds the VendorProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VendorProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VendorProducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionMigratedata()
    {        
        $query= new \yii\db\Query;
        $query->select('created_by,product_id,price')
              ->from('digin_product_vendors');              
        $data=$query->all();      
        //var_dump($data);
        $i=0; 
        $success=false;        
        foreach ($data as $dt)
        {
            $query->select('firstname,lastname')
                  ->from('kahev_jsn_users')
                  ->where(['id'=>$dt['created_by']]);
            $vendata=$query->one();
            $fnm=str_replace("'", "\\'", $vendata['firstname']);           
            $lnm=str_replace("'", "\\'", $vendata['lastname']);                         
            $sql='SELECT vid FROM vendor WHERE firstname LIKE '."'".$fnm."'".' AND lastname LIKE '."'".$lnm."'";          
            $vendor=  \backend\models\Vendor::findBySql($sql)->one();
            //var_dump($vendor['vid']);
            //echo "...............................<br>......................";
            
            $query->select('product_name,category_id,unit_sale')
                  ->from('digin_products')
                  ->where(['id'=>$dt['product_id']]);
            $proddata=$query->one();
            $product= \backend\models\Product::find()->select('prid')->where(['prodname'=>$proddata['product_name']])->one();
            //var_dump($product['prid']); echo "<br>";
            
            
            $query->select('title')
                  ->from('kahev_categories')
                  ->where(['id'=>$proddata['category_id']]);
            $catdata=$query->one();
            $title=  trim($catdata['title']);
            $cat= \backend\models\Category::find()->where(['name'=>$title])->one();            
                //var_dump($cat['id']); echo "<br>";
            //if($product['prid']!="" && $cat['id']=="")
                //echo "......".$cat['id']."..........".$product['prid']."<br>";
            $unit="";            
            if($product['prid']!="" && $proddata['unit_sale']!='NO')
                $unit=1;
            else{                
                $unit=0;
            }
            //echo $unit."<br>";
            $price="";
            if($dt['price']==0)
                $price='0.00';
            else{
                $price=$dt['price'];
            }
            //echo $price."<br>";
            $venprod=new VendorProducts();
            $venprod->vid=$vendor['vid'];
            $venprod->catid=$cat['id'];
            $venprod->prid=$product['prid'];
            $venprod->unit=$unit;
            $venprod->price=$price;
            
            //var_dump($venprod->attributes);
            $success=$venprod->save();
            if($success)
                $i++;
        }
        if($success)
        {
            echo "Successfully inserted...".$i;
        }
        else{
            echo "Failed to insert...".$i;
        }
    }
   public function actionChangecurncyrate()
    {
      $ocid = $_POST['ocid'];
      $cntry = $_POST['cntry'];
      $currency = $_POST['curncy'];
      $venid = \backend\models\Vendor::find()->where(['user_id'=>  \yii::$app->user->identity->id])->one();
      //var_dump($cntry);
     // var_dump($ocid);
      if($venid['currencycode']!=$currency){
       if(isset($_POST['chngerate'])){
         $chngrt=$_POST['chngerate'];
         //var_dump($chngrt);
           $uporitemsts = OtherCurrencyRates::findOne($ocid);
            //var_dump($uporitemsts['ocid']);
            $uporitemsts['rate'] = $chngrt;
            $uporitemsts->update();
        }
      }else{
               return $this->redirect(['vendor-products/create','id'=>$venid['vid']]);
   
      }
        return $this->redirect(['vendor-products/create','id'=>$venid['vid'],'VendorProducts[countrylst]'=>$cntry]);
    }
}
