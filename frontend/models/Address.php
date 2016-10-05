<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $adrid
 * @property integer $userid
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $pin
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'name', 'email', 'phone', 'address1', 'city', 'state', 'country', 'pin', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['userid', 'pin', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 16],
            [['address1', 'address2'], 'string', 'max' => 50],
            [['city', 'state', 'country'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adrid' => 'Adrid',
            'userid' => 'Userid',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'pin' => 'Pin',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
    
    public function insertAddress($userid,$name,$email,$phone,$addr1,$addr2,$city,$state,$country,$pin)
   {              
        $address=new Address();
        $address->userid=$userid;
        $address->name=$name;
        $address->email=$email;
        $address->phone=$phone;
        $address->address1=$addr1;
        $address->address2=$addr2;
        $address->city=$city;
        $address->state=$state;
        $address->country=$country;
        $address->pin=$pin;
        $address->crtdt=date('Y-m-d H:i:s');
        $address->crtby=$userid;
        $address->upddt=date('Y-m-d H:i:s');
        $address->updby=$userid;    
        
        $success=$address->save();
       
        $address=Address::find()->where(['userid'=>$userid])->orderBy('upddt DESC')->all();       
        $data=array();
        $result=array();
        foreach ($address as $ad)
        {
            $data['adrid']=$ad['adrid'];
            $data['userid']=$ad['userid'];
            $data['name']=$ad['name'];
            $data['email']=$ad['email'];
            $data['phone']=$ad['phone'];
            $data['address1']=$ad['address1'];
            $data['address2']=$ad['address2'];
            $data['city']=$ad['city'];
            $data['state']=$ad['state'];
            $data['country']=$ad['country'];
            $data['pin']=$ad['pin'];
            array_push($result, $data);
        }
       // echo json_encode($result);      
        return $result;
   }
    public function showAddress($userid)
    {
        //$userid=$_GET['userid'];
        //echo $userid."<br>"; 
        $address=Address::find()->where(['userid'=>$userid])
                                ->orderBy('upddt DESC')
                                ->all();        
        $data=array();
        $result=array();
        if(sizeof($address)>0){            
        foreach ($address as $ad)
        {
            $data['adrid']=$ad['adrid'];
            $data['userid']=$ad['userid'];
            $data['name']=$ad['name'];
            $data['email']=$ad['email'];
            $data['phone']=$ad['phone'];
            $data['address1']=$ad['address1'];
            $data['address2']=$ad['address2'];
            $data['city']=$ad['city'];
            $data['state']=$ad['state'];
            $data['country']=$ad['country'];
            $data['pin']=$ad['pin'];
            array_push($result, $data);
        }
        }
     /*   else{            
            $user=  \dektrium\user\models\User::find()->where(['id'=>$userid])->one();            
            $data=['name'=>$user['username'], 'email'=>$user['email'], 'phone'=>$user['phone']];
            array_push($result, $data);
        } */
        //echo json_encode($result);       
        return $result;
    }
}
