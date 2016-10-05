<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\GovernDocumentType;

/**
 * GovernDocumentTypeSearch represents the model behind the search form about `backend\models\GovernDocumentType`.
 */
class GovernDocumentTypeSearch extends GovernDocumentType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'crtby', 'updby'], 'integer'],
            [['doc_name', 'crtdt', 'upddt','Is_approved'], 'safe'],
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
        $query = GovernDocumentType::find();

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
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
            'Is_approved' => $this->Is_approved,
        ]);

        $query->andFilterWhere(['like', 'doc_name', $this->doc_name]);

        return $dataProvider;
    }
}
