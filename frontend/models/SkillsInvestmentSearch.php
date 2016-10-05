<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsInvestment;

/**
 * SkillsInvestmentSearch represents the model behind the search form about `app\models\SkillsInvestment`.
 */
class SkillsInvestmentSearch extends SkillsInvestment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invid', 'userid', 'crtby', 'updby'], 'integer'],
            [['investment_type', 'description', 'crtdt', 'upddt'], 'safe'],
            [['valuation'], 'number'],
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
        $query = SkillsInvestment::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'invid' => $this->invid,
            'userid' => $this->userid,
            'valuation' => $this->valuation,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'investment_type', $this->investment_type])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
