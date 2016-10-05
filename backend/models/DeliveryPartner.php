<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "delivery_partner".
 *
 * @property integer $dpid
 * @property string $name
 * @property double $fuelsurcharge
 * @property double $CODmin
 * @property double $COD
 * @property double $RTOCharge
 * @property double $reverse-pickupsurcharge
 * @property double $COF
 * @property double $volwtdenominator
 * @property double $octroisurcharge
 * @property double $holidaydeliverycharge
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class DeliveryPartner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'emailid', 'fuelsurcharge', 'CODmin', 'COD', 'RTOCharge', 'reversepickupsurcharge', 'COF', 'volwtdenominator', 'octroisurcharge', 'holidaydeliverycharge'], 'required'],
            [['fuelsurcharge', 'CODmin', 'COD', 'RTOCharge', 'reversepickupsurcharge', 'COF', 'volwtdenominator', 'octroisurcharge', 'holidaydeliverycharge'], 'number'],
            [['crtdt', 'upddt'], 'safe'],
            [['crtby', 'updby'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['emailid'], 'string', 'max' => 150],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dpid' => 'Dpid',
            'name' => 'Name',
            'emailid' => 'Email Address',
            'fuelsurcharge' => 'Fuel Surcharge',
            'CODmin' => 'Minimum COD Percentage',
            'COD' => 'COD charge',
            'RTOCharge' => 'RTO Charge',
            'reversepickupsurcharge' => 'Reverse Pickup Surcharge',
            'COF' => 'Risk Surcharge or COF',
            'volwtdenominator' => 'Volumetric Weight Divider',
            'octroisurcharge' => 'Octroi Surcharge',
            'holidaydeliverycharge' => 'Holiday Delivery Charges',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
    
    public function getApplicability($pin1,$pin2,$city)
    {
        $zone=new ZoneCities();
        $cities=new \frontend\models\Cities();
        $metro=new Metro();
        $roia=new RoiA();
        $roib=new RoiB();
        $spcld=new Specialdestination();
        
        $result='';
        
        if($result==""){
            if ($pin1!=""){ 
                $result=$cities->isinCity($pin1, $pin2);
            }
            else{                
                $result=$cities->isinCitybycity($city, $pin2);
            }
        }
        
        if($result==""){
            if ($pin1!=""){                  
                $result=$zone->isinZone($pin1, $pin2);
            }
            else {                
                $result=$zone->isinZonebycity($city,$pin2);
            }
        }
        
        if($result==""){
            if ($pin1!=""){   
                $result=$metro->isinMetro($pin1, $pin2);
            }
            else {                 
                $result=$metro->isinMetrobycity($city,$pin2);
            }
        } 
        
        if($result==""){
            if ($pin1!=""){          
                $result=$roia->isinRoiA($pin1, $pin2);
            }
            else {            
                $result=$roia->isinRoiAbycity($city,$pin2);
            }
        }
        
        if($result==""){
            if ($pin1!=""){          
                $result=$roib->isinRoiB($pin1, $pin2);
            }
            else {            
                $result=$roib->isinRoiBbycity($city,$pin2);
            }
        }
        
        if($result==""){
            if ($pin1!=""){          
                $result=$spcld->isinSpecialdest($pin1, $pin2);
            }
            else {            
                $result=$spcld->isinSpecialdestbycity($city,$pin2);
            }
        }
        
        return $result;          
    }
}
