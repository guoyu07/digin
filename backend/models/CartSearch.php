<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cart;

/**
 * CartSearch represents the model behind the search form about `backend\models\Cart`.
 */
class CartSearch extends Cart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'userid', 'vpid', 'quantity', 'crtby', 'updby'], 'integer'],
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
        $query = Cart::find();

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
            'cid' => $this->cid,
            'userid' => $this->userid,
            'vpid' => $this->vpid,
            'quantity' => $this->quantity,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        return $dataProvider;
    }
}
