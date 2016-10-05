<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parentid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Category extends \yii\db\ActiveRecord
{
    
    public $category=null;
    public $parent = null;
    public $cat=array();
    public $usedcategory=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['name', 'parentid', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['name', 'parentid'], 'required'],
            [['status', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt','parentid'], 'safe'],
            [['name','tags','parent'], 'string', 'max' => 100],
            [['description', 'path'],'string'],
            [['image'], 'file', 'skipOnEmpty' => true],
                        
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id]
        ];
    }
    
    /*public function getParentCategory() {
        return $this->hasOne(self::className(), ['parentid'=>'id']);
    }*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           // 'id' => 'ID',
            'name' => 'Title',
            'parentid' => 'Parent Category',
            'description' => 'Description',
            'tags' => 'Tags',
            'image' => 'Image',
            'status' => 'Status',
           /* 'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',*/
        ];
    }
    
    public function getParentName($id)
    {
        if($this->findOne($id)!=null)
            return $this->findOne($id)->name;
        else {
            return "Root";
        }
    }


    public function getCategoryDescription($id)
    {
        if($this->findOne($id)!=null)
        {
            $data=$this->findOne($id)->description;
            $strlen=  strlen($data);
            $maxlen=30;
            $desc= $strlen>$maxlen ? substr($data,0,$maxlen)."...":$data;
            return $desc;
        }
    }
    
    public function getCategoryTags($id)
    {
        if($this->findOne($id)!=null)
        {
            $data=$this->findOne($id)->tags;
            $strlen=  strlen($data);
            $maxlen=20;
            $tags= $strlen>$maxlen ? substr($data,0,$maxlen)."...":$data;
            return $tags;
        }
    }
    public function getCategoryStatus($id)
    {
         if($this->findOne($id)!=null)
         {
             return $this->findOne($id)->status;
             
         }
    }
    public function getCategoryPath($id)
    {
        if($this->findOne($id)!=null)
        {
            $data=$this->findOne($id)->path;
            $strlen=  strlen($data);
            $maxlen=15;           
            if($strlen>33)
            {
                $path1=substr($data,0,$maxlen);
                          
                $path2=substr($data, -$maxlen,$maxlen);
                
                $path=$path1."...".$path2;
                
            }
            else{
                //echo $data;
                $path=$data;
            }
            return $path;
        }
    }
    
    public function getFacility($id)
    {
        $facarray=array();
        $facilities='';
        $catfacility= CategoryFacilities::find()->where(['catid' => $id])->all();
        foreach ($catfacility as $d){        
            $fac=Facility::find()->where(['id'=>$d->facid])->all();
            //var_dump($fac);
            foreach ($fac as $f)
             {               
                array_push($facarray,$f->name);
             }
        }
        $facilities=  implode(', ', $facarray);        
        return $facilities;
    }
    
   public function getAllChildren($catid)
   {
          $cats=$catid;
          $allcats=array();
          $currentcats=array();
          array_push( $allcats,$catid);
         $intialquery = (new \yii\db\Query())
                        ->select(['id'])
                        ->from('category')
                        ->where("parentid in ($cats)");
          $catidreturned = $intialquery->all();              
          \Yii::info("====>".sizeOf($catidreturned ) );
          
          $i=0;        
         while(sizeOf($catidreturned ) > 0 && $i <=3 )
         {
           
           foreach ($catidreturned as $categoryid )
           {
               array_push( $allcats,$categoryid['id']);
               array_push( $currentcats,$categoryid['id']);
           }
           $cats= implode(',', $currentcats);
            $intialquery1 = (new \yii\db\Query())
                        ->select(['id'])
                        ->from('category')
                         ->where("parentid in ($cats)");
            $catidreturned = $intialquery1->all(); 
            $currentcats=array();
            \Yii::info("====>".sizeOf($catidreturned ) );
            $i++;
         } 
         
         return $allcats;
   }
   
    public function hasProducts($catid)
    {
        $hasProducts=false;
        $allCats= array();
        $allCats = $this->getAllChildren($catid);
        // \Yii::info('======><======');
        
        if($allCats!== NULL && !empty($allCats) && sizeOf($allCats)>0)
        {
                // \Yii::info('======><======');
               // var_dump($allCats);
	        $cats = implode(",",$allCats);
	         $prodcatquery = (new \yii\db\Query())
	                        ->from('product_categories pc')
	                        //->join('left join', 'product_images c', 'c.prid=pc.prid')
	                        ->where("pc.catid in ($cats)");
	          $products= $prodcatquery->all(); 
	           
	          if (sizeOf($products)>0)
	          {
	             $hasProducts=true;
	          }
        }
        
         // \Yii::info("Prod===".$catid."====>".sizeOf( $products) );
        return $hasProducts;
    }

   public function category_list()
    {
        //$sql="SELECT c1.parentid, (select name from category where id=c1.parentid) as parentname, group_CONCAT(c1.id, ' : ', c1.name) as catid from category AS c1 INNER JOIN category AS c2 ON c1.id = c2.id group by c1.parentid";
        $rows = (new \yii\db\Query())
               ->select(["COUNT( * ) AS prodcount",'c1.parentid', "GROUP_CONCAT(c1.id, ':', c1.name) as catid"])
               ->from('category c1')
               ->join('inner join','category c2','c1.id=c2.id')
               //->join('inner join','product_categories pc','c1.id=pc.catid')
               ->where(['not in','c1.parentid','0'])
               ->andWhere(['!=','c1.parentid',1])
               //->limit(10)
               ->groupBy('c1.parentid')
               //->groupBy('pc.catid')
              ->orderBy('prodcount DESC')
               ->all();  
        
       /* SELECT COUNT( * ) AS prodcount, pc.`catid` , c.path
FROM  `product_categories` pc
INNER JOIN category c ON pc.catid = c.id
GROUP BY pc.`catid` 
ORDER BY prodcount DESC 
LIMIT 0 , 30*/

        
        
        
        
        
        $result=array();
        $output=array();
        $catassoc=array();
        $category=array();
        $categorydone=array();
        $count=0;
        foreach ($rows as $r)
        {    
            $cats= explode(":",$r['catid']); 
              // \Yii::info("Cat====>".$cats[0] );
            
             if( $this->hasProducts($cats[0]))
             {
	              if($r['parentid']!=1)
	              {                  
	                  $pnm=  \backend\models\Category::find()->select('name')->where(['id'=>$r['parentid']])->one();                                    
	                  $result['parent']=$r['parentid'].":".$pnm['name'];
	              }
	              else{                  
	                   $result['parent']=$r['parentid'].":".'Main';
	              }
	             
	              $result['catid']=$r['catid'];   
	              $this->cat[$result['parent']]=$result['catid'];
           }
             
         }                   
         //echo json_encode($this->cat);
        
        
       //  $htmldata="<ul class='lvl'>";
         $htmldata="<ul class='lvl'><li><a href='index.php?r=site/viewallproducts'>Categories<span class='fa fa-chevron-down iconcart1'></span></a><ul>";
          foreach ($this->cat as $c=>$v)
          {   
              //echo "Processing...".$c;
              if($count==10)
                break;
              $parent=  explode(":", $c)[1];              
              if(!in_array($c, $this->usedcategory)){
              $htmldata.="<li class='lvl_1'><b><a href='index.php?r=productdetail/productdetails&catid=".explode(":",$c)[0]."'>$parent<span class='fa fa-chevron-right iconcart2'></span></a></b><ul class='mrgn".($count+1)."'>";            
              $res=  $this->createlist($c,'lvl_2');
              //unset($this->category[$c]);
              $htmldata.=$res."</ul></li>";//to display ROOT Category.              
              }
             $count++; 
          }
        //  $htmldata.='</ul>';
          $htmldata.='<li><a href="index.php?r=site/viewallproducts">View All</a></li>';
          $htmldata.='</ul></li></ul>';
         //echo $htmldata;
       return $htmldata;
    }

     
   public function category_listmobile()
    {
        //$sql="SELECT c1.parentid, (select name from category where id=c1.parentid) as parentname, group_CONCAT(c1.id, ' : ', c1.name) as catid from category AS c1 INNER JOIN category AS c2 ON c1.id = c2.id group by c1.parentid";
        $rows = (new \yii\db\Query())
               ->select(['c1.parentid', "GROUP_CONCAT(c1.id, ':', c1.name) as catid"])
               ->from('category c1')
               ->join('inner join','category c2','c1.id=c2.id')
               ->where(['not in','c1.parentid','0'])
               ->andWhere(['!=','c1.parentid',1])
               //->limit(10)
               ->groupBy('c1.parentid')
               ->all();  
        
        $result=array();
        $output=array();
        $catassoc=array();
        $category=array();
        $categorydone=array();
        $count=0;
        foreach ($rows as $r)
        {      
            
              if($r['parentid']!=1)
              {                  
                  $pnm=  \backend\models\Category::find()->select('name')->where(['id'=>$r['parentid']])->one();                                    
                  $result['parent']=$r['parentid'].":".$pnm['name'];
              }
              else{                  
                   $result['parent']=$r['parentid'].":".'Main';
              }
             
              $result['catid']=$r['catid'];   
              $this->cat[$result['parent']]=$result['catid'];
              
             
         }                   
         //echo json_encode($this->cat);
        
        
       //  $htmldata="<ul class='lvl'>";
         $htmldata="<ul class='lvl'><li><a href=''>Categories<i class='fa fa-chevron-down iconcart1' ></i></a><ul class='cat-main'>";
          foreach ($this->cat as $c=>$v)
          {   
              //echo "Processing...".$c;
              if($count==10)
                break;
              $parent=  explode(":", $c)[1];              
              if(!in_array($c, $this->usedcategory)){
              $htmldata.="<li class='lvl_1' id='changeicon'><b><a href='index.php?r=productdetail/productdetails&catid=".explode(":",$c)[0]."'>$parent</a><span class='touchbutton' id='touchico'></span></b><ul class='cat-menu-sub'>";            
              $res=  $this->createlist($c,'lvl_2');
              //unset($this->category[$c]);
              $htmldata.=$res."</ul></li>";//to display ROOT Category.              
              }
             $count++; 
          }
        //  $htmldata.='</ul>';
          $htmldata.='<li><a href="index.php?r=site/viewallproducts">View All</a></li>';
          $htmldata.='</ul></li></ul>';
         //echo $htmldata;
       return $htmldata;
    }
    

    
    /*******recursive function*********/
    public function createlist($id,$lvl)
    {   
        $html='';
        $htmlstr='';
        $returnhtml='';
         $childcats=array(); 
         $usedcats=array();
        
       // if(isset($this->category[$id])){     //old condition      
        if(isset($this->cat[$id]) && !in_array($id, $this->usedcategory) ){
            $childcats=  explode(',', $this->cat[$id]);
            //unset($this->category[$id]);    //to delete element
            array_push($this->usedcategory, $id);
            // echo "Deleted catid..".$id;
           // var_dump($childcats);
            $i=0;
            foreach ($childcats as $c)
            {   
                if($i==10)
                    break;
                if(isset($this->cat[$c]) && !in_array($c, $this->usedcategory)){
                    $parentin= explode(":",$c)[1];                                                    
                  $returnhtml.="<li class='".$lvl."' id='changeicon1'><b><a href='index.php?r=productdetail/productdetails&catid=".explode(":",$c)[0]."'>$parentin</a><span class='touchbutton dropdown-toggle' data-toggle='dropdown'></span></b><ul>"; 
                  $lvlarr=explode('_',$lvl);
                  $lvlinner=  intval($lvlarr[1])+1;
                  $lvlinnerstr='lvl_'.$lvlinner;                
                  $htmlstr=$this->createlist($c,$lvlinnerstr);
                  $returnhtml.=$htmlstr."</ul></li>";                   
                 }
                else{                   
                    $cat= explode(':', $c);
                    if(isset($cat[1]))
                      $returnhtml.='<li class="'.$lvl.'"><a href="index.php?r=productdetail/productdetails&catid='.$cat[0].'">'.$cat[1].'</a></li>';                 
                    else{
                      $returnhtml.='<li class="'.$lvl.'"><a href="index.php?r=productdetail/productdetails&catid='.$cat[0].'">'.$cat[0].'</a></li>';
                    }                                
                } 
                $i++;
            }
        }      
          return $returnhtml;          
    }
	
	   
    public function getVenderCatActive($id)
    {
         if($this->findOne($id)!=null)
         {
             return $this->findOne($id)->status;
             
         }
    }
	
	 public function getCategoryStatusVen($id)
    {
        $rows = (new \yii\db\Query())
               ->select(['prid','catid'])
               ->from('product_categories')
               ->where(['prid'=>$id])			   
               ->one();  
		$catid = $rows['catid'];
		$query = \backend\models\Category::find()->where(["id"=>$catid])->one();
		
		return $query['status'];
    }
	
}
