<?php

namespace frontend\controllers;

class ProductdetailController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

     public function actionProductdetails()
     {
         /*$query
         SELECT a.prid,a.prodname,c.image,  
            b.catid  
            FROM product a,product_categories b,product_images c  
            WHERE b.prid=c.prid  
            AND a.prid=4  
         */
         $kmrad = \Yii::$app->params['kmrad'];
         $session=\Yii::$app->session;
         $catid = $_GET['catid'];
         
          if(!isset($session['lat'])|| !isset($session['lng'])){
            $this->storeLatLngById();
          }
          
         $cats=$catid;
         $category=new \backend\models\Category();
         $allcats=$category->getAllChildren($catid);
         $catids = implode(',',$allcats);
          \Yii::info("all====>".$catids  );
         //$catids = $catid;
         $lat=$session['lat'];
         $lng=$session['lng'];
         $url=$_SERVER['SERVER_NAME'];
         //echo "cat=".$catid;
         //$cat = \backend\models\ProductCategories::find()->select($catid)->all();
         $url1="https://".$url."/images/productimages/";
         $query = (new \yii\db\Query())
                 ->select(['a.prid','MIN(NULLIF(vp.price, 0)) as price','v.currencycode as currency', 'a.prodname','CONCAT("'.$url1.'",if(c.image IN (NULL, ""),"default_image.png", CONCAT(a.prid,"/",REPLACE (c.image," ","%20")))) as Image','b.catid','MIN( ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) )) AS distance'])
                 ->from('vendor v')
                 ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                 ->join('inner join', 'product a', 'a.prid=vp.prid')
                  ->join('inner join', 'product_images c', 'c.prid=a.prid')
                 ->join('inner join', 'product_categories b', 'b.prid=a.prid')
                // ->join('inner join',  'product_images c', 'c.prid=b.prid')
                 //->join('inner join', 'category c', 'c.id=b.catid')
                 ->where("b.catid in ($catids)")
                 //->andWhere('c.ismain=1')
                 ->andWhere('v.Is_active=1')
                 ->groupBy('prid')  
                 //->having('distance < '.$kmrad)
                ->orderBy('distance'); 
          // $product=$query->all();  
                  
          $count = $query->count();
          $pagination = new \yii\data\Pagination(['totalCount'=>$count]);
          $query = $query->offset($pagination->offset)
                          ->limit($pagination->limit)
                          ->all();
         // echo $count."agessss".$pagination->pageCount."<br>";
        //$query['totalpages']=$pagination->pageCount;
       // $query['currentpageno']=$pagination->page+1; 
        //echo json_encode($query);
         return $this->render('productdetail', array('product'=>$query, 'pagination'=>$pagination));
       }

      public function storeLatLngById()
      {

       /* $session=\Yii::$app->session;        
        $addr1='Pune, Maharashtra, India';
        $addr_details = unserialize(file_get_contents("https://www.geoplugin.net/php.gp"));
        $city = stripslashes(ucfirst($addr_details['geoplugin_city']));
//        var_dump( $addr_details['geoplugin_request']);
//        var_dump($addr_details['geoplugin_latitude']);
//        var_dump($addr_details['geoplugin_longitude']);
        
        $lato = $addr_details['geoplugin_latitude'];
        $lngo = $addr_details['geoplugin_longitude'];
        $session['lat']=$lato;
        $session['lng']=$lngo;
        $session['addr']=$city; */

        $session=\Yii::$app->session;

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
        \Yii::info('Address'.$addrs_details);  
        $addr_details=json_decode($addrs_details, true);
        \Yii::info('lat'.$addr_details['lat'].'...'.$addr_details['lon']);     
       
        $city = stripslashes(ucfirst($addr_details['city']));

        $lato = $addr_details['lat'];
        $lngo = $addr_details['lon'];
        $session['lat']=$lato;
        $session['lng']=$lngo;
        $session['addr']=$city; 





      
    }
}
