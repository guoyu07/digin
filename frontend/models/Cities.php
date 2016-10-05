<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property integer $state_id
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'state_id'], 'required'],
            [['state_id'], 'integer'],
            [['name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'id' => 'City',
            'name' => 'Name',
            'state_id' => 'State ID',
        ];
    }
    
    
    public function isinCity($pin1,$pin2)
    {
        
        $venpin= \backend\models\Pincode::find()->where(['pincode'=>$pin1])->one();       
        $buyerpin= \backend\models\Pincode::find()->where(['pincode'=>$pin2])->one();
        $city1= Cities::find()->where(['id'=>$venpin['cityid']])->one();
        $city2= Cities::find()->where(['id'=>$buyerpin['cityid']])->one();
        
        if($city1['id']==$city2['id'])
        {            
            return 'City';
        }
        else{
            return false;
        }         
    }
    
    public function isinCitybycity($city,$pin2)
    {        
        
         //$vencity=  \frontend\models\Cities::find()->where(['name'=>$city])->one();       
         $cityname="%".$city."%"; 
         $vencity=  \frontend\models\Cities::find()->where('name LIKE :query')
                                                   ->addParams([':query'=>$cityname])->one();       
         $buyerpin= \backend\models\Pincode::find()->where(['pincode'=>$pin2])->one();
         $city1= Cities::find()->where(['id'=>$vencity['id']])->one();
         $city2=  Cities::find()->where(['id'=>$buyerpin['cityid']])->one();
         
         if($city1['id']==$city2['id'])
        {             
            return 'City';
        }
        else{
            return false;
        }        
    }
}
