<?php

namespace frontend\api\controllers;

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
         $catid = $_GET['catid'];
         $url=$_SERVER['SERVER_NAME'];
         //echo "cat=".$catid;
         //$cat = \backend\models\ProductCategories::find()->select($catid)->all();
         $url1="http:/".$url."/images/productimages/";
         $query = (new \yii\db\Query())
                 ->select(['a.prid','a.prodname','CONCAT("'.$url1.'",if(c.image IN (NULL, ""),"default_image.png", CONCAT(a.prid,"/",c.image))) as Image','b.catid'])
                 ->from('product a')
                 ->join('inner join', 'product_categories b', 'b.prid=a.prid')
                 ->join('inner join',  'product_images c', 'c.prid=b.prid')
                 ->where(['b.catid'=>$catid]);              
                // ->all();
          $count = $query->count();
          $pagination = new \yii\data\Pagination(['totalCount'=>$count]);
          $query = $query->offset($pagination->offset)
                          ->limit($pagination->limit)
                          ->all();
         // echo $count."agessss".$pagination->pageCount."<br>";
        $query['totalpages']=$pagination->pageCount;
        $query['currentpageno']=$pagination->page+1;
         echo json_encode($query);
     
       }

}
