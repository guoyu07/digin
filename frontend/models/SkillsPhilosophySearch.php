<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsPhilosophy;

/**
 * SkillsPhilosophySearch represents the model behind the search form about `app\models\SkillsPhilosophy`.
 */
class SkillsPhilosophySearch extends SkillsPhilosophy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phid', 'userid', 'crtby', 'updby'], 'integer'],
            [['philosophytext', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsPhilosophy::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'phid' => $this->phid,
            'userid' => $this->userid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'philosophytext', $this->philosophytext]);

        return $dataProvider;
    }
}
