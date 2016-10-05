<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $crtby
 * @property string $crtdt
 * @property integer $updby
 * @property string $upddt
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'countryid', 'charge', 'year'], 'required'],
            [['description'], 'string'],
            [['crtby', 'updby', 'countryid', 'year'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['charge','digin_commision'], 'number'],
            
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
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'countryid' => 'Country',
            'charge' => 'Charge',
            'crtby' => 'Crtby',
            'crtdt' => 'Crtdt',
            'updby' => 'Updby',
            'upddt' => 'Upddt',
        ];
    }
    public function getVendorPlan($id)
    {
        if($this->findOne($id)!=null)
           // return $this->findOne($id)->name;        
            echo $this->findOne($id)->name;  
    }
    
    public function getCountry($id)
    {         
         $country=  \frontend\models\Countries::find()->where(['id'=>$id])->one();
         return $country['name'];      
    }

    public function getFeaturelist($id)
    {
         //$feature=array();
         $featurelist='';
         $planfeature= PlanFeatures::find()->where(['planid'=>$id])->all();
         foreach ($planfeature as $pf){   
             $features=  Features::find()->where(['id'=>$pf['featureid']])->one();
             //array_push($feature, $features['name']);
            $featurelist.='<span>'.$features['name'].'</span><br>';
        }
        //$featurelist=  implode(', ', $feature);    // to show with comma separated.
        return $featurelist;       
    }
}
