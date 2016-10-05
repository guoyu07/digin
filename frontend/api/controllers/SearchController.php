<?php

namespace frontend\api\controllers;


class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionSearch()
    {   
        $kmrad = \Yii::$app->params['kmrad'];
        $lat=$_GET['lat'];
        $lng=$_GET['lng'];
        $keyword=$_GET['keyword'];
        //echo $lat.".....".$lng.".......".$keyword."<br>";
        $key="%".$keyword."%";        
                        
        $query=new \yii\db\Query;
        
        $query1 = (new \yii\db\Query())
               ->select('id, c.name, ("category") as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
               ->from('vendor v')
               ->join('inner join', 'vendor_products p', 'p.vid=v.vid')
               ->join('inner join', 'category c', 'p.catid=c.id')
               ->where('c.name LIKE :query')
               ->addParams([':query'=>$key])
               ->orWhere('c.tags LIKE :query')
               ->addParams([':query'=>$key]);
               //->having('distance < '.$kmrad);
        
        $query2 = (new \yii\db\Query())               
                ->select('vid, v.businessname, ("vendor") as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
                ->from('vendor v')
                ->where('v.businessname LIKE :query')
                ->addParams([':query'=>$key]);
                //->having('distance < '.$kmrad);
        
        $query3 = (new \yii\db\Query())                
                ->select('p.prid, p.prodname, if(isservice=1,("service"),("product"))as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->where('p.prodname LIKE :query')
                ->addParams([':query'=>$key])
                //->having('distance < '.$kmrad)
                ->orderBy('distance');      
        
        $query=$query1->union($query2)->union($query3);
        $command=$query->createCommand();        
        $vendor=$command->queryAll();       
        // echo "<br>".sizeof($vendor)."<br><br>";       
      
        echo json_encode($vendor); 
      }
      
      
      public function actionSearchall()
      {
           $time_start = microtime(true);
           $kmrad = \Yii::$app->params['kmrad'];
           $lat=$_GET['lat'];
           $lng=$_GET['lng'];
           $keyword=$_GET['keyword'];
           //echo $lat.".....".$lng.".......".$keyword."<br>";
           //$key="%".$keyword."%";
           $url=$_SERVER['SERVER_NAME'];
           $key=implode("|",explode(" ",$keyword));

              
           $query=new \yii\db\Query;
           $url1="http:/".$url."/images/categoryimages/";
           $query1 = (new \yii\db\Query())
               ->select(['id', 'c.name', '("category") as type', 'path', 'CONCAT("'.$url1.'", if(image IN(NULL,""),"default_image.png",CONCAT(id,"/",image))) as Image', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
               ->distinct()
               ->from('vendor v')
               ->join('join', 'vendor_products p', 'p.vid=v.vid')
               ->join(' join', 'category c', 'p.catid=c.id')
               ->where('c.name REGEXP :query')
               ->addParams([':query'=>$key])
               ->orWhere('c.tags LIKE :query')
               ->addParams([':query'=>$key]);
               //->having('distance < '.$kmrad);
               //->groupBy('c.name');
           $count1 = $query1->count();
           $pagination = new \yii\data\Pagination(['totalCount' => $count1]);
           $category = $query1->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
           //$category=$query1->all();
           //echo sizeof($category);
           //echo $pagination->pageCount."<br>";
          //echo json_encode($category);
        
           $url2="http:/".$url."/images/vendorlogo/";
           $query2 = (new \yii\db\Query())                
                ->select(['vid','v.businessname', '("vendor") as type', 'CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(vid,"/",logo))) as Logo', 'aboutme', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->where('v.businessname LIKE :query')
                ->addParams([':query'=>$key]);
                //->having('distance < '.$kmrad);
           $count2 = $query2->count();
           $pagination = new \yii\data\Pagination(['totalCount' => $count2]);
           $vendor = $query2->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
           //$vendor=$query2->all();
           // echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
          // echo json_encode($vendor); 
          
           $url3="http:/".$url."/images/productimages/";
           $query3 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type', 'CONCAT("'.$url3.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image','vp.price' ,'( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid')
                ->where('p.prodname REGEXP :query')
                ->addParams([':query'=>$key]);
                //->having('distance < '.$kmrad)
                //->orderBy('distance'); 
            $count3 = $query3->count();
            $pagination = new \yii\data\Pagination(['totalCount' => $count3]);
            $product= $query3->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
           //$product=$query3->all();
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
           //echo json_encode($product);
           //echo $pagination->pageCount."<br>";
           $data=array();                 
           array_push($data, array($category));
           array_push($data, array($vendor));
           array_push($data, array($product));
           $data["Total Pages"]=$pagination->pageCount; 
           $data["Current Page No."]=$pagination->page+1;
           echo json_encode($data);
           $time_end = microtime(true);
           $execution_time = $time_end - $time_start;
           //echo "<br><br><br>Execution time: ".$execution_time." microseconds";
          
      }
      
      public function actionSearchproducts()
      {
          $kmrad = \Yii::$app->params['kmrad'];
          $lat=$_GET['lat'];
          $lng=$_GET['lng'];
          $prid=$_GET['prid'];
          $userid=$_GET['userid'];
          //echo $lat.".....".$lng.".......".$prid.".......".$userid."<br>";
          $url=$_SERVER['SERVER_NAME'];
          
          $output=array();
          $prwishlisttag=0;
          $venwishlisttag=0;
          $wishlist=  \backend\models\Wishlist::find()->where(['vpid'=>$prid])->andWhere(['userid'=>$userid])->one();
                                                        
          if($wishlist!="")
          {
              $prwishlisttag=1;
          }
          $url1="http:/".$url."/images/productimages/";
          $query1 = (new \yii\db\Query())                           
               // ->select(['p.prid','p.prodname', '("product") as type', 'description','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->select(['p.prid','p.prodname', '("product") as type', 'description','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image'])
               ->from('product p')
                //->from('vendor v')
               // ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
               // ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid')
                ->where(['p.prid'=>$prid])  
                ->andWhere(['i.ismain'=>1]) ;            
             //   ->having('distance < '.$kmrad)
             //   ->orderBy('distance'); 
           $product=$query1->all();
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
          // echo json_encode($product);
           $prodarry=array();
           $productresult=array();
           foreach ($product as $p)
           {
               $prodarry=['prid'=>$p['prid'], 'prodname'=>$p['prodname'], 'type'=>$p['type'], 'description'=>$p['description'], 'wishlisttag'=>$prwishlisttag];             
           }
           array_push($productresult, $prodarry);
          
           
           $prodimgarry=array();
           foreach ($product as $p)
           {              
               array_push($prodimgarry, ['image'=>$p['Image']]);
           }           
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";                   
           
           $url2="http:/".$url."/images/vendorlogo/";
           $query2 = (new \yii\db\Query())                
                ->select(['v.vid','v.businessname', '("vendor") as type', 'vp.vpid','CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(v.vid,"/",logo))) as Logo', 'aboutme', 'vp.price','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')  
                ->where(['p.prid'=>$prid])                 
                //->having('distance < '.$kmrad)
                ->orderBy('distance');
           $vendor=$query2->all();
            //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";          
            
            $vendorarry=array();
            $vendorresult=array();
              $planfeature= new \backend\models\PlanFeatures();
            foreach ($vendor as $v)
            {
                //$vendorarry=['vid'=>$v['vid'],'vpid'=>$v['vpid'], 'businessname'=>$v['businessname'], 'type'=>$v['type'], 'logo'=>$v['Logo'], 'price'=>$v['price'], 'distance'=>$v['distance'], 'wishlisttag'=>$wishlisttag];
                $vendorarry['vid']=$v['vid'];
                $vendorarry['vpid']=$v['vpid'];
                $vendorarry['businessname']=$v['businessname'];
                $vendorarry['type']=$v['type'];
                $vendorarry['logo']=$v['Logo'];
                $vendorarry['price']=$v['price'];
                $vendorarry['distance']=$v['distance'];
                
                /*********Vendor feartures************/
              
               $result1 = $planfeature->getFeature($v['vid'], 1);
               $result2 = $planfeature->getFeature($v['vid'], 2);
               $result3 = $planfeature->getFeature($v['vid'], 3);
               if($result1==1){
                   $vendorarry["Vendor Detail Link"]=TRUE;
                   //array_push($vendorarry,'Vendor Detail Link=TRUE');
               }else{
                   $vendorarry["Vendor Detail Link"]=FALSE;
                    //array_push($vendorarry,'Vendor Detail Link=FALSE');
               }
                if($result2==1){
                    $vendorarry["Buy Now"]=TRUE;
                    //array_push($vendorarry,'Buy Now=TRUE');
                }else{
                    $vendorarry["Buy Now"]=FALSE;
                    //array_push($vendorarry,'Buy Now=FALSE');
                }
                 if($result3==1){
                    $vendorarry["Add To Wishlist"]=TRUE;
                    //array_push($vendorarry,'Add To Wishlist=TRUE');
                }else{
                    $vendorarry["Add To Wishlist"]=FALSE;
                    //array_push($vendorarry,'Add To Wishlist=FALSE');
               }
              
                $wishlist=  \backend\models\Wishlist::find()->where(['vpid'=>$v['vid']])->one();
              
                if($wishlist!="")
                {
                    $venwishlisttag=1;
                }
                $vendorarry['wishlisttag']=$venwishlisttag;
                
               
                
                array_push($vendorresult, $vendorarry);
            }
           // array_push($vendorresult, $vendorarry);
           
           
           $filterarry=array();
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";          
           array_push($output, $productresult);
           array_push($output, $prodimgarry);
           array_push($output, $vendorresult);
           array_push($output, $filterarry);
           echo json_encode($output);
      }
      
      public function actionSearchvendors()
      {
          $kmrad = \Yii::$app->params['kmrad'];
          $lat=$_GET['lat'];
          $lng=$_GET['lng'];
          $vid=$_GET['vid'];
          //echo $lat.".....".$lng.".......".$vid."<br>";
          $vendordata = array();
          $veninfo = array();
          $venfeatures = array();
          $url=$_SERVER['SERVER_NAME'];
          
          $url1="http:/".$url."/images/vendorlogo/";
          $query = (new \yii\db\Query())                
                ->select(['vid','v.businessname','("vendor") as type', 'email', 'website', 'CONCAT("'.$url1.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(vid,"/",logo))) as Logo', 'aboutme', 'phone1 as phone', 'CONCAT(address1,if(address2 IN (NULL, ""), "",CONCAT("",",",address2)),",",city,",",state,",",pin) as Address','lat','lng','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')                
                ->where(['vid'=>$vid]);                
                //->having('distance < '.$kmrad);
           $vendor=$query->all();
           $planfeature= new \backend\models\PlanFeatures();
           //echo json_encode($vendor);
           foreach ($vendor as $v){
              
               $veninfo['vid'] = $v['vid'];
               $veninfo['businessname'] = $v['businessname'];
               $veninfo['Logo'] = $v['Logo'];
               $result1 = $planfeature->getFeature($vid, 7);//address
               $result2 = $planfeature->getFeature($vid, 5);//email
               $result3 = $planfeature->getFeature($vid, 4);//call
               $result4 = $planfeature->getFeature($vid, 8);//website
               $result5 =$planfeature->getFeature($vid, 6); //map
               $result6 =$planfeature->getFeature($vid, 9);   //my offer
               $result7 =$planfeature->getFeature($vid, 10);  //my product
             
               if($result1==TRUE){
                    
                $veninfo['Address'] = $v['Address'];
               }
                if($result2==TRUE){
                  $veninfo['email']  = $v['email'];
                }
                 if($result3==TRUE){
                    $veninfo['phone']  = $v['phone'];
                }
                 if($result4==TRUE){
                   $veninfo['website'] =  $v['website'];
                }
                if($result5==TRUE){
                    $veninfo['lat'] = $v['lat'];
                    $veninfo['lng'] = $v['lng'];
                    $veninfo['distance'] = $v['distance'];
                }
                if($result6==TRUE){
                   //$veninfo['myoffer'] = 'TRUE';
                }
                if($result7==TRUE){
                    //$veninfo['My Product'] = 'TRUE';
                }
               // array_push($veninfo,['vid'=>$vid,'Logo'=>$v['Logo'],'BusinessName'=>$v['businessname']]);
                //array_push($veninfo,['logo'=>$v['logo']]);
                array_push($vendordata,$veninfo);
           }
           /***new array***/
           $output = array();
           //var_dump($url);
           $url2="http://".$url."/images/productimages/";
           //var_dump($url2);
           $query2 = (new \yii\db\Query())
                    //->select(['v.vpid','p.prodname','CONCAT("'.$url2.'",if(pi.image IN (NULL, ""),"default_image.png", CONCAT(pi.prid,"/"))) as Image'])
                      ->select(['v.vpid','p.prid','p.prodname','CONCAT("'.$url2.'",if(pi.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",pi.image))) as Image'])
                 
                    ->from(['vendor_products v'])
                    ->distinct()
                    ->join('inner join','product_images pi','pi.prid=v.prid')
                    ->join('inner join','product p','p.prid=pi.prid')
                    ->where(['vid'=>$vid]);
           $myproduct=$query2->all();   
           //$myproduct3 = array();
           //echo json_encode($myproduct);
           
          
           /*array_push($output, $myproduct);
           array_push($output, $vendor);
           echo json_encode($vendor);*/
           
           /*********plan selection features as per plan*****/
           $features = array();
           $query3 = (new \yii\db\Query())
                    ->select('f.name')
                    ->from(['features f'])
                    ->join('inner join','plan_features pf','pf.featureid=f.id')
                    ->join('inner join','vendor v','v.plan=pf.planid')
                    ->where(['v.vid'=>$vid]);
          $plan = $query3->all();
         
         //array_push($output,$veninfo);
          array_push($output,$vendordata);
          array_push($output, $myproduct);
          //array_push($output, $plan);
          echo json_encode($output);
      }

}
