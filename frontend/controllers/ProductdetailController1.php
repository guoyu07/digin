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
         $lat=$session['lat'];
          $lng=$session['lng'];
         $url=$_SERVER['SERVER_NAME'];
         //echo "cat=".$catid;
         //$cat = \backend\models\ProductCategories::find()->select($catid)->all();
         $url1="http://".$url."/images/productimages/";
         $query = (new \yii\db\Query())
                 ->select(['a.prid','a.prodname','CONCAT("'.$url1.'",if(c.image IN (NULL, ""),"default_image.png", CONCAT(a.prid,"/",urlencode(c.image)))) as Image','b.catid','( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                 ->from('vendor v')
                 ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                 ->join('inner join', 'product a', 'a.prid=vp.prid')
                  ->join('inner join', 'product_images c', 'c.prid=a.prid')
                 ->join('inner join', 'product_categories b', 'b.prid=a.prid')
                // ->join('inner join',  'product_images c', 'c.prid=b.prid')
                 //->join('inner join', 'category c', 'c.id=b.catid')
                 ->where(['b.catid'=>$catid])
                 ->andWhere('c.ismain=1')
                 //->andWhere('v.Is_active=1')
                 ->groupBy('prid')  
                 ->having('distance < '.$kmrad)
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

}
