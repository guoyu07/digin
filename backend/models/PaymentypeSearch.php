<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Paymentype;

/**
 * PaymentypeSearch represents the model behind the search form about `backend\models\Paymentype`.
 */
class PaymentypeSearch extends Paymentype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptid', 'type', 'crtby', 'updby'], 'integer'],
            [['description', 'crtdt', 'upddt'], 'safe'],
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
        $query = Paymentype::find();

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
            'ptid' => $this->ptid,
            'type' => $this->type,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
