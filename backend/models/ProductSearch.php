<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    //public $product;   
    //public $productCat;
    //public $category;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prid', 'crtby', 'updby'], 'integer'],
            [['prodname', 'description', 'crtdt', 'upddt','Is_active'], 'safe'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //$query->joinWith(['productCat']);
            //$query->joinWith(['category']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'prid' => $this->prid,            
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
            'Is_active' => $this->Is_active,
        ]);

        $query->andFilterWhere(['like', 'prodname', $this->prodname])
            ->andFilterWhere(['like', 'description', $this->description]);

        // filter by category
      /*  $query->joinWith(['category' => function ($q) {
            $q->where('category.path LIKE "%' . $this->category . '%"');
        }]);*/
        
        return $dataProvider;
    }
    
    
    public function searchVendor($params)
    {
        $query = Product::find()->where(['crtby'=>Yii::$app->user->identity->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //$query->joinWith(['productCat']);
            //$query->joinWith(['category']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'prid' => $this->prid,            
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'prodname', $this->prodname])
            ->andFilterWhere(['like', 'description', $this->description]);

        // filter by category
      /*  $query->joinWith(['category' => function ($q) {
            $q->where('category.path LIKE "%' . $this->category . '%"');
        }]);*/
        
        return $dataProvider;
    }
}
