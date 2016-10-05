<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServicablePincodes;

/**
 * ServicablePincodesSearch represents the model behind the search form about `backend\models\ServicablePincodes`.
 */
class ServicablePincodesSearch extends ServicablePincodes
{
     public $deliverypartner;
     public $city;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pinid', 'dpid', 'cityid', 'pincode', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt','deliverypartner','city'], 'safe'],
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
        $query = ServicablePincodes::find()->groupBy('cityid');
        $query->joinWith(['deliverypartner','cities']); 
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['deliverypartner'] = [        
            'asc' => ['deliverypartner.name' => SORT_ASC],     // relation name
            'desc' => ['deliverypartner.name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['city'] = [        
            'asc' => ['cities.name' => SORT_ASC],     // relation name
            'desc' => ['cities.name' => SORT_DESC],
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pinid' => $this->pinid,
            'dpid' => $this->dpid,
            'cityid' => $this->cityid,
            'pincode' => $this->pincode,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'delivery_partner.name', $this->deliverypartner])    //table name
              ->andFilterWhere(['like', 'cities.name', $this->city]);
        
        return $dataProvider;
    }
}
