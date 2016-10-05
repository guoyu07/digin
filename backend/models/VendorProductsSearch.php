<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VendorProducts;

/**
 * VendorProductsSearch represents the model behind the search form about `backend\models\VendorProducts`.
 */
class VendorProductsSearch extends VendorProducts
{
    public $unit;
    public $product;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vpid', 'vid', 'prid', 'crtby', 'updby'], 'integer'],
            [['price'], 'number'],
            [['crtdt', 'upddt', 'unit', 'product'], 'safe'],
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
       $auth=Yii::$app->authManager;
        $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);

        $query = VendorProducts::find();

        if((array_keys($userRole)[0]=='Vendor')){
         $query = VendorProducts::find()->where(['vid'=>$params]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'product' => [
                    'asc' => ['product.prodname' => SORT_ASC],
                    'desc' => ['product.prodname' => SORT_DESC],
                    'label' => 'Product'
                ],
                'unit' => [
                    'asc' => ['units.unitname' => SORT_ASC],
                    'desc' => ['units.unitname' => SORT_DESC],
                    'label' => 'Unit'
                ], 
                'price' => [
                    'asc' => ['price' => SORT_ASC],
                    'desc' => ['price' => SORT_DESC],
                    'label' => 'Price',
                    'default' => SORT_ASC
                ],
            ]]);      
        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['units']);
             $query->joinWith(['product']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vpid' => $this->vpid,
            'vid' => $this->vid,
            //'prid' => $this->prid,
            //'unit' => $this->unit,
            'price' => $this->price,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        // filter by unit name
        $query->joinWith(['units' => function ($q) {
            $q->where('units.unitname LIKE "%' . $this->unit . '%"');
        }]);
        
        //filter by product name
        $query->joinWith(['product' => function($q){
            $q->where('product.prodname LIKE "%' . $this->product . '%"');
        }]);
        return $dataProvider;
    }
    
    
    public function searchByvendor($params,$vid)
    {
        $query = VendorProducts::find()->where(['vid'=>$vid]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'product' => [
                    'asc' => ['product.prodname' => SORT_ASC],
                    'desc' => ['product.prodname' => SORT_DESC],
                    'label' => 'Product'
                ],
                'unit' => [
                    'asc' => ['units.unitname' => SORT_ASC],
                    'desc' => ['units.unitname' => SORT_DESC],
                    'label' => 'Unit'
                ], 
                'price' => [
                    'asc' => ['price' => SORT_ASC],
                    'desc' => ['price' => SORT_DESC],
                    'label' => 'Price',
                    'default' => SORT_ASC
                ],
            ]]);      
        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['units']);
             $query->joinWith(['product']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vpid' => $this->vpid,
            'vid' => $this->vid,
            //'prid' => $this->prid,
            //'unit' => $this->unit,
            'price' => $this->price,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        // filter by unit name
        $query->joinWith(['units' => function ($q) {
            $q->where('units.unitname LIKE "%' . $this->unit . '%"');
        }]);
        
        //filter by product name
        $query->joinWith(['product' => function($q){
            $q->where('product.prodname LIKE "%' . $this->product . '%"');
        }]);
        return $dataProvider;
    }
}
