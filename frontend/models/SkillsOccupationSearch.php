<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsOccupation;

/**
 * SkillsOccupationSearch represents the model behind the search form about `app\models\SkillsOccupation`.
 */
class SkillsOccupationSearch extends SkillsOccupation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ocid', 'userid', 'tenure', 'crtby', 'updby'], 'integer'],
            [['occupationtype', 'company', 'designation', 'fromdate', 'todate', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsOccupation::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'ocid' => $this->ocid,
            'userid' => $this->userid,
            'tenure' => $this->tenure,
            'fromdate' => $this->fromdate,
            'todate' => $this->todate,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'occupationtype', $this->occupationtype])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'designation', $this->designation]);

        return $dataProvider;
    }
}
