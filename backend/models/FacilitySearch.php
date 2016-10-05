<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Facility;

/**
 * FacilitySearch represents the model behind the search form about `backend\models\Facility`.
 */
class FacilitySearch extends Facility
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'crtby', 'updtby'], 'integer'],
            [['name', 'description', 'crtdt', 'upddt'], 'safe'],
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
        $query = Facility::find();

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
            /*'crtby' => $this->crtby,
            'crtdt' => $this->crtdt,
            'updtby' => $this->updtby,
            'upddt' => $this->upddt,*/
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
