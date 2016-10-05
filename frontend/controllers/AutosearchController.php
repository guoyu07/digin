<?php

namespace frontend\controllers;

class AutosearchController extends \yii\web\Controller
{
    //public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionIndex1()
    {
        return $this->render('index1');
    }

    public function actionSearch()
    {
        $keyword=$_REQUEST['search'];
        $lat=$_REQUEST['currentlat'];
        $lng=$_REQUEST['currentlng'];
        //echo $keyword."...".$lat."....".$lng;
       
        $key="%".$keyword."%";        
          
        $kmrad = \Yii::$app->params['kmrad'];
        $query=new \yii\db\Query;
        
        $query1 = (new \yii\db\Query())                
                //->select('p.prid, p.prodname, ("product") as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
                ->select(['p.prodname as label', 'if(isservice=1,(" in Service"),(" in Product"))as type', 'p.prodname as value', 'CONCAT("Product:", p.prid) as id', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->where('p.prodname LIKE :query')
                ->addParams([':query'=>$key])
              //  ->having('distance < '.$kmrad)
                ->groupBy('vp.prid')
                ->limit('8');
        
        $query2 = (new \yii\db\Query())
               //->select('id, c.name, ("category") as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
               //->select(['CONCAT(c.name, " in Category") as label', '("Category") as type', 'c.name as value', 'CONCAT("Category:", id) as id', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
               ->select(['c.name as label', '(" in Category") as type', 'c.name as value', 'CONCAT("Category:", id) as id', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
               ->from('vendor v')
               ->join('inner join', 'vendor_products p', 'p.vid=v.vid')
               ->join('inner join', 'category c', 'p.catid=c.id')
               ->where('c.name LIKE :query')
               ->addParams([':query'=>$key])
               ->orWhere('c.tags LIKE :query')
               ->addParams([':query'=>$key])
            //   ->having('distance < '.$kmrad)
               ->limit('2'); 
        
        $query3 = (new \yii\db\Query())               
                //->select('vid, v.businessname, ("vendor") as type, ( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance')
                ->select(['v.businessname as label', '(" in Vendor") as type', 'v.businessname as value', 'CONCAT("Vendor:", vid) as id', '( 6371. * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'])
                ->from('vendor v')
                ->where('v.businessname LIKE :query')
                ->addParams([':query'=>$key])
                ->andWhere(['Is_active'=>1])
             //   ->having('distance < '.$kmrad)
                ->limit('2')
                ->orderBy('distance');                              
                    
        
        $query=$query1->union($query2)->union($query3);
        //$query=$query1->union($query3);
        $command=$query->createCommand();        
        $vendor=$command->queryAll();       
        // echo "<br>".sizeof($vendor)."<br><br>";               
        echo json_encode($vendor); 
    }    
}
