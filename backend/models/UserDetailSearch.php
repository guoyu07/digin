<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserDetail;

/**
 * UserDetailSearch represents the model behind the search form about `backend\models\UserDetail`.
 */
class UserDetailSearch extends UserDetail
{
    public $username;
    public $email;
    public $phone;
    public $role;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'crtby', 'updby'], 'integer'],
            //[['firstname', 'lastname', 'city', 'country', 'crtdt', 'upddt'], 'safe'],
            [['firstname', 'lastname', 'username', 'email', 'phone', 'role'], 'safe'],
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
        $query = UserDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);
        
          
        $dataProvider->setSort([
            'attributes' => [                
                'firstname' => [
                    'asc' => ['firstname' => SORT_ASC],
                    'desc' => ['firstname' => SORT_DESC],
                    'label' => 'Firstame',
                    'default' => SORT_ASC
                ], 
                'lastname' => [
                    'asc' => ['lastname' => SORT_ASC],
                    'desc' => ['lastname' => SORT_DESC],
                    'label' => 'Lastame',
                    'default' => SORT_ASC
                ],
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'label' => 'Username'
                ],                
                'email' => [
                    'asc' => ['user.email' => SORT_ASC],
                    'desc' => ['user.email' => SORT_DESC],
                    'label' => 'Email'
                ],
                'phone' => [
                    'asc' => ['user.phone' => SORT_ASC],
                    'desc' => ['user.phone' => SORT_DESC],
                    'label' => 'Phone'
                ],
                'role' => [
                    'asc' => ['role' => SORT_ASC],
                    'desc' => ['role' => SORT_DESC],
                    'label' => 'Role',
                    'default' => SORT_ASC
                ],               
            ]
      ]);
        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['user']);
            $query->where(['not in', 'role', 'Subscriber']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'uid' => $this->uid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'role', $this->role]);

        // filter by user name
        $query->joinWith(['user' => function ($q) {
            $q->where('user.username LIKE "%' . $this->username . '%"');
        }]);
        //filter by email
         $query->joinWith(['user' => function ($q) {
            $q->where('user.email LIKE "%' . $this->email . '%"');
        }]);
        //filter by phone
        $query->joinWith(['user' => function ($q) {
            $q->where('user.phone LIKE "%' . $this->phone . '%"');
        }]);
        
        
        return $dataProvider;
    }
}
