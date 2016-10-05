<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pincode;

/**
 * PincodeSearch represents the model behind the search form about `backend\models\Pincode`.
 */
class PincodeSearch extends Pincode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pnid', 'cityid', 'pincode', 'crtby', 'updby'], 'integer'],
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
        $query = Pincode::find()->groupBy('cityid');

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
            'pnid' => $this->pnid,
            'cityid' => $this->cityid,
            'pincode' => $this->pincode,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        return $dataProvider;
    }
}
