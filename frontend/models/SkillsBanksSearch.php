<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SkillsBanks;

/**
 * SkillsBanksSearch represents the model behind the search form about `app\models\SkillsBanks`.
 */
class SkillsBanksSearch extends SkillsBanks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid', 'userid', 'account_no', 'crtby', 'updby'], 'integer'],
            [['bankname', 'branchname', 'IFSC_no', 'crtdt', 'upddt'], 'safe'],
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
        $query = SkillsBanks::find()->where(['crtby'=>Yii::$app->user->identity->id]);

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
            'bid' => $this->bid,
            'userid' => $this->userid,
            'account_no' => $this->account_no,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'bankname', $this->bankname])
            ->andFilterWhere(['like', 'branchname', $this->branchname])
            ->andFilterWhere(['like', 'IFSC_no', $this->IFSC_no]);

        return $dataProvider;
    }
}
