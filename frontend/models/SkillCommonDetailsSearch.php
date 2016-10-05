<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillCommonDetails;

/**
 * SkillCommonDetailsSearch represents the model behind the search form about `app\models\SkillCommonDetails`.
 */
class SkillCommonDetailsSearch extends SkillCommonDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'birthplaceid', 'religionid', 'faithid', 'castid'], 'integer'],
            [['birthdate', 'sex', 'marrital_status', 'blog', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillCommonDetails::find();

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
            'userid' => $this->userid,
            'birthdate' => $this->birthdate,
            'birthplaceid' => $this->birthplaceid,
            'religionid' => $this->religionid,
            'faithid' => $this->faithid,
            'castid' => $this->castid,
            'landline' => $this->landline,
            'annual_income' => $this->annual_income,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'marrital_status', $this->marrital_status])
            ->andFilterWhere(['like', 'blog', $this->blog]);

        return $dataProvider;
    }
}
