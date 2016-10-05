<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsHealthdetails;

/**
 * SkillsHealthdetailsSearch represents the model behind the search form about `app\models\SkillsHealthdetails`.
 */
class SkillsHealthdetailsSearch extends SkillsHealthdetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hid', 'userid', 'crtby', 'updby'], 'integer'],
            [['bloodgroup', 'medication', 'crtdt', 'upddt'], 'safe'],
            [['height', 'weight'], 'number'],
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
        $query = SkillsHealthdetails::find();

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
            'hid' => $this->hid,
            'userid' => $this->userid,
            'height' => $this->height,
            'weight' => $this->weight,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'medication', $this->medication]);
           

        return $dataProvider;
    }
}
