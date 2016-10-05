<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Packagerates;

/**
 * PackageratesSearch represents the model behind the search form about `backend\models\Packagerates`.
 */
class PackageratesSearch extends Packagerates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rid', 'pkgid', 'crtby', 'updby'], 'integer'],
            [['withincityrate', 'zonerate', 'metrorate', 'RoIArate', 'RoIBrate', 'spldestrate', 'addweightmultiple', 'addwithincityrate', 'addzonerate', 'addmetrorate', 'addRoIArate', 'addRoIBrate', 'addspldestrate','initialweight'], 'number'],
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
        $query = Packagerates::find();

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
            'rid' => $this->rid,
            'pkgid' => $this->pkgid,
            'initialweight' => $this->initialweight,
            'withincityrate' => $this->withincityrate,
            'zonerate' => $this->zonerate,
            'metrorate' => $this->metrorate,
            'RoI-Arate' => $this->RoIArate,
            'RoI-Brate' => $this->RoIBrate,
            'spldestrate' => $this->spldestrate,
            'addweightmultiple' => $this->addweightmultiple,
            'addwithincityrate' => $this->addwithincityrate,
            'addzonerate' => $this->addzonerate,
            'addmetrorate' => $this->addmetrorate,
            'addRoI-Arate' => $this->addRoIArate,
            'addRoI-Brate' => $this->addRoIBrate,
            'addspldestrate' => $this->addspldestrate,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        return $dataProvider;
    }
}
