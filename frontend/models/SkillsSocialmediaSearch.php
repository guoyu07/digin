<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsSocialmedia;

/**
 * SkillsSocialmediaSearch represents the model behind the search form about `app\models\SkillsSocialmedia`.
 */
class SkillsSocialmediaSearch extends SkillsSocialmedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smid', 'userid', 'crtby', 'updby'], 'integer'],
            [['socialmedia_site', 'link', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsSocialmedia::find();

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
            'smid' => $this->smid,
            'userid' => $this->userid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'socialmedia_site', $this->socialmedia_site])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
