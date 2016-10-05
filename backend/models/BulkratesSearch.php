<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bulkrates;

/**
 * BulkratesSearch represents the model behind the search form about `backend\models\Bulkrates`.
 */
class BulkratesSearch extends Bulkrates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pkgid', 'crtby', 'updby'], 'integer'],
            [['withincityrate', 'zonerate', 'metrorate', 'RoIArate', 'RoIBrate', 'spldestrate', 'minimumweight', 'weightmultiple'], 'number'],
            [['crtdt', 'upddt'], 'safe'],
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
        $query = Bulkrates::find();

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
            'id' => $this->id,
            'pkgid' => $this->pkgid,
            'withincityrate' => $this->withincityrate,
            'zonerate' => $this->zonerate,
            'metrorate' => $this->metrorate,
            'RoIArate' => $this->RoIArate,
            'RoIBrate' => $this->RoIBrate,
            'spldestrate' => $this->spldestrate,
            'minimumweight' => $this->minimumweight,
            'weightmultiple' => $this->weightmultiple,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        return $dataProvider;
    }
}
