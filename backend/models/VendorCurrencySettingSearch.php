<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VendorCurrencySetting;

/**
 * VendorCurrencySettingSearch represents the model behind the search form about `backend\models\VendorCurrencySetting`.
 */
class VendorCurrencySettingSearch extends VendorCurrencySetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'vid', 'country', 'currency_rate', 'crtby', 'updby'], 'integer'],
            [['currency_rate'], 'integer'],
            [['vid', 'crtdt', 'upddt'], 'safe'],//'currency',
            [['percentaddition'], 'number'],
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
        $query = VendorCurrencySetting::find();

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
            'id' => $this->id,
            'vid' => $this->vid,
            //'country' => $this->country,
            'currency_rate' => $this->currency_rate,
            'percentaddition' => $this->percentaddition,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'base_currency', $this->base_currency])
            ->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
