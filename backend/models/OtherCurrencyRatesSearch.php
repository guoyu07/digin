<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OtherCurrencyRates;

/**
 * OtherCurrencyRatesSearch represents the model behind the search form about `backend\models\OtherCurrencyRates`.
 */
class OtherCurrencyRatesSearch extends OtherCurrencyRates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ocid', 'vpid', 'country', 'rate', 'crtby', 'updby'], 'integer'],
            [['currency', 'crtdt', 'upddt'], 'safe'],
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
        $query = OtherCurrencyRates::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ocid' => $this->ocid,
            'vpid' => $this->vpid,
            'country' => $this->country,
            'rate' => $this->rate,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
