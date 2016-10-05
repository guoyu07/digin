<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DeliveryPartner;

/**
 * DeliveryPartnerSearch represents the model behind the search form about `backend\models\DeliveryPartner`.
 */
class DeliveryPartnerSearch extends DeliveryPartner
{  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dpid', 'crtby', 'updby'], 'integer'],
            [['name', 'crtdt', 'upddt'], 'safe'],
            [['fuelsurcharge', 'CODmin', 'COD', 'RTOCharge', 'reversepickupsurcharge', 'COF', 'volwtdenominator', 'octroisurcharge', 'holidaydeliverycharge'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DeliveryPartner::find()->where(['!=','dpid',1]);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);      
         
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'dpid' => $this->dpid,
            'fuelsurcharge' => $this->fuelsurcharge,
            'CODmin' => $this->CODmin,
            'COD' => $this->COD,
            'RTOCharge' => $this->RTOCharge,
            'reverse-pickupsurcharge' => $this->reversepickupsurcharge,
            'COF' => $this->COF,
            'volwtdenominator' => $this->volwtdenominator,
            'octroisurcharge' => $this->octroisurcharge,
            'holidaydeliverycharge' => $this->holidaydeliverycharge,            
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
