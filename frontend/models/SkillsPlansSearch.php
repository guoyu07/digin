<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsPlans;

/**
 * SkillsPlansSearch represents the model behind the search form about `app\models\SkillsPlans`.
 */
class SkillsPlansSearch extends SkillsPlans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['planid', 'userid', 'crtby', 'updby'], 'integer'],
            [['plantype', 'description', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsPlans::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'planid' => $this->planid,
            'userid' => $this->userid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'plantype', $this->plantype])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
