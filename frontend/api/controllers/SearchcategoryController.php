<?php

namespace frontend\api\controllers;

class SearchcategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

     public function actionGetcategory()
     {
            //$category = new \backend\models\Category();
           /* $sql="SELECT c1.id, c1.name, c1.parentid,(select name from category WHERE id=c1.parentid ) as parentcategoryname FROM category AS c1 INNER JOIN category AS c2 ON c1.id = c2.Id";
            $data = $category->findBySql($sql)->all();
            //var_dump($data);parentid
            $result=array();
            foreach ($data as $dt)
            {
                array_push($result, ['id'=>$dt['id']]);
                array_push($result, ['name'=>$dt['name']]);
                array_push($result, ['parentid'=>$dt['parentid']]);
            }
             echo json_encode($result);*/
         
    /*  $subQuery = (new \yii\db\Query())
                  ->select('c2.nam')                  
                  ->from('category c1')
                  ->join('inner join','category c2','c1.id=c2.id')
                  ->where('c2.id=c1.parentid')
                  ->all();
                 // ->one();
          var_dump($subQuery);*/
         //'select name from category WHERE id=c1.parentid
     
       $rows = (new \yii\db\Query())
               ->select(['c1.id', 'c1.name','c1.parentid'])
               ->from('category c1')
               ->join('inner join','category c2','c1.id=c2.id')
               ->all();
       $result=array();
       $output=array();
       foreach ($rows as $r)
       {
                $result['id']=$r['id'];
                $result['name']=$r['name'];
                $result['parentid']=$r['parentid'];                
                if($r['parentid']!=0)
                {
                    $pnm=  \backend\models\Category::find()->select('name')->where(['id'=>$r['parentid']])->one();                    
                    $result['parentname']=$pnm['name'];          
                }
                else{                     
                     $result['parentname']='ROOT';        
                }
                array_push($output, $result);
       }
       echo json_encode($output);
                //echo json_encode($rows);
               //var_dump($rows);
     }
}
