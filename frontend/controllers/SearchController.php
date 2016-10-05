<?php

namespace frontend\controllers;

class SearchController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionProduct()
    {
         return $this->render('product_info');
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
               ->addParams([':query'=>$key])
               ->having('distance < '.$kmrad);
        
        $query2 = (new \yii\db\Query())               
                ->select('vid, v.businessname, ("vendor") as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
                ->from('vendor v')
                ->where('v.businessname LIKE :query')
                ->addParams([':query'=>$key])
                ->having('distance < '.$kmrad);
        
        $query3 = (new \yii\db\Query())                
                ->select('p.prid, p.prodname, if(isservice=1,("service"),("product"))as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->where('p.prodname LIKE :query')
                ->addParams([':query'=>$key])
                ->having('distance < '.$kmrad)
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
//           $kmrad = \Yii::$app->params['kmrad'];
//           $lat=$_GET['lat'];
//           $lng=$_GET['lng'];
           
           /*****new code for search without lat lng*****/
            $session=\Yii::$app->session;
             if(!isset($session['lat'])|| !isset($session['lng'])){
                $this->storeLatLngById();
               }
            $lat=$session['lat'];
            $lng=$session['lng'];
           
           $keyword=$_GET['keyword'];
           //echo $lat.".....".$lng.".......".$keyword."<br>";
           $key="%".$keyword."%";
           $url=$_SERVER['SERVER_NAME'];
           $query=new \yii\db\Query;
           $url1="https:/".$url."/images/categoryimages/";
           $query1 = (new \yii\db\Query())
               ->select(['id', 'c.name', '("category") as type', 'path', 'CONCAT("'.$url1.'", if(image IN(NULL,""),"default_image.png",CONCAT(id,"/",image))) as Image', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
               ->distinct()
               ->from('vendor v')
               ->join('join', 'vendor_products p', 'p.vid=v.vid')
               ->join(' join', 'category c', 'p.catid=c.id')
               ->where('c.name LIKE :query')
               ->addParams([':query'=>$key])
               ->orWhere('c.tags LIKE :query')
               ->addParams([':query'=>$key])
               ->having('distance < '.$kmrad);
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
        
           $url2="https:/".$url."/
/vendorlogo/";
           $query2 = (new \yii\db\Query())                
                ->select(['vid','v.businessname', '("vendor") as type', 'CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(vid,"/",logo))) as Logo', 'aboutme', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->where('v.businessname LIKE :query')
                ->addParams([':query'=>$key])
                ->having('distance < '.$kmrad);
           $count2 = $query2->count();
           $pagination = new \yii\data\Pagination(['totalCount' => $count2]);
           $vendor = $query2->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
           //$vendor=$query2->all();
           // echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
          // echo json_encode($vendor); 
          
           $url3="https:/".$url."/images/productimages/";
           $query3 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type', 'CONCAT("'.$url3.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image','vp.price' ,'( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid')
                ->where('p.prodname LIKE :query')
                ->addParams([':query'=>$key])
                ->having('distance < '.$kmrad)
                ->orderBy('distance'); 
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
           echo "<br><br><br>Execution time: ".$execution_time." microseconds";
          
      }
      
      public function actionSearchproducts()
      {
          $session=\Yii::$app->session;
          $country=$session['country'];
          \Yii::info("Country is: ".$country);
          //var_dump($country);
          if($country==NULL){
          if(isset($_GET['ip'])){
              $ip = $_GET['ip'];
          }else{
              $ip = $_SERVER['REMOTE_ADDR'];
          }
          $addr_details = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
          $city = stripslashes(ucfirst($addr_details['geoplugin_city']));
          $countrycode = stripslashes(ucfirst($addr_details['geoplugin_countryCode']));
          $country = stripslashes(ucfirst($addr_details['geoplugin_countryName']));
          }else{
           //$country="India";
           $country=$session['country'];
           }
         
           //var_dump($ip);
          //$this->enableCsrfValidation = false;
          //$kmrad = \Yii::$app->params['kmrad'];
          //$lat=$_REQUEST['lat'];
          //$lng=$_REQUEST['lng'];
          \Yii::info("Lat Lng is: ".$lat."$lng");
          
           $base = \Yii::$app->request->baseUrl;
          
          if(!isset($session['lat'])|| !isset($session['lng'])){
          $this->storeLatLngById();
         }
          
          //var_dump($country);
          $lat=$session['lat'];
          $lng=$session['lng'];
          $kmrad = \Yii::$app->params['kmrad'];
//          $lat=$session['lat'];
//          $lng=$session['lng'];
           $prid=$_REQUEST['prid'];
           
          //var_dump($prid);
          $dgnimpsn = new \frontend\models\DiginImpressions();
          $dgnimpsn->prid = $prid;
          $dgnimpsn->impressiondate= date('Y-m-d H:i:s');
          $dgnimpsn->save();
          
          $pin=null;
          if(isset($_POST['pin'])){
              $pin=$_POST['pin'];
          }else{
              $order=new \backend\models\Orders();
              if(!\Yii::$app->user->isGuest){
              $pin=$order->Getlastshippedaddress(\Yii::$app->user->identity->id); 
              }  
//              else {
//                  $pin='';
//              }              
          }          
          if(isset($_POST['facid'])){
          //$facility=$_POST['facid']; 
          $facid=$_POST['facid'];         
          //$facid=  implode(',', $facility);        
          }
          //$userid=$_GET['userid'];
          //echo $lat.".....".$lng.".......".$prid.".......".$userid."<br>";
          $url=$_SERVER['SERVER_NAME'];
          
          $output=array();
          $prwishlisttag=0;
          $venwishlisttag=0;
          $rating=0;
          $wishlist=  \backend\models\Wishlist::find()->where(['vpid'=>$prid])->one();
          if($wishlist!="")
          {
              $prwishlisttag=1;
          }
          else{
               $prwishlisttag=0;
          }
         
          $url1=$base."/images/productimages/";
          //'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'i.ismain',
          $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','path', 'p.description','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')

                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                //->join('inner join', 'product_images i', 'i.prid=p.prid')
                ->join('inner join', 'product_categories pc', 'pc.prid=p.prid')
                ->join('inner join', 'category c', 'c.id=pc.catid')
                ->where(['p.prid'=>$prid])
                //->andWhere('i.ismain=1')
                //->having('distance < '.$kmrad)
                ->orderBy('distance');
                
           $product=$query1->one();
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
           //echo json_encode($product);
           $prodarry=array();
           $productresult=array();          
           $path=  str_replace('>', '/', $product['path']);
           $prodarry=['prid'=>$product['prid'], 'prodname'=>$product['prodname'], 'type'=>$product['type'], 'path'=>$path, 'description'=>$product['description'], 'wishlisttag'=>$prwishlisttag, 'pin'=>$pin];             
           //var_dump($prodarry);
           
           //$url3="https://".$url."/images/productimages/";
           $qry=(new \yii\db\Query()) 
                 ->select(['p.prid','p.digin_impression','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'i.ismain'])
                 ->from('product p')
                 ->join('inner join', 'product_images i', 'i.prid=p.prid')
                 ->where(['p.prid'=>$prid]);  
           $images=$qry->all();
           $prodimgarry=array();
           $imgresult=array();
           $displayimg=null;
		   $hitsval = 0;
           foreach ($images as $i)
           {                 
                    $prodimgarry['image']=$i['Image'];
                    $prodimgarry['ismain']=$i['ismain'];
					$hitsval=  $this->hits(0,$i['digin_impression'],$prid);
                    $vendorarry['digin_impression'] = $hitsval;
                    //echo "exiats";
                    if($i['ismain']==1){                        
                         $displayimg=$i['Image'];                         
                     }  
                    array_push($imgresult, $prodimgarry);                                          
                   
               //array_push($prodimgarry, ['image'=>$p['Image']]);
               //array_push($prodimgarry, ['ismain'=>$p['ismain']]);
           }
           $prodarry['image']=$displayimg;
           if($displayimg==null){
               $prodarry['image']=  isset($images[0]['Image']) ? $images[0]['Image'] : \Yii::$app->request->baseUrl. '/../../images/productimages/default_image.png';
           }
//           if((isset($prodarry['image']) && $prodarry['image']=="") || !isset($prodarry['image']))
//           {
//               $prodarry['image']=  isset($imgresult[0]['image']) ? $imgresult[0]['image'] : \Yii::$app->request->baseUrl. '/../../images/productimages/default_image.png';
//           }
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";                   
           
           $url2=$base."/images/vendorlogo/";
           $query2 = (new \yii\db\Query())                
                ->select(['v.vid','v.businessname','v.currencycode','v.country','vp.can_book', '("vendor") as type', 'vp.vpid','CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(v.vid,"/",logo))) as Logo', 'aboutme', 'delivery', 'vp.price','ROUND(( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ),2) AS distance'])
                ->from('vendor v')
                ->distinct()
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                
                ->join('inner join', 'product p', 'p.prid=vp.prid')  
                ->where(['p.prid'=>$prid])                 
             //   ->having('distance < '.$kmrad)
                ->orderBy('distance');
           if(isset($facid)){
              $query2->join('inner join', 'vendor_facilities vf', 'vf.vid=v.vid')
                     ->andWhere(['in', 'vf.facid', $facid]);
           }
           if(isset($pin)){
               
              $query4=(new \yii\db\Query())  
                  ->select(['v.vid','v.businessname','v.currencycode','v.country','vp.can_book','("vendor") as type', 'vp.vpid','CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(v.vid,"/",logo))) as Logo', 'aboutme', 'delivery', 'vp.price','ROUND(( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ),2) AS distance'])
                  ->from('vendor v')
                  ->distinct()
                  ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                
                  ->join('inner join', 'product p', 'p.prid=vp.prid')  
                  ->where(['p.prid'=>$prid])   
                  ->andWhere(['v.delivery'=>[2,3]])
               //   ->having('distance < '.$kmrad)
                  ->orderBy('distance')
                  ->groupBy('v.vid');
           
             $query2->join('left outer join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('left outer join','servicable_pincodes s', 's.dpid=d.dpid')                    
                    ->andWhere(['s.pincode'=>$pin]);                    
                              
             $query5=$query2->union($query4);
             $command=$query5->createCommand();        
             $vendor=$command->queryAll(); 
           }
          else{
            $vendor=$query2->all();
          } 
           
            //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";          
            $vendorarry=array();
            $vendorresult=array();
            $cntryven = \frontend\models\Countries::findOne(['name'=>$country]);
            
            foreach ($vendor as $v)
            {

                $othcntry = \backend\models\OtherCurrencyRates::findAll(['country'=>$cntryven['id'],'vpid'=>$v['vpid']]);
                $count = sizeof($othcntry);
                $vendorarry['vid']=$v['vid'];
                $vendorarry['vpid']=$v['vpid'];
                $vendorarry['businessname']=$v['businessname'];
                $vendorarry['type']=$v['type'];
               if(isset($v['Logo']))
                {
                      $vendorarry['logo']=$v['Logo'];
                }
                else{
                      $vendorarry['logo']=$url2."default_image.png"; 
                }
               
               if($country==$v['country']){
                $vendorarry['price']=$v['price'];
                $vendorarry['currencycode']=$v['currencycode'];
                }else if($country!=$v['country'] && $count>0){
                 $diffcur = $this->diffrentcountry($cntryven['id'],$v['vpid']); 
                 $expld = explode('_', $diffcur);
                 $vendorarry['price']=$expld[1];
                 $vendorarry['currencycode']=$expld[0];
                }else{
                  $curconvrsn = $this->curconversion($v['currencycode']);
                  $expld = explode('_', $curconvrsn);
                  $multy = $v['price']*$expld[1];
                  $vendorarry['price']=$multy;
                  $vendorarry['currencycode']=$expld[0];
                }

                $vendorarry['distance']=$v['distance'];
                $vendorarry['delivery']=$v['delivery'];
                $vendorarry['can_book']=$v['can_book'];
                //$vendorarry['currencycode']=$v['currencycode'];
                //$vendorarry['facid']=$v['facid'];
                $wishlist=  \backend\models\Wishlist::find()->where(['vpid'=>$v['vid']])->one();                           
                if($wishlist!="")                
                {
                     
                    $venwishlisttag=1;
                }
                else{
                    $venwishlisttag=0;
                }
                $vendorarry['wishlisttag']=$venwishlisttag;
                $query = (new \yii\db\Query())   
                          ->select(['round(avg(answer),2) as rating'])
                          ->from('userreview')
                          ->where(['vid'=>$v['vid']]);
                $userreview=$query->all();
                if($userreview[0]['rating']!="")
                {
                    $rating=$userreview[0]['rating'];
                }
                //var_dump($userreview[0]['rating']);
                $vendorarry['rating']=$rating;
                array_push($vendorresult, $vendorarry);
            }
           // array_push($vendorresult, $vendorarry);
            
         $dataProvider = new \yii\data\ArrayDataProvider([
                'key'=>'distance',
                'allModels' => $vendorresult,
                'sort' => [
                    'attributes' => ['distance', 'price', 'rating'],
                ],
        ]);                                         
           
//          $query3 = (new \yii\db\Query())                           
//                ->select(['facid', 'f.name'])
//                ->from('category_facilities cf')
//                ->join('inner join', 'category c', 'cf.catid=c.id')
//                ->join('inner join', 'facility f', 'f.id=cf.facid')
//                ->join('inner join', 'product_categories pc', 'c.id=pc.catid')
//                ->join('inner join', 'product p', 'pc.prid=p.prid')               
//                ->where(['p.prid'=>$prid]);                      
//           $facility=$query3->all();
           
           $query3=(new \yii\db\Query())
                   ->select(['facid', 'f.name'])
                   ->from('vendor_facilities vf')
                   ->join('inner join', 'vendor v', 'v.vid=vf.vid')
                   ->join('inner join', 'facility f', 'f.id=vf.facid')
                   ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                   ->join('inner join', 'product p', 'p.prid=vp.prid')  
                   ->where(['p.prid'=>$prid]); 
           $facility=$query3->all();        
           $filterarry=array();
           $filterresult=array();
           foreach ($facility as $f)
           {                
                    $filterarry['facid']=$f['facid'];
                    $filterarry['name']=$f['name'];                   
                    array_push($filterresult, $filterarry);                                                    
           }  
           
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";          
           array_push($output, $prodarry);
           array_push($output, $imgresult);
           array_push($output, $vendorresult);
           //array_push($output, $filterarry);
           array_push($output, $filterresult);
           if(isset($facid)){
               array_push($output, $facid);
           }
          
           //echo json_encode($output);
          return $this->render('product_info', array('output'=>$output, 'data'=>$dataProvider));
      }
      
      public function actionSearchvendors()
      {
          $reviews = array();
          $kmrad = \Yii::$app->params['kmrad'];
          $session=\Yii::$app->session;
          $base = \Yii::$app->request->baseUrl;

          if(!isset($session['lat'])|| !isset($session['lng'])){
          $this->storeLatLngById();
         }
          $lat=$session['lat'];
          $lng=$session['lng'];
          //$lat=$_GET['lat'];
          //$lng=$_GET['lng'];         
          $vid=$_GET['vid'];
           
          
        
		  
          /********for digin_clicks in perticular table**********/
		  $vid=$_GET['vid'];
                  
          if(isset($_GET['frompage'])&& isset($_GET['vpid'])){
               $vpid = $_GET['vpid'];
               $prid=$_GET['prid'];
               $vids = \backend\models\Product::findOne(['prid'=>$prid]);
               $hit = $vids['digin_clicks']+1;
               $updatecount= \backend\models\Product::updateAll(['digin_clicks'=>$hit], 'prid='.$prid);
               
               $hits = \backend\models\VendorProducts::findOne(['vpid'=>$vpid]);
               $hitvp = $hits['digin_clicks']+1;
               $updtvenprocnt = \backend\models\VendorProducts::updateAll(['digin_clicks'=>$hitvp],'vpid='.$vpid);
              }
               
             if(isset($_GET['prid'])){
                  $prid=$_GET['prid'];
              
               $dgnclck = new \frontend\models\DiginClicks();
               $dgnclck->vid = $vid;
               $dgnclck->prid= $prid;
               $dgnclck->clickdate= date('Y-m-d H:i:s');
               $dgnclck->save();
          }
		  
          $Url=$_SERVER['SERVER_NAME'];
          
          $url=$base."/images/vendorlogo/";
          $query = (new \yii\db\Query())                
                ->select(['vid','v.businessname','v.currencycode','("vendor") as type', 'email', 'website', 'CONCAT("'.$url.'", if(logo IS NULL OR logo="","default_image.png", CONCAT(vid,"/",logo))) as Logo', 'aboutme', 'phone1 as phone', 'CONCAT(address1,if(address2 IN (NULL, ""), "",CONCAT("",",",address2)),",",city,",",state,",",country,",",pin) as Address','lat','lng','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')                
                ->where(['vid'=>$vid]) 
                ->andWhere(['Is_active'=>1]);
               // ->having('distance < '.$kmrad);
           $vendor=$query->all();
           //echo json_encode($vendor);
           $reviews=  $this->getuserreviews($vid);
        
          $url1=$base."/images/productimages/";
          $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','v.clicks','p.prodname','vp.price','vp.weight','vp.weightunit','v.currencycode','("product") as type','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')                         
                ->where(['v.vid'=>$vid]);               
               // ->having('distance < '.$kmrad)
               // ->orderBy('distance'); 
           $product=$query1->all();           
           //echo json_encode($product);
           $prodarry=array();
           $productresult=array();
		   $venhits = 0;
           foreach ($product as $p)
           {              
               $prodarry['prid']=$p['prid'];
               $prodarry['prodname']=$p['prodname'];
			   $venhits = $this->hits($vid,$p['clicks'],0);
               $prodarry['clicks'] =  $venhits;
               $prodarry['price']=$p['price'];
               $prodarry['currencycode']=$p['currencycode'];
               $prodarry['weight']=$p['weight'];
               $prodarry['weightunit']=$p['weightunit'];
                         
               $qry=(new \yii\db\Query()) 
                      ->select(['p.prid','CONCAT("'.$url1.'",if(i.image IS NULL OR i.image="","default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'i.ismain'])
                      ->from('product p')
                      ->join('inner join', 'product_images i', 'i.prid=p.prid')
                      ->where(['p.prid'=>$p['prid']]);  
                $images=$qry->all();
                $prodimgarry=array();
                $imgresult=array();
                $displayimg=null;
                foreach ($images as $i)
                {                       
                     if($i['ismain']==1){                        
                         $displayimg=$i['Image'];                         
                     }                                                                                
                }
                $prodarry['image']=$displayimg;
                if($displayimg==null){
                     $prodarry['image']=  isset($images[0]['Image']) ? $images[0]['Image'] : \Yii::$app->request->baseUrl. '/../../images/productimages/default_image.png';
                }               
               array_push($productresult, $prodarry);
           }
           //var_dump($productresult);    
           return $this->render('vendor_info',array('vendor'=>$vendor,'userreview'=>$reviews, 'productresult'=>$productresult));
      }

      public function getuserreviews($vid)
     {                   
         $query = (new \yii\db\Query()) 
                 ->select(['u.vid', 'r.username', 'c.comments', 'avg(answer) as average'])
                 ->from(['userreview u'])
                 ->join('inner join','userreview_comments c', 'c.ucid=u.ucid')
                 ->join('inner join', 'user r', 'c.userid=r.id')
                 ->where(['u.vid'=>$vid])                           
                 ->groupBy('u.userid');
         $review=$query->all();
        // echo json_encode($review);
         // return $this->render('vendor_info',array('vendor'=>$review));
          return $review;
     }
     
     public function actionSearchallproducts()
     {    
         $session=\Yii::$app->session;     
         $kmrad = \Yii::$app->params['kmrad'];
         $base = \Yii::$app->request->baseUrl;
         $lat=$_REQUEST['currentlat'];
         $lng=$_REQUEST['currentlng'];         
         $keyword=$_REQUEST['search'];       
        // $key="%".$keyword."%";
         $url=$_SERVER['SERVER_NAME'];     
         $key=implode("|",explode(" ",$keyword));
          $key=$keyword."|".$key;
         if(!isset($session['lat'])|| !isset($session['lng'])){
          $this->storeLatLngById();
         }
          $lat=$session['lat'];
          $lng=$session['lng'];

          $url1=$base."/images/productimages/";
           $query3 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type', 'v.vid','v.currencycode as currency','v.businessname','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'vp.price', 'vp.vpid', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->distinct()
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid')
                ->where('p.prodname REGEXP :query')
                ->addParams([':query'=>$key])
                ->andWhere('i.ismain=1')
                ->andWhere(['v.Is_active'=>1])
              //  ->having('distance < '.$kmrad)
                ->orderBy('distance')
                ->orderBy('p.prid')         
                ->groupBy('p.prid');
            $count3 = $query3->count();           
            $pagination = new \yii\data\Pagination(['totalCount' => $count3]);
            $product= $query3->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
           //$product=$query3->all();   
           // echo $pagination->pageCount."<br>";
           //echo json_encode($product);           
           return $this->render('search', array('product'=>$product, 'pagination' => $pagination));
        }
  public function storeLatLngById()
    {
//       echo 'hi..m in lat lng...';
        $session=\Yii::$app->session;
        //$ip = $_SERVER['SERVER_ADDR'];
//        $lato=$_GET['lat'];
//        $lngo=$_GET['lng'];
//        var_dump($_GET);
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

\Yii::info('Remote ip'.$ip); 



        $addr1='Pune, Maharashtra, India';
        $addrs_details = file_get_contents("http://ip-api.com/json/".$ip);

        print_r($addrs_details);
        die;

        \Yii::info('Address'.$addrs_details);  
        $addr_details=json_decode($addrs_details, true);
        \Yii::info('lat'.$addr_details['lat'].'...'.$addr_details['lon']);     
        //$city = stripslashes(ucfirst($addr_details['geoplugin_city']));
        $city = stripslashes(ucfirst($addr_details['city']));
//        var_dump( $addr_details['geoplugin_request']);
//        var_dump($addr_details['geoplugin_latitude']);
//        var_dump($addr_details['geoplugin_longitude']);
        //var_dump($city);
        //$lato = $addr_details['geoplugin_latitude'];
        //$lngo = $addr_details['geoplugin_longitude'];
        $lato = $addr_details['lat'];
        $lngo = $addr_details['lon'];
        $session['lat']=$lato;
        $session['lng']=$lngo;
        $session['addr']=$city; 
//        var_dump($lato);
//        var_dump($lngo);
//          echo 'end here...';
////         var_dump($session['lat']);
////        var_dump($session['lng']);
      
    }

    public function actionNewsearchproducts()
      {
          //$this->enableCsrfValidation = false;
          //$kmrad = \Yii::$app->params['kmrad'];
          //$lat=$_REQUEST['lat'];
          //$lng=$_REQUEST['lng'];
          $session=\Yii::$app->session;
          $base = \Yii::$app->request->baseUrl;

          if(!isset($session['lat'])|| !isset($session['lng'])){
          $this->storeLatLngById();
         }
          $lat=$session['lat'];
          $lng=$session['lng'];
          $kmrad = \Yii::$app->params['kmrad'];

          $prid=$_REQUEST['prid'];
          $pin=null;

          $dgnimpsn = new \frontend\models\DiginImpressions();
          $dgnimpsn->prid = $prid;
          $dgnimpsn->impressiondate= date('Y-m-d H:i:s');
          $dgnimpsn->save();           

          if(isset($_POST['pin'])){
              $pin=$_POST['pin'];
          }else{
              $order=new \backend\models\Orders();
              if(!\Yii::$app->user->isGuest){
              $pin=$order->Getlastshippedaddress(\Yii::$app->user->identity->id); 
              }  
//              else {
//                  $pin='';
//              }              
          }          
          if(isset($_POST['facid'])){
          //$facility=$_POST['facid']; 
          $facid=$_POST['facid'];         
          //$facid=  implode(',', $facility);        
          }
          //$userid=$_GET['userid'];
          //echo $lat.".....".$lng.".......".$prid.".......".$userid."<br>";
          $url=$_SERVER['SERVER_NAME'];
          
          $output=array();
          $prwishlisttag=0;
          $venwishlisttag=0;
          $rating=0;
          $wishlist=  \backend\models\Wishlist::find()->where(['vpid'=>$prid])->one();
          if($wishlist!="")
          {
              $prwishlisttag=1;
          }
          else{
               $prwishlisttag=0;
          }
         
          $url1=$base."/images/productimages/";
          //'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'i.ismain',
          $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','path', 'p.description','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')

                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                //->join('inner join', 'product_images i', 'i.prid=p.prid')
                ->join('inner join', 'product_categories pc', 'pc.prid=p.prid')
                ->join('inner join', 'category c', 'c.id=pc.catid')
                ->where(['p.prid'=>$prid]) 
                //->andWhere('i.ismain=1')
                ->having('distance < '.$kmrad)
                ->orderBy('distance'); 
           $product=$query1->one();
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
           //echo json_encode($product);
           $prodarry=array();
           $productresult=array();          
           $path=  str_replace('>', '/', $product['path']);
           $prodarry=['prid'=>$product['prid'], 'prodname'=>$product['prodname'], 'type'=>$product['type'], 'path'=>$path, 'description'=>$product['description'], 'wishlisttag'=>$prwishlisttag, 'pin'=>$pin];             
           //var_dump($prodarry);
           
           //$url3="https://".$url."/images/productimages/";
           $qry=(new \yii\db\Query()) 
                 ->select(['p.prid','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'i.ismain'])
                 ->from('product p')
                 ->join('inner join', 'product_images i', 'i.prid=p.prid')
                 ->where(['p.prid'=>$prid]);  
           $images=$qry->all();
           $prodimgarry=array();
           $imgresult=array();
           $displayimg=null;
           foreach ($images as $i)
           {                 
                    $prodimgarry['image']=$i['Image'];
                    $prodimgarry['ismain']=$i['ismain'];
                    //echo "exiats";
                    if($i['ismain']==1){                        
                         $displayimg=$i['Image'];                         
                     }  
                    array_push($imgresult, $prodimgarry);                                          
                   
               //array_push($prodimgarry, ['image'=>$p['Image']]);
               //array_push($prodimgarry, ['ismain'=>$p['ismain']]);
           }
           $prodarry['image']=$displayimg;
           if($displayimg==null){
               $prodarry['image']=  isset($images[0]['Image']) ? $images[0]['Image'] : \Yii::$app->request->baseUrl. '/../../images/productimages/default_image.png';
           }
//           if((isset($prodarry['image']) && $prodarry['image']=="") || !isset($prodarry['image']))
//           {
//               $prodarry['image']=  isset($imgresult[0]['image']) ? $imgresult[0]['image'] : \Yii::$app->request->baseUrl. '/../../images/productimages/default_image.png';
//           }
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";                   
           
           $url2=$base."/images/vendorlogo/";
           $query2 = (new \yii\db\Query())                
                ->select(['v.vid','v.businessname','vp.can_book', '("vendor") as type', 'vp.vpid','CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(v.vid,"/",logo))) as Logo', 'aboutme', 'delivery', 'vp.price','ROUND(( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ),2) AS distance'])
                ->from('vendor v')
                ->distinct()
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                
                ->join('inner join', 'product p', 'p.prid=vp.prid')  
                ->where(['p.prid'=>$prid])                 
             //   ->having('distance < '.$kmrad)
                ->orderBy('distance');
           if(isset($facid)){
              $query2->join('inner join', 'vendor_facilities vf', 'vf.vid=v.vid')
                     ->andWhere(['in', 'vf.facid', $facid]);
           }
           if(isset($pin)){
               
              $query4=(new \yii\db\Query())  
                  ->select(['v.vid','v.businessname','vp.can_book','("vendor") as type', 'vp.vpid','CONCAT("'.$url2.'", if(logo IN (NULL, ""),"default_image.png", CONCAT(v.vid,"/",logo))) as Logo', 'aboutme', 'delivery', 'vp.price','ROUND(( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ),2) AS distance'])
                  ->from('vendor v')
                  ->distinct()
                  ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                
                  ->join('inner join', 'product p', 'p.prid=vp.prid')  
                  ->where(['p.prid'=>$prid])   
                  ->andWhere(['v.delivery'=>[2,3]])
               //   ->having('distance < '.$kmrad)
                  ->orderBy('distance');
           
             $query2->join('left outer join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('left outer join','servicable_pincodes s', 's.dpid=d.dpid')                    
                    ->andWhere(['s.pincode'=>$pin]);                    
                              
             $query5=$query2->union($query4);
             $command=$query5->createCommand();        
             $vendor=$command->queryAll(); 
           }
          else{
            $vendor=$query2->all();
          } 
           
            //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";          
            $vendorarry=array();
            $vendorresult=array();
            foreach ($vendor as $v)
            {
                //$vendorarry=['vid'=>$v['vid'],'vpid'=>$v['vpid'], 'businessname'=>$v['businessname'], 'type'=>$v['type'], 'logo'=>$v['Logo'], 'price'=>$v['price'], 'distance'=>$v['distance'], 'wishlisttag'=>$wishlisttag];
                $vendorarry['vid']=$v['vid'];
                $vendorarry['vpid']=$v['vpid'];
                $vendorarry['businessname']=$v['businessname'];
                $vendorarry['type']=$v['type'];
                if(isset($v['Logo']))
                         $vendorarry['logo']=$v['Logo'];
                else
                         $vendorarry['logo']=$url2."default_image.png";
                $vendorarry['price']=$v['price'];
                $vendorarry['distance']=$v['distance'];
                $vendorarry['delivery']=$v['delivery'];
                $vendorarry['can_book']=$v['can_book'];
                //$vendorarry['facid']=$v['facid'];
                $wishlist=  \backend\models\Wishlist::find()->where(['vpid'=>$v['vid']])->one();                           
                if($wishlist!="")                
                {
                     
                    $venwishlisttag=1;
                }
                else{
                    $venwishlisttag=0;
                }
                $vendorarry['wishlisttag']=$venwishlisttag;
                $query = (new \yii\db\Query())   
                          ->select(['round(avg(answer),2) as rating'])
                          ->from('userreview')
                          ->where(['vid'=>$v['vid']]);
                $userreview=$query->all();
                if($userreview[0]['rating']!="")
                {
                    $rating=$userreview[0]['rating'];
                }
                //var_dump($userreview[0]['rating']);
                $vendorarry['rating']=$rating;
                array_push($vendorresult, $vendorarry);
            }
           // array_push($vendorresult, $vendorarry);
            
         $dataProvider = new \yii\data\ArrayDataProvider([
                'key'=>'distance',
                'allModels' => $vendorresult,
                'sort' => [
                    'attributes' => ['distance', 'price', 'rating'],
                ],
        ]);                                         
           
//          $query3 = (new \yii\db\Query())                           
//                ->select(['facid', 'f.name'])
//                ->from('category_facilities cf')
//                ->join('inner join', 'category c', 'cf.catid=c.id')
//                ->join('inner join', 'facility f', 'f.id=cf.facid')
//                ->join('inner join', 'product_categories pc', 'c.id=pc.catid')
//                ->join('inner join', 'product p', 'pc.prid=p.prid')               
//                ->where(['p.prid'=>$prid]);                      
//           $facility=$query3->all();
           
           $query3=(new \yii\db\Query())
                   ->select(['facid', 'f.name'])
                   ->from('vendor_facilities vf')
                   ->join('inner join', 'vendor v', 'v.vid=vf.vid')
                   ->join('inner join', 'facility f', 'f.id=vf.facid')
                   ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                   ->join('inner join', 'product p', 'p.prid=vp.prid')  
                   ->where(['p.prid'=>$prid]); 
           $facility=$query3->all();        
           $filterarry=array();
           $filterresult=array();
           foreach ($facility as $f)
           {                
                    $filterarry['facid']=$f['facid'];
                    $filterarry['name']=$f['name'];                   
                    array_push($filterresult, $filterarry);                                                    
           }  
           
           //echo "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";          
           array_push($output, $prodarry);
           array_push($output, $imgresult);
           array_push($output, $vendorresult);
           //array_push($output, $filterarry);
           array_push($output, $filterresult);
           if(isset($facid)){
               array_push($output, $facid);
           }
          
           //echo json_encode($output);
           return $this->render('product_info_new', array('output'=>$output, 'data'=>$dataProvider));
      }
	  
	   public function hits($vid,$hits,$prid){
         $cathits =0;
         $updatecount = 0;
         $prid = $prid;
         $vid = $vid;
         $hits = $hits + 1;
     
       if(isset($vid)&& $vid!=""){
           
             $updatecount= \backend\models\Vendor::updateAll(['clicks'=>$hits], 'vid='.$vid);

         }
      else{
            $updatecount= \backend\models\Product::updateAll(['digin_impression'=>$hits],'prid='.$prid);
            $updatecountvp= \backend\models\VendorProducts::updateAll(['digin_impression'=>$hits],'prid='.$prid);
            
         }
    }

public function diffrentcountry($cntry,$vpid)
    {
         \Yii::info("Difference conversion is:".$cntry);
         \Yii::info("Difference conversion vpid:".$vpid);
        $othrcurrate = \backend\models\OtherCurrencyRates::find()
                        ->where(['country'=>$cntry])
                        ->andWhere(['vpid'=>$vpid])
                        ->one();
         return $othrcurrate['currency'].'.  '.$othrcurrate['rate'];
    }
    
  public function curconversion($cntry)
    {
          $session=\Yii::$app->session;
          $country=$session['country'];
          \Yii::info("Country is: ".$country);
          
          if($country==NULL){
          if(isset($_GET['ip'])){
              $ip = $_GET['ip'];
          }else{
              $ip = $_SERVER['REMOTE_ADDR'];
          }
          $addr_details = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
          $city = stripslashes(ucfirst($addr_details['geoplugin_city']));
          $countrycode = stripslashes(ucfirst($addr_details['geoplugin_countryCode']));
          $country = stripslashes(ucfirst($addr_details['geoplugin_countryName']));
          }else{
           //$country="India";
           $country=$session['country'];
           }

         \Yii::info("conversion is is: ".$cntry."sessioncountr".$country);
        $basecurrency = $cntry;
        $sesncountry = \frontend\models\Countries::findOne(['name'=>$country]);
        $sesncountrycurid = \backend\models\CountryCurrency::findOne(['country_id'=>$sesncountry['id']]);
        $to_Currency = \backend\models\Currency::findOne(['id'=>$sesncountrycurid['currency_id']]);
        
        $getconversion = \backend\models\CurrencyConversion::find()
                              ->where(['from_currency' => $basecurrency])
                              ->andWhere(['to_currency' => $to_Currency['currency_code']])
                              ->one();
        return $getconversion['to_currency'].'_'.$getconversion['ration'];
    }
             
}