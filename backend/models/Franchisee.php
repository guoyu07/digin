<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "franchisee".
 *
 * @property integer $frid
 * @property string $name
 * @property string $code
 * @property string $description
 * @property integer $adrid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Franchisee extends \yii\db\ActiveRecord
{
    public $daterange = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'franchisee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'description', 'adrid'], 'required'],
            [['description'], 'string'],
            [['adrid', 'crtby', 'updby','Is_eagreement_sign','signed_by'], 'integer'],
            [['crtdt', 'upddt','fromdate','todate'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 50],
            [['idlogo'], 'file', 'skipOnEmpty' => true],
           // [['idlogo'], 'file'],
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
            'frid' => 'Frid',
            'name' => 'Name',
            'code' => 'Code',
            'description' => 'Description',
            'adrid' => 'Adrid',
            'idlogo' => 'ID',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
             'fromdate'=> 'From  Date',
            'todate'=> 'To Date',
            'daterange'=> 'From-To Date',
            'Is_eagreement_sign' => 'E-Agreement-Sign',
            'signed_by' => 'Signed By'
        ];
    }
    
    public function getEmail($id)
    {
        $email= Address::find()->select('email')->where(['adrid'=>$id])->one();       
        return $email['email'];
    }
    public function getPhone($id)
    {
        $phone= Address::find()->select('phone')->where(['adrid'=>$id])->one();
        return $phone['phone'];
    }
    public function getAddress($id)
    {
        $addressdata= Address::find()->where(['adrid'=>$id])->one();
        $address=$addressdata['address1'].", ".$addressdata['address2'].", ".$addressdata['city'].", ".$addressdata['state'].", ".$addressdata['country'].", ".$addressdata['pin'];
        return $address;
    }
    
   public function getCity($id)
    {
        $city=  \frontend\models\Cities::find()->where(['name'=>$id])->all();
        //var_dump($city);
        return $city['name'];
    }  
    
   public function getState($id)
    {
        $state= \frontend\models\States::find()->where(['name'=>$id])->all();
        //var_dump($city);
        return $state['name'];
    }  
}
