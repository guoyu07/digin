<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Diginleads;

/**
 * diginleadSearch represents the model behind the search form about `backend\models\Diginleads`.
 */
class diginleadSearch extends Diginleads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vid'], 'integer'],
            [['leadType', 'leadName', 'leadEmail', 'leadPhone', 'crtdt'], 'safe'],
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
        $query = Diginleads::find();

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
            'crtdt' => $this->crtdt,
        ]);

        $query->andFilterWhere(['like', 'leadType', $this->leadType])
            ->andFilterWhere(['like', 'leadName', $this->leadName])
            ->andFilterWhere(['like', 'leadEmail', $this->leadEmail])
            ->andFilterWhere(['like', 'leadPhone', $this->leadPhone]);

        return $dataProvider;
    }
}
