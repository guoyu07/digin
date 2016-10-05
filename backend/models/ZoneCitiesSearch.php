<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ZoneCities;

/**
 * ZoneCitiesSearch represents the model behind the search form about `backend\models\ZoneCities`.
 */
class ZoneCitiesSearch extends ZoneCities
{
    public $zone;
    public $city;
    public $deliverypartner;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zid', 'cityid', 'crtby', 'updby', 'dpid'], 'integer'],
            [['crtdt', 'upddt', 'zone','city', 'deliverypartner'], 'safe'],
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
        $query = ZoneCities::find()->groupBy('zid');
        $query->joinWith(['zone', 'deliverypartner', 'cities']);         //zone - name of relation given in model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $dataProvider->sort->attributes['zone'] = [        
//            'asc' => ['zone.name' => SORT_ASC],     // relation name
//            'desc' => ['zone.name' => SORT_DESC],
//        ];
//        $dataProvider->sort->attributes['deliverypartner'] = [        
//            'asc' => ['deliverypartner.name' => SORT_ASC],     // relation name
//            'desc' => ['deliverypartner.name' => SORT_DESC],
//        ];
        
        $dataProvider->setSort([
              'attributes' => [            
                'zone' => [
                    'asc' => ['zone.name' => SORT_ASC],
                    'desc' => ['zone.name' => SORT_DESC],
                    //'label' => 'Order Name'
                ],
               'deliverypartner' => [                                 // relation name
                    'asc' => ['delivery_partner.name' => SORT_ASC],   // table name
                    'desc' => ['delivery_partner.name' => SORT_DESC],
                    //'label' => 'Order Name'
                ]  
            ]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'zid' => $this->zid,
            'dpid' => $this->dpid,
            'cityid' => $this->cityid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);
        
        $query->andFilterWhere(['like', 'zone.name', $this->zone])    //table name
              ->andFilterWhere(['like', 'delivery_partner.name', $this->deliverypartner])
              ->andFilterWhere(['like', 'cities.name', $this->city]);

        return $dataProvider;
    }
    
     public function searchBydp($params, $dpid)
    {
        $query = ZoneCities::find()->groupBy('zid')->where(['zone_cities.dpid'=>$dpid]);
        $query->joinWith(['zone', 'deliverypartner', 'cities']);         //zone - name of relation given in model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([
              'attributes' => [            
                'zone' => [
                    'asc' => ['zone.name' => SORT_ASC],
                    'desc' => ['zone.name' => SORT_DESC],
                    //'label' => 'Order Name'
                ],
               'deliverypartner' => [                                 // relation name
                    'asc' => ['delivery_partner.name' => SORT_ASC],   // table name
                    'desc' => ['delivery_partner.name' => SORT_DESC],
                    //'label' => 'Order Name'
                ]  
            ]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'zid' => $this->zid,
            'dpid' => $this->dpid,
            'cityid' => $this->cityid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);
        
        $query->andFilterWhere(['like', 'zone.name', $this->zone])    //table name
              ->andFilterWhere(['like', 'delivery_partner.name', $this->deliverypartner])
              ->andFilterWhere(['like', 'cities.name', $this->city]);

        return $dataProvider;
    }
}
