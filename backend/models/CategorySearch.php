<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\Models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags'], 'string', 'max' => 100],
            [['path','parent'],'string'],
            [['id','crtby','updby'], 'integer'],
            [['name','description','crtdt','upddt','parentid'], 'safe'],
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
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
          // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //$query->joinWith('category');
       $query->from(['t'=>'category']);
        $query->andFilterWhere([
            't.id' => $this->id,
            't.crtdt' => $this->crtdt,
            't.crtby' => $this->crtby,
            't.upddt' => $this->upddt,
            't.updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 't.name', $this->name]);
        $query->andFilterWhere(['like', 't.tags', $this->tags]);
        $query->andFilterWhere(['like', 't.path', $this->path]);
         
        if(!empty($this->parent)){
        $query->leftJoin('category as t2', 't2.id=t.parentid')
               ->andWhere(['t2.name'=> $this->parent]);
                
        } 
        return $dataProvider;
       
    }
}
