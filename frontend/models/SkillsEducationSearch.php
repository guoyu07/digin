<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsEducation;

/**
 * SkillsEducationSearch represents the model behind the search form about `app\models\SkillsEducation`.
 */
class SkillsEducationSearch extends SkillsEducation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eid', 'userid', 'crtby', 'updby'], 'integer'],
            [['qualification', 'institute', 'year', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsEducation::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'eid' => $this->eid,
            'userid' => $this->userid,
            'year' => $this->year,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'institute', $this->institute]);

        return $dataProvider;
    }
}
