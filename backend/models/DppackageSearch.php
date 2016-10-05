<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dppackage;

/**
 * DppackageSearch represents the model behind the search form about `backend\models\Dppackage`.
 */
class DppackageSearch extends Dppackage
{    
    public $deliverypartner;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dpid', 'crtby', 'updby'], 'integer'],
            [['packagename', 'crtdt', 'upddt', 'deliverypartner'], 'safe'],
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
        $query = Dppackage::find();
        $query->joinWith(['deliverypartner']);         //deliverypartner - name of relation given in model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['deliverypartner'] = [    // relation name
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['delivery_partner.name' => SORT_ASC],          // table name
        'desc' => ['delivery_partner.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dpid' => $this->dpid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,            
        ]);

        $query->andFilterWhere(['like', 'packagename', $this->packagename])
              ->andFilterWhere(['like', 'delivery_partner.name', $this->deliverypartner]);    //table name

        return $dataProvider;
    }
    
    
    public function searchBydp($params,$dpid)
    {
        $query = Dppackage::find()->where(['dppackage.dpid'=>$dpid]);
        $query->joinWith(['deliverypartner']);         //deliverypartner - name of relation given in model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['deliverypartner'] = [    // relation name
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['delivery_partner.name' => SORT_ASC],          // table name
        'desc' => ['delivery_partner.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dpid' => $this->dpid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,            
        ]);

        $query->andFilterWhere(['like', 'packagename', $this->packagename])
              ->andFilterWhere(['like', 'delivery_partner.name', $this->deliverypartner]);    //table name

        return $dataProvider;
    }
}
