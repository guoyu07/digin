<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsSpouse;

/**
 * SkillsSpouseSearch represents the model behind the search form about `app\models\SkillsSpouse`.
 */
class SkillsSpouseSearch extends SkillsSpouse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spid', 'userid', 'crtby', 'updby'], 'integer'],
            [['firstname', 'lastname', 'link', 'anniversary_date', 'relation','crtdt', 'upddt'], 'safe'],
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
        $query = SkillsSpouse::find();

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
            'spid' => $this->spid,
            'userid' => $this->userid,
            'anniversary_date' => $this->anniversary_date,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
