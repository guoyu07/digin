<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsVehicles;

/**
 * SkillsVehiclesSearch represents the model behind the search form about `app\models\SkillsVehicles`.
 */
class SkillsVehiclesSearch extends SkillsVehicles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vcid', 'userid', 'registration_no', 'crtby', 'updby'], 'integer'],
            [['vehicle_type', 'make', 'year', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsVehicles::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'vcid' => $this->vcid,
            'userid' => $this->userid,
            'year' => $this->year,
            'registration_no' => $this->registration_no,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'vehicle_type', $this->vehicle_type])
            ->andFilterWhere(['like', 'make', $this->make]);

        return $dataProvider;
    }
}
