<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsSibblings;

/**
 * SkillsSibblingsSearch represents the model behind the search form about `app\models\SkillsSibblings`.
 */
class SkillsSibblingsSearch extends SkillsSibblings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sibid', 'userid', 'crtby', 'updby'], 'integer'],
            [['firstname', 'lastname', 'link', 'relation', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsSibblings::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'sibid' => $this->sibid,
            'userid' => $this->userid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'relation', $this->relation]);

        return $dataProvider;
    }
}
