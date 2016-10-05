<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $prid
 * @property string $prodname
 * @property integer $categoryid
 * @property string $description
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Product extends \yii\db\ActiveRecord
{
    public $category=null;
    public $path=null;
    public $excelfile=null;
    public $brdnm=null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['prodname', 'categoryid', 'description', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['prodname','description'], 'required'],
            [['isservice', 'crtby', 'updby','Is_active'], 'integer'],
            [['description','keywords','brand'],  'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['prodname'], 'string',  'max' => 255],            
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id],
            
            [['excelfile'], 'safe'],
            [['excelfile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prid' => 'Prid',
            'prodname' => 'Product Name',
            //'categoryid' => 'Category',
            'description' => 'Description',
            'isservice' => 'Is Service',
            'keywords'=>'Keywords',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
             'excelfile' => 'Upload File',
        ];
    }
    
    
    public function getProductCategory($id)
    { 
        $catarray=array();
        $categories='';
        $prodcategories= \backend\models\ProductCategories::find()->where(['prid' => $id])->all();       
        foreach ($prodcategories as $p){        
            $cat= \backend\models\Category::find()->where(['id'=>$p->catid])->all();        
            foreach ($cat as $c)
             {               
                array_push($catarray,$c->path);
             }
        }
        $categories=  implode('<br>', $catarray);        
        return $categories;
    }
    
    /*public function getProduct($prodid)
    {       
        if($this->findOne($prodid)!=null)
            return $this->findOne($prodid)->prodname;                
    }*/
    
    public function getProductDescription($prodid)
    {
        if($this->findOne($prodid)!=null)
        {
            $data=$this->findOne($prodid)->description;
            $strlen=  strlen($data);
            $maxlen=100;
            $desc= $strlen>$maxlen ? substr($data,0,$maxlen)."...":$data;
            return $desc;
        }
    }
    
    
    public function getProductActive($prid)
    {
         if($this->findOne($prid)!=null)
         {
             return $this->findOne($prid)->Is_active;
             
         }
    }
     public function getProductVendorId($crtby)
    {
         
             $vendata=  Vendor::find()->select('vid')->where(['user_id'=>$crtby])->one();
             return $vendata['vid'];                     
    }
    
    public function getBrandName($prid){
          $product = Product::findOne(['prid'=>$prid]);
          $brand = BrandName::findOne(['id'=>$product['brand']]);
          return $brand['brand_name'] ;
        
    }

    /*public function getCategoryPath($id)
    {
        //return $this->category ? $this->category->path : "No Category";
        $catarray=array();
        $categories='';
        $prodcategories= \backend\models\ProductCategories::find()->where(['prid' => $id])->all();       
        foreach ($prodcategories as $p){        
            $cat= \backend\models\Category::find()->where(['id'=>$p->catid])->all();        
            foreach ($cat as $c)
             {       
                //$this->category->path=$c->path;        
                array_push($catarray,$c->path);                
             }
        }
        $categories=  implode('<br>', $catarray);        
        return $categories;
    } */
}
