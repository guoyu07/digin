<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\Category;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
	public $enableCsrfValidation = false;
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
		
        $auth=Yii::$app->authManager;
          $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);          
          if ($userRole) {
            foreach ($userRole as $role) {
               $roles[] = $role->name;
            }
            // if user have 1 role then $userRole will be a string containing it
            // othewhise let $userRole be an array containing them all
            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
         }
         
        $searchModel = new ProductSearch();
		$category = new Category();
        

        if($userRole=='Vendor')
        {              
           $dataProvider = $searchModel->searchVendor(Yii::$app->request->queryParams);        
        }
        else {            
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'category' =>$category,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $mdlproductimage=  \backend\models\ProductImages::find()->where(['prid'=>$model->prid])->all();
        return $this->render('view', [
            'model' => $model,
            'mdlproductimage' => $mdlproductimage
        ]);
    }

    public function actionCheckproduct()
    {
        $product=$_POST['prodname'];
        $category=$_POST['prodcat'];
        $mdlProductcat=new \backend\models\ProductCategories();        
        $catids=implode(',',$category);
        $productdata= Product::find()->where(['prodname'=>$product])->all();        
        if($productdata!=''){
        foreach ($productdata as $p)
        {            
            $sql="select * from product_categories where prid=".$p->prid." and catid IN (".$catids.")";
            $productcatdata=  \backend\models\ProductCategories::findBySql($sql)->all();
            if($productcatdata!=''){                
                echo sizeof($productcatdata);
            }          
        }  
        }       
    }
    
    public function actionGetcategory()
    {
        
        $category=$_POST['category'];                  
        
        $data= \backend\models\Category::find()
                 ->select(['id', 'path', 'status']) 
				 ->where('status = 1')				 
                 ->andWhere('path LIKE :query')
                 ->addParams([':query'=>'%'.$category.'%'])
                 ->all();  
        $categoryresult=array();
        foreach ($data as $dat)
        {
            array_push($categoryresult, array('id'=>$dat['id'], 'path'=>$dat['path']));  
        }
        echo json_encode($categoryresult);        
    }
	
      public function actionGetvendorcategory()
    {
        
        $category=$_POST['category'];                  
        
        $data= \backend\models\Category::find()
                 ->select(['id', 'path', 'status']) 			 
                 ->Where('path LIKE :query')
                 ->addParams([':query'=>'%'.$category.'%'])
                 ->all();  
        $categoryresult=array();
        foreach ($data as $dat)
        {
            array_push($categoryresult, array('id'=>$dat['id'], 'path'=>$dat['path']));  
        }
        echo json_encode($categoryresult);        
    }
    
    
     public function actionGetbrandname()
    {
        
        $brand=$_POST['brand'];                  
        //var_dump($brand);
        $data= \backend\models\BrandName::find()
                 ->select(['id', 'brand_name']) 			 
                 ->Where('brand_name LIKE :query')
                 ->addParams([':query'=>'%'.$brand.'%'])
                 ->all();  
        $brandresult=array();
        foreach ($data as $dat)
        {
            array_push($brandresult, array('id'=>$dat['id'], 'brand_name'=>$dat['brand_name']));  
        }
        echo json_encode($brandresult);        
    }
    
    
    /*
     *Saves Product model , ProductCategories & ProductImages model 
     *If saved successfully, browser will be redirected to the 'index' page
     *@param array $modelsArray
     *@return mixed
     */
    public function saveModels($modelsarray)
    {
           
        $model=$modelsarray['model'];
        $mdlproductimage=$modelsarray['mdlproductimage'];
        $mdlProductCategory=$modelsarray['mdlProductCategory'];
        $mdlvendorproduct=$modelsarray['mdlvendorproduct'];
        //var_dump($mdlvendorproduct['height']);
        $connection = Yii::$app->db;
        $primgsuccess=true; 
        $upimgsuccess=true;
        $prcatsuccess=false;
        $venprosuccess=false;
        
        $mdlProductCategory->prodcat=$_POST['ProductCategories']['prodcat'];
        
        if(isset($_POST['ProductImages']['primaryimage'])){
            $mdlproductimage->primaryimage=$_POST['ProductImages']['primaryimage'];
        }
          
        $uploadedFiles = UploadedFile::getInstances($mdlproductimage, 'image');
        //var_dump($uploadedFiles);      
        
        $model->description=utf8_decode($_POST['text-content']);
       // echo iconv($_POST['Product']['prodname'],"EUC-JP", "auto");
        $model->brand = $_POST['BrandName']['id'];
        $model->prodname=utf8_decode($_POST['Product']['prodname']);
        $model->keywords=utf8_decode($_POST['Product']['keywords']);
        
            $role='';
            $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id);
            foreach($userrole as $r)
            {
              $role=$r->name;
            }
            if($role=='Vendor') {
                $model->Is_active = 0;
            }
        //var_dump($model->attributes);
        $transaction = $connection->beginTransaction();
        if ($model->save()) {
 
             //Delete all the Product Categories before saving new.
             \backend\models\ProductCategories::deleteAll(['prid'=>$model->prid]);       
            foreach ($mdlProductCategory->prodcat as $pc)
             {
                 $productcat=new \backend\models\ProductCategories();
                 $productcat->prid=$model->prid;                 
                 $productcat->catid=$pc;                    
                 $prcatsuccess=$productcat->save();
            }
            
            //var_dump($modelsarray['mdlvendorproduct']);
            ///**************Vendorproduct save model********************************/
             
               if(!$model->isNewRecord){
                    if($role=='Vendor') {
//                 //Delete all the vendor product as per prid before saving new.
                  $uid = \Yii::$app->user->identity->id;
                  \backend\models\VendorProducts::deleteAll(['prid'=>$model->prid]);
                  $vndid = \backend\models\Vendor::findOne(['user_id'=>$uid]);
                       $vencatid = intval($mdlProductCategory->prodcat);
                       $vendprodct = new \backend\models\VendorProducts();
                       
                       $vendprodct->vid = $vndid['vid'];
                       $vendprodct->prid = $model->prid;
                       $vendprodct->catid = $vencatid;
                       $vendprodct->unit = $mdlvendorproduct['unit'];
                       $vendprodct->price = $mdlvendorproduct['price'];
                       $vendprodct->height =$mdlvendorproduct['height'];
                       $vendprodct->width = $mdlvendorproduct['width'];
                       $vendprodct->weightunit = $mdlvendorproduct['weightunit'];
                       $vendprodct->lenght = $mdlvendorproduct['lenght'];
                       $vendprodct->weight = $mdlvendorproduct['weight'];
                       $vendprodct->can_book = $mdlvendorproduct['can_book'];
                       $vendprodct->digin_clicks = 0;
                       $vendprodct->digin_impression = 0;
                       $vendprodct->crtdt = date('Y-m-d H:i:s');
                       $vendprodct->upddt = date('Y-m-d H:i:s');
                       $vendprodct->updby = \Yii::$app->user->identity->id;
                       $vendprodct->crtby = \Yii::$app->user->identity->id;
                                          
                       $venprosuccess = $vendprodct->save();
                       
                       //var_dump($vendprodct->getErrors());
                 
               }
              }
              
              if(!$model->isNewRecord){
                  //Delete all the Product Images before saving new.
                  \backend\models\ProductImages::deleteAll(['prid'=>$model->prid]);
                   foreach ($mdlproductimage->images as $img){
                       $prodimg = new \backend\models\ProductImages();
                       //$image=  explode(',', $img); 
                       $prodimg->prid = $model->prid;
                       $prodimg->image = $img->image;                       
                       if($img->image==$mdlproductimage->primaryimage){
                           $prodimg->ismain=1;
                       }else{
                           $prodimg->ismain=0;
                       }                       
                       $primgsuccess = $prodimg->save();
                   }
               
               
              
              }
            //$venprosuccess = $mdlvendorproduct->save();  
            $upimgsuccess=$this->saveUploadedimages($model->prid,$uploadedFiles,$mdlproductimage->primaryimage,$model);
                
                
            if ($prcatsuccess && $primgsuccess && $upimgsuccess || $venprosuccess) {
                $transaction->commit();
             
                return $this->redirect(['index']);
            } else {
                $transaction->rollBack();                
                return $this->render('create',[
                            'model' => $model,
                            'mdlproductimage' => $mdlproductimage,
                            'mdlProductCategory'=>$mdlProductCategory,
                            'mdlvendorproduct'=>$mdlvendorproduct
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'mdlproductimage' => $mdlproductimage,
                        'mdlProductCategory'=>$mdlProductCategory,
                        'mdlvendorproduct'=>$mdlvendorproduct
            ]);
        }
    }

    /*
     *Saves ProductImages model 
     *If saved successfully, returns success value
     *@param product id, array of uploaded files, primary image, $model
     *@return success
     */
    public function saveUploadedimages($prodid,$uploadedfiles,$primaryimg,$model)
    {
        $success=true;

        if ($uploadedfiles != '' && $uploadedfiles != null || $model->isNewRecord) {
                $fileSavePath = Yii::getAlias("@frontendimagepath") . '/images/productimages/' . $prodid . '/';
               
                if (!file_exists($fileSavePath))
                    mkdir($fileSavePath, 0755, true);
        }
        foreach ($uploadedfiles as $img) {
           
              $prodimg = new \backend\models\ProductImages();
              $prodimg->prid = $prodid;
              $prodimg->image = $img->name;                             
             if($img->name==$primaryimg){
                   $prodimg->ismain=1;
             }
             $img->saveAs($fileSavePath . $img->name);
             //var_dump($mdlproductimage->attributes);
            $success = $prodimg->save();
             }
         
        return $success;
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $mdlproductimage=new \backend\models\ProductImages();
        $mdlProductCategory=new \backend\models\ProductCategories();
        $mdlvendorproduct = new \backend\models\VendorProducts();
        $mdlBrandproduct = new \backend\models\BrandName();
        //echo mb_convert_encoding($_POST['Product']['prodname'],'HTML-ENTITIES','utf-8');
       
        if ($model->load(Yii::$app->request->post()) ) {
            //var_dump($_POST['VendorProducts']);
            if(isset($_POST['VendorProducts'])){
            $mdlvendorproduct = $_POST['VendorProducts'];
            }
            
            try{
           // var_dump($model);                          
                $this->saveModels(array('model'=>$model,
                                        'mdlproductimage'=>$mdlproductimage,
                                        'mdlProductCategory'=>$mdlProductCategory,
                                        'mdlvendorproduct'=>$mdlvendorproduct,
                                        'mdlBrandproduct'=>$mdlBrandproduct
                                      ));
            }
            catch (Exception $ex){
                    $transaction->rollBack();
                    throw $ex;
            }
        }
        else {
            return $this->render('create', [
                       'model' => $model,
                       'mdlproductimage'=>$mdlproductimage,
                       'mdlProductCategory'=>$mdlProductCategory,
                       'mdlvendorproduct'=>$mdlvendorproduct,
                       'mdlBrandproduct'=>$mdlBrandproduct
                   ]);
        }
            
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $prodimage= \backend\models\ProductImages::find()->where(['prid'=>$model->prid])->all();
        $mdlProductCategory=new \backend\models\ProductCategories();
        $prodcat=  \backend\models\ProductCategories::find()->where(['prid'=>$model->prid])->all();       
        
        //$tiny= new  \moonland\tinymce\TinyMCE();
        //tinyMCE.activeEditor.setContent($model->description);
        foreach($prodcat as $pc)
        {
            array_push($mdlProductCategory->prodcat, $pc->catid);
        }
        // We also need the names of those product categories so get it from Category table.        
        $catids = implode(',', $mdlProductCategory->prodcat);
        $prodcatdata=array();
        if($catids!=''){
        $category = \backend\models\Category::findBySql("select id, path from category where id IN(" . $catids . ")")->all();
        $prodcatdata = \yii\helpers\ArrayHelper::map($category, 'id', 'path');
        }
        
        
        $mdlproductimage=new \backend\models\ProductImages(); 
        $mdlvendorproduct =new \backend\models\VendorProducts();
        $mdlBrandproduct=new \backend\models\BrandName();
        foreach ($prodimage as $img)
        {
            if($img->ismain==1){ 
                $mdlproductimage->primaryimage=$img->image;
            }
            array_push($mdlproductimage->images, $img);
        }
        
       $brndnm = \backend\models\BrandName::findOne(['id'=>$model->brand]);
         $model->brdnm = $brndnm['brand_name']; 
         
      $role='';
      $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id);
      //if($userrole=="Vendor"){
       $venproduct= \backend\models\VendorProducts::find()->where(['prid'=>$model->prid])->one();
       //var_dump($venproduct->lenght);
       //var_dump($mdlvendorproduct);
       if(isset($venproduct)){
       $mdlvendorproduct->unit=$venproduct->unit;
       $mdlvendorproduct->price=$venproduct->price;
       $mdlvendorproduct->height=$venproduct->height;
       $mdlvendorproduct->width=$venproduct->width;
       $mdlvendorproduct->lenght=$venproduct->lenght;
       $mdlvendorproduct->weight=$venproduct->weight;
       $mdlvendorproduct->weightunit=$venproduct->weightunit;
       $mdlvendorproduct->can_book=$venproduct->can_book;
      }
       //var_dump($mdlvendorproduct->unit);
        
        if($model->load(Yii::$app->request->post())) {  
        if(isset($_POST['VendorProducts'])){
          $mdlvendorproduct = $_POST['VendorProducts'];
        }
          
           $this->saveModels(array('model'=>$model,
                                    'mdlproductimage'=>$mdlproductimage,
                                    'mdlProductCategory'=>$mdlProductCategory,
                                    'mdlvendorproduct'=>$mdlvendorproduct,
                                    'mdlBrandproduct'=>$mdlBrandproduct
                    
                       ));
        } else {
            return $this->render('update', [
                'model' => $model,
                'mdlproductimage'=>$mdlproductimage,
                'mdlProductCategory'=>$mdlProductCategory,
                'prodcatdata'=>$prodcatdata,
                'mdlvendorproduct'=>$mdlvendorproduct,
                'mdlBrandproduct'=>$mdlBrandproduct
            ]);
        }
    }

    /**
     * Deletes image from ProductImages model
     * deletes image having that id which comes from ajax request
     * returns message of successful deletion
     */
    public function actionDeleteimage()
    {
        $imageid=$_POST['dbimage'];
        $prodid=$_POST['prodimage'];
        
        $prodimage=\backend\models\ProductImages::findOne($imageid);
        /****create file path where that image is stored actually****/
        $filepath = Yii::getAlias("@frontendimagepath").DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'productimages'.DIRECTORY_SEPARATOR.$prodid.DIRECTORY_SEPARATOR.$prodimage->image;       
        unlink($filepath);           //to delete file from folder
        $prodimage->delete();       //to delete file from database 
        echo "This image is deleted successfully from database";
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    //to insert products
    public function actionMigratedata()
    {
        $query = new \yii\db\Query;
        $query->select('category_id,product_image,product_description,product_name,type')
              ->from('digin_products');
        $data=$query->all();
               
        
        $prsuccess=false;
        $pcsuccess=false;
        //$pimgsuccess=false;
        //var_dump($data);
        $values='';
        $product=array();
        $count=0;
        $fullcnt=0;
                     
        foreach ($data as $dt)
        {
           /* $imagename="";
            $prodimg=  explode("/", $dt['product_image']);
            $size=  sizeof($prodimg);
            $count=$size-1;
            $imagename=$prodimg[$count]; */
            //echo $imagename."<br>";
           /* $product=new Product();
            $product->prodname=  trim($dt['product_name']);
            $product->description=  trim($dt['product_description']);
            if($dt['type']=='service')
            {
                $product->isservice=1;
            }
            else{
                $product->isservice=0;
            }
            $product->crtdt=date('Y-m-d H:i:s');
            $product->crtby=2;
            $product->upddt=date('Y-m-d H:i:s');
            $product->updby=2;
            //var_dump($product->attributes);
            $prsuccess=$product->save(false);*/
            $prodname=str_replace("'", "\\'", $dt['product_name']);
            $descr=str_replace("'", "\\'", $dt['product_description']);
            $descr=preg_replace('/\s+/', '&nbsp;', $descr);
            
            //$descr= $dt['product_description'];
            $time=date('Y-m-d H:i:s');
            $type=($dt['type']=='service' ? '1' : '0');
            $values.='('."'".$prodname."'".','."'".$descr."'".','."'".$type."'".','."'".$time."'".','."'".'2'."'".','."'".$time."'".','."'".'2'."'".'),';  
            $count++;
            $fullcnt++;
            if($count>=99 || $fullcnt >=  sizeof($data) )
            {
                $values=rtrim($values, ",");
                $values.=';\n';
                $sql = 'INSERT INTO product (prodname, description, isservice, crtdt, crtby, upddt, updby) VALUES '.$values;
                echo $sql;
                ob_flush();
                flush();
                $values="";
                $count=0;
            }
            //echo $count;
            //array_push($product, array($prodname,$descr,$type,$time,2,$time,2));
        }
        //echo $count;
       // echo $values;
        //var_dump($product);
        //$novalues=  count($values);
       // $novalues= sizeof($product);
        //echo $novalues;
        $sql = 'INSERT INTO product (prodname, description, isservice, crtdt, crtby, upddt, updby) VALUES '.$values;
        
       /* for ($i=0; $i < $novalues; $i++) { 
            $sql .= '(:col1_'.$i.', :col2_'.$i.', :col3_'.$i.', :col4_'.$i.', :col5_'.$i.', :col6_'.$i.', :col7_'.$i. ')';
            if ($i !== ($novalues-1))
                $sql .= ',';
        }*/
        $command = Yii::$app->db->createCommand($sql);
        
      /*  for ($i=0; $i < $novalues; $i++) {   
            //var_dump($product[$i][1]);
             $command->bindParam(':col1_'.$i, $product[$i][0],  \PDO::PARAM_STR);
             $command->bindParam(':col2_'.$i, $product[$i][1],  \PDO::PARAM_STR);
             $command->bindParam(':col3_'.$i, $product[$i][2],  \PDO::PARAM_STR);
             $command->bindParam(':col4_'.$i, $product[$i][3],  \PDO::PARAM_STR);
             $command->bindParam(':col5_'.$i, $product[$i][4],  \PDO::PARAM_INT);
             $command->bindParam(':col6_'.$i, $product[$i][5],  \PDO::PARAM_STR);
             $command->bindParam(':col7_'.$i, $product[$i][6],  \PDO::PARAM_INT);            
        }*/
        //var_dump($command);   
        /*$prsuccess=$command->execute();
        if($prsuccess)
        {
            echo "Successfully inserted...";
        }
        else{
            echo "Failed to insert...";
        }*/
    }
    //to insert primary image
    public function actionTransferdata()
    {
        $query = new \yii\db\Query;
        $query->select('category_id,product_image,product_name')
              ->from('digin_products');
        $data=$query->all();
        
        $values='';  
        $i=0;
        $count=0;
        $fullcnt=0;
        $success=false;
        foreach ($data as $dt)
        {
            $imagename="";
            $prodimg=  explode("/", $dt['product_image']);
            $size=  sizeof($prodimg);
            $cnt=$size-1;
            $imagename=$prodimg[$cnt]; 
            //echo $dt['product_name']."....".$imagename."<br>";
            
           /* $query->select('product_name')
                      ->from('digin_products')
                      ->where(['category_id'=>$dt['category_id']]);
            $proddata=$query->one();*/
            //$product= \backend\models\Product::findOne(['prodname'=>$proddata['product_name']]);
            $product= \backend\models\Product::find()->select('prid')->where(['prodname'=>$dt['product_name']])->one();
            //echo $product['prid'];
            //var_dump(sizeof($product));
            //if($imagename!=''){
            /*    $prodid=$product->prid;                                   
             
             if($imagename!="")
             {  
                 $values.='('."'".$prodid."'".','."'".$imagename."'".','."'".'1'."'".'),';
             }
            $count++;
            $fullcnt++;
            if($count>=99 || $fullcnt >=  sizeof($data) )
            {
                $values=rtrim($values, ",");
                $values.=';\n';
                $sql = 'INSERT INTO product_images(prid, image, ismain) VALUES'.$values;                
                echo $sql."----------------------------------------------------------------------------------------------------<br>";
                ob_flush();
                flush();
                $values="";
                $count=0;
            } */
            //}
            $productimg=new \backend\models\ProductImages();
             
                 
                        $productimg->prid=$product['prid'];
                // if($imagename!=''){      
                        $productimg->image=$imagename;                
                        $productimg->ismain=1;             
                        
                        //$productimg->save();
                
               // }
               /* else {
                        $productimg->image=$imagename;                
                        $productimg->ismain=0;
                }*/
                //echo $productimg->image; echo ".......................................<br>";
                //var_dump($productimg->attributes);
                //echo "------------------------------------------------------------------<br>";
                $success=$productimg->save();
                if($success)
                    $i++;
        }
        if($success)
        {
            echo "Successfully inserted...".$i; //2868 images are inserted out of 3008 coz 140 were blank.
        }
        else{
            echo "Failed to insert...".$i;
        }
    }
    
    //to insert other images
    public function actionSaveimages()
    {
        $qry=new \yii\db\Query;
        $qry->select('parent_id,image_gallery')
            ->from('digin_products_repeat_image_gallery');
        $imgdata=$qry->all();
        //var_dump(sizeof($imgdata));

         $values='';  
         $count=0;
         $count1=0;
         $i=0;
         $fullcnt=0;
         $success=false; 
         
        foreach ($imgdata as $img)
        {
                    $image="";
                    if($img['image_gallery']!='') {
                    $prodimg=  explode("/", $img['image_gallery']);
                    $size=  sizeof($prodimg);
                    $count=$size-1;
                    $image=$prodimg[$count];
                    }  
                    
                    $query=new \yii\db\Query;
                    $query->select('product_name')
                          ->from('digin_products')
                          ->where(['id'=>$img['parent_id']]);
                    $proddata=$query->one();
                 
                /*      if($proddata!=''){
                        $product= \backend\models\Product::find()->select('prid')->where(['prodname'=>$proddata['product_name']])->one();
                        
                    }                    
                    
                   // if($image!=''){
                     $prodid=$product['prid'];  
                        if($prodid!='' && $image!=''){
                            $values.='('."'".$prodid."'".','."'".$image."'".','."'".'0'."'".'),';
                        }
                    $count++;
                    $fullcnt++;
                    if($count>=99 || $fullcnt >=  sizeof($imgdata) )
                    {
                        $values=rtrim($values, ",");
                        $values.=';\n';
                        $sql = 'INSERT INTO product_images(prid, image, ismain) VALUES'.$values;                
                        echo $sql."<br>";
                        echo '---------------------------------------------------------------------------------------------------------------------------------<br>';
                        ob_flush();
                        flush();
                        $values="";
                        $count=0;
                    }  
            //}  */
                   $productimg=new \backend\models\ProductImages();
                   if($proddata!=''){
                        $product= \backend\models\Product::find()->select('prid')->where(['prodname'=>$proddata['product_name']])->one();
                        $productimg->prid=$product['prid'];
                    }                    
                   $productimg->image=  trim($image);
                   $productimg->ismain=0;
                 
                   if($productimg->prid!='' && $productimg->image!=''){
                       $count1++;
                   }
                   //var_dump($productimg->attributes); 
                   //echo "<br>";
                   
                   $success=$productimg->save(); 
                   if($success)
                        $i++;
         }
        echo $count1;  
        if($success)
        {
            echo "Successfully inserted...".$i; //260 images are inserted out of 3143 coz remaining were blank.
        }
        else{
            echo "Failed to insert...".$i;
        }
    }
    
    //to insert category
    public function actionSavecategory() 
    {
        $query = new \yii\db\Query;
        $query->select('category_id,product_name')
              ->from('digin_products');
        $data=$query->all();
        //var_dump($data);
        $count=0;
        $success=false;
         foreach ($data as $dt)
        {
            $query->select('title')
                  ->from('kahev_categories')
                  ->where(['id'=>$dt['category_id']]);
            $catdata=$query->one();
            $title=  trim($catdata['title']);
            $cat= \backend\models\Category::find()->where(['name'=>$title])->one();
           
            
            $prnm='%'.$dt['product_name'].'%';
            $product= \backend\models\Product::find()->select('prid')->where(['prodname'=>$dt['product_name']])->one();
                      //->where('prodname LIKE :query')
                      //->addParams([':query'=>$prnm])
                      //->one();
                    
            //var_dump($product['prid']);
            $productcat=new \backend\models\ProductCategories();
            $productcat->prid=$product['prid'];
            if($cat['id']!='')
                $productcat->catid=$cat['id'];
            else {
                $productcat->catid=0;
            }
            //var_dump($productcat->attributes);
            
            $success=$productcat->save();
            if($success)
                $count++;
        }
        if($success)
        {
            echo "Successfully inserted...".$count;
        }
        else{
            echo "Failed to insert...".$count;
        }
    }
    public function actionTest()
    {
       echo Yii::getAlias("@frontendimagepath");
    } 
    public function actionSaveimage()
    {
        //$prid=[1,2,3,4,5,6,7,8,10]; ->where(['not in','prid',$prid])
       $data=  \backend\models\ProductImages::find()->select('prid,image')->all();
       //var_dump($data);
       $i=0;
       foreach ($data as $dt)
       {
           $savefilePath = Yii::getAlias("@frontendimagepath"). '/images/productimages/' . $dt['prid'] . '/';
            if (!file_exists ($savefilePath))
                   mkdir ($savefilePath, 0755, true);
             
           $copyfilePath=Yii::getAlias("@frontendimagepath").'/images_src/digin/products/'.$dt['image'];   
            // echo "......".$copyfilePath."<br>";
             if($dt['image']!="" && file_exists($copyfilePath)){                
                // echo $copyfilePath."<br>";
                copy($copyfilePath, $savefilePath.$dt['image']);
                $i++;
             }
       }
       echo $i;
    }
    
    
    public function actionSavenewimages()
    {       
       $data=  \backend\models\ProductImages::find()->select('prid,image')->all();      
       $i=0;
       foreach ($data as $dt)
       {
           $savefilePath = Yii::getAlias("@frontendimagepath") . '/images/productimages/' . $dt['prid'] . '/';
                        
           $copyfilePath=Yii::getAlias("@frontendimagepath").'/products/'.$dt['image'];   
            // echo "......".$copyfilePath."<br>";
             if($dt['image']!="" && file_exists($copyfilePath)){ 
                  if (!file_exists ($savefilePath))
                     mkdir ($savefilePath, 0755, true);
                // echo $copyfilePath."<br>";
                copy($copyfilePath, $savefilePath.$dt['image']);
                $i++;
             }
       }
       echo "Saved images...".$i;
    }

public function actionActiveproduct(){
        $prid=$_POST['prid'];
        $pridactiv=$_POST['pridactiv'];
       // echo $prid."..".$activ;
        if($pridactiv==0){
        $pridactiv= \backend\models\Product::updateAll(['Is_active'=>1], 'prid='.$prid);
        }else{
        $pridactiv= \backend\models\Product::updateAll(['Is_active'=>0], 'prid='.$prid); 
        }
         if($pridactiv>0)
            echo "1";
        else{
            echo "0";
        }
        
    }
	
	/*public function actionActiveproductcat(){
        $catid=$_POST['prid'];
        $pridstatus=$_POST['pridstatus'];
        if($pridstatus==0){
			var_dump('hiii')
       $pridstatus= \backend\models\Product::updateAll(['Is_active'=>0], 'prid='.$prid); 
        }
        if($pridstatus>0)
            echo "1";
        else{
            echo "0";
        }
        
    }*/
 public function actionProductrpt(){
      //$ProductrptModel = new Product();
        
        $model = new \backend\models\VendorProducts();     
        
        $vendorid= Yii::$app->request->get('id'); 
        if ( $model->load(Yii::$app->request->post()) ) {
          //var_dump($_POST);
            $procat=""; 
            $product="";
            if(isset($_POST['VendorProducts']['category']) && $_POST['VendorProducts']['category']!=null)
           {
               $procat = $_POST['VendorProducts']['category'];
           }
            if(isset($_POST['VendorProducts']['product']) && $_POST['VendorProducts']['product']!=null)
            {
                $product = $_POST['VendorProducts']['product'];
            }
            //echo 'product='.$product.'  cat='.$procat;
            $query= new \yii\db\Query;
            $query->select(['v.firstname','v.lastname','v.address1','v.address2','v.phone1','v.phone2','v.city'])
                   ->from('vendor v')
                   ->distinct()
                   ->join('inner join', 'vendor_products p', 'v.vid=p.vid')
                   ->where(['p.catid'=> $procat])
                   ->orWhere(['p.prid'=> $product]);
                   //->all();
            $productrpt=$query->all();
            
            //var_dump($productrpt);
           /*  $count = $query->count();
             $pagination = new \yii\data\Pagination(['totalCount'=>$count]);
             //$pagination->limit=5;
             $query = $query->offset($pagination->offset)
                          ->limit($pagination->limit)
                          ->all();  */
              return $this->render('productreport',array('productreports'=>$productrpt,'model' => $model,));
            //  return $this->render('productreport', array('productreports'=>$query,'pagination'=>$pagination,'model' => $model));
        }
        else {    
             //$pagination= new \yii\data\Pagination();
            return $this->render('productreport', [
                'model' => $model, 
               // 'pagination'=>$pagination,                           
            ]);
        } 
        
        //return $this->render('productreport',array('productreports'=>$ProductrptModel));
    }
    
    public function actionUpload()
    {
        $model = new \backend\models\Product();
        
        
        if ($model->load(Yii::$app->request->post())) {
             try {
               $msgarr = $this->Uploadproduct(array(
                        'model' => $model,
                          
                                           
                    ));
                //    var_dump($msgarr);
                return $this->render('uploadproduct', [
                'model' => $model, 
                'msgarr' => $msgarr,  
            ]);
               
                  
            } catch (Exception $e) {
                //$transaction->rollBack();
                throw $e;
            }
           
        } else {
            return $this->render('uploadproduct', [
                'model' => $model, 
            ]);
        }
        
        
    }
    
    public function Uploadproduct(array $modelarray) {
   
        //var_dump($_GET['id']);
        //var_dump($modelarray);
           //$userid = Yii::$app->user->identity->id;
           $vid = $_GET['id'];
           //var_dump($userid);
           $model=$modelarray['model'];        
           $file=$model->excelfile;
           $success = 0;
           $msgarr = array();
              //echo 'hi m in import page....'; 
        $uploadedFile = UploadedFile::getInstance($model, 'excelfile');
        if(($uploadedFile!== null && $uploadedFile!=='' 
                && $uploadedFile->size !== 0 ) 
                || $model->isNewRecord)
        {
           $fileName = $uploadedFile;  //  file name
            //$model->logo = $fileName;
           $fileSavePath = Yii::$app->basePath . '/uploadpro/';
                if (!file_exists($fileSavePath)) {
                    mkdir($fileSavePath, 0755, true);
                }
          $uploadedFile->saveAs($fileSavePath . $fileName);
             
          $importfile=Yii::$app->basePath.'/uploadpro/' .$fileName;
          $data = \moonland\phpexcel\Excel::import($importfile); //  $config   $config is an optional
          //var_dump($data); 
        }
        
                //var_dump($findvendor);
      
         foreach ($data as $dt){
             
               $findvendoruser = \backend\models\VendorProducts::find()->where(['vid'=>$vid])->one();
               //$findven = \backend\models\VendorProducts::find()->where(['vid'=>$dt['Vendor Id']])->one();
               //echo json_encode($findvendoruser['vid']);
               //echo json_encode($findven['vid']);
            
               if($dt['Vendor Id']==$findvendoruser['vid']){
               
                    $venproduct = \backend\models\VendorProducts::updateAll(['price'=>$dt['Product Price']], 'vpid='.$dt['Vendor Product Id']);
                    
                    
               }else{
               
                   array_push($msgarr, $dt['Vendor Product Id']);
              }
              //echo json_encode($msgarr);
       
      }
       return $msgarr;

       $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'uploadpro'.DIRECTORY_SEPARATOR.$fileName;       
                 if (file_exists($filepath)) {
                    unlink($filepath);
                 }          
    }


public function actionAddcatagory() 
    {
        $userid = Yii::$app->user->identity->id;
	$modelprod = new \backend\models\Category();
        if(isset($_POST['vencatagory']) && $_POST['vencatagory']!="")
        {
            $modelprod->parentid=$_POST['vencatagory'];
        }
        else{
            $modelprod->parentid=0;
        }
		$modelprod->name=$_POST['title'];
		$path=null;
        if($modelprod->parentid!=0){
            $path= Product::findBySql("select path from category where id=".$modelprod->parentid)->one();
        }
        if($path!=null)
        {
            $modelprod->path=$path['path']." > ".$modelprod->name;
        }
        else
        {
           $modelprod->path= $modelprod->name;
        }
		$modelprod->status = 1;
		$modelprod->crtdt =date('Y-m-d H:i:s');
		$modelprod->crtby = $userid;
		$success = $modelprod->save(false);
        if($success)
        {
		echo "successfully insert...";	 					
        }
        else{
            echo "Failed to insert...";
        }
    }
	

    

public function actionProductSaveTest() 
{
      echo "Starting Save ".utf8_encode($_GET['name'])." ".$_GET['description']." ".$_GET['keywords'];
      
      $product= new \backend\models\Product();
      $product->prodname=$_GET['name'];
      $product->isservice=0;
      $product->description=$_GET['description'];
      $product->Is_active=1;
      $product->digin_clicks=0;
      $product->digin_impression=0;
      $product->keywords=$_GET['keywords'];
      $product->brand="Addidas";
     // $product->save();       
       echo "end Save ".$product->save(); 
       var_dump( $product->getErrors());
}
	

    
}