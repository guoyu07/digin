<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsGovernmentIds;

/**
 * SkillsGovernmentIdsSearch represents the model behind the search form about `app\models\SkillsGovernmentIds`.
 */
class SkillsGovernmentIdsSearch extends SkillsGovernmentIds
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'userid', 'governdoc_type', 'govern_no', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
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
        $query = SkillsGovernmentIds::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'gid' => $this->gid,
            'userid' => $this->userid,
            'governdoc_type' => $this->governdoc_type,
            'govern_no' => $this->govern_no,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        return $dataProvider;
    }
}
