<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RoiA;

/**
 * RoiASearch represents the model behind the search form about `backend\models\RoiA`.
 */
class RoiASearch extends RoiA
{
    public $deliverypartner;
    public $city;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dpid', 'cityid', 'crtby', 'updby'], 'integer'],
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
        $query = RoiA::find()->groupBy('dpid');
        $query->joinWith(['deliverypartner','cities']);         //deliverypartner - name of relation given in model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['deliverypartner'] = [   // relation name    
            'asc' => ['delivery_partner.name' => SORT_ASC],     // table name
            'desc' => ['delivery_partner.name' => SORT_DESC],   
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dpid' => $this->dpid,
            'cityid' => $this->cityid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'delivery_partner.name', $this->deliverypartner])    //table name
              ->andFilterWhere(['like', 'cities.name', $this->city]);
          
        return $dataProvider;
    }
    
    public function searchBydp($params, $dpid)
    {
        $query = RoiA::find()->groupBy('dpid')->where(['roia.dpid'=>$dpid]);
        $query->joinWith(['deliverypartner','cities']);         //deliverypartner - name of relation given in model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['deliverypartner'] = [   // relation name    
            'asc' => ['delivery_partner.name' => SORT_ASC],     // table name
            'desc' => ['delivery_partner.name' => SORT_DESC],   
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dpid' => $this->dpid,
            'cityid' => $this->cityid,
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
