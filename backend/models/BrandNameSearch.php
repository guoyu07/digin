<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BrandName;

/**
 * BrandNameSearch represents the model behind the search form about `backend\models\BrandName`.
 */
class BrandNameSearch extends BrandName
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'crtby', 'updby'], 'integer'],
            [['brand_name', 'crtdt', 'upddt'], 'safe'],
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
        $query = BrandName::find();

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
            'crtby' => $this->crtby,
            'crtdt' => $this->crtdt,
            'updby' => $this->updby,
            'upddt' => $this->upddt,
        ]);

        $query->andFilterWhere(['like', 'brand_name', $this->brand_name]);

        return $dataProvider;
    }
}
