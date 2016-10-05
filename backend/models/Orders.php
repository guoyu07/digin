<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $orid
 * @property integer $displayid
 * @property string $transref
 * @property double $total
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['displayid', 'transref', 'total', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['displayid', 'userid', 'crtby', 'updby'], 'integer'],
            [['total', 'shipment', 'grosstotal', 'payumoneyid'], 'number'],
            [['crtdt', 'upddt'], 'safe'],
            [['errorcode'], 'string'],
            [['transref', 'status'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orid' => 'Orid',
            'userid'=> 'Userid',
            'displayid' => 'Displayid',
            'transref' => 'Transref',
            'total' => 'Total',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
    
    public function Getlastshippedaddress($userid)
    {
        //$userid=$_GET['userid'];
        
        $query = (new \yii\db\Query())   
               ->select(['name','pin','orid'])
               ->from('orders o')
               ->join('inner join','address a', 'o.adrid=a.adrid')
               ->where(['o.userid'=>$userid])
               ->orderBy('o.upddt DESC');                              
        
        $data=$query->one();
               
        if(!$data){
            $query = (new \yii\db\Query())   
               ->select(['pin'])
               ->from('address')
               ->where(['userid'=>$userid])
               ->orderBy('upddt DESC');  
        $data=$query->one();
        //echo "0";
        }
        //var_dump($data);
        return $data['pin'];
        
        }
}
