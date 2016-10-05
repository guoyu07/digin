<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsPassport;

/**
 * SkillsPassportSearch represents the model behind the search form about `app\models\SkillsPassport`.
 */
class SkillsPassportSearch extends SkillsPassport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'userid', 'passport_no', 'crtby', 'updby'], 'integer'],
            [['nationality', 'issuedate', 'expirydate', 'scancopy', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsPassport::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'pid' => $this->pid,
            'userid' => $this->userid,
            'passport_no' => $this->passport_no,
            'issuedate' => $this->issuedate,
            'expirydate' => $this->expirydate,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'scancopy', $this->scancopy]);

        return $dataProvider;
    }
}
