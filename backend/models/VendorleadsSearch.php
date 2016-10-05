<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VendorLeads;

/**
 * VendorleadsSearch represents the model behind the search form about `backend\models\Vendorleads`.
 */
class VendorleadsSearch extends Vendorleads
{
     public $franchisee = null;
     public $frnchexecutive = null;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vlid', 'vendor_type', 'pin', 'crtby', 'updby','frid'], 'integer'],
            [['firstname', 'lastname', 'email', 'website', 'businessname', 'phone1', 'phone2', 'address1', 'address2', 'city', 'state', 'conversion_date','franchisee','frnchexecutive','Is_convert'], 'safe'],
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
    if(array_keys($userRole)[0]=='Franchisee Executive'){
        $query = Vendorleads::find()->where(['Is_convert'=>0,'crtby'=> \yii::$app->user->identity->id]);
        //$query->joinWith(['franchisee']); 
       }
    if(array_keys($userRole)[0]=='Franchisee Manager'){
       /*$query = Vendorleads::find()->where(['Is_convert'=>1]);
        $query->joinWith(['franchisee']);  */
        
          $frnchiseeid = \backend\models\FranchiseeUser::find()->where(['userid'=> \Yii::$app->user->identity->id])->one();
          $alluser = \backend\models\FranchiseeUser::find()->where(['frid'=> $frnchiseeid['frid']])->all();
          $alluserarr = array();
          foreach ($alluser as $allusr){
              array_push($alluserarr, $allusr['userid']); 
          }
          $alluserstring = implode(',', $alluserarr);
         $frnchnm = \backend\models\UserDetail::find()->where(['uid'=> $alluserarr])
                                                              ->andWhere(['role'=>'Franchisee Executive'])
                                                              ->all();
          $query = \backend\models\Vendorleads::find()->where(['crtby'=> $alluserarr]);
      }
      
     if(array_keys($userRole)[0]=='Admin' || array_keys($userRole)[0]=='Superadmin'){
       $query = Vendorleads::find()->where(['Is_convert'=>0]);
        $query->joinWith(['franchisee']);                    
      }
      
      
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
     $dataProvider->sort->attributes['franchisee'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['franchisee.name' => SORT_ASC],
        'desc' => ['franchisee.name' => SORT_DESC],
      ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
           // 'vlid' => $this->vlid,
            'vendor_type' => $this->vendor_type,
            'pin' => $this->pin,
            //'plan' => $this->plan,
            'crtby' => $this->crtby,
            'updby' => $this->updby,
            'conversion_date' => $this->conversion_date,
            'frid'=> $this->frid,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'businessname', $this->businessname])
            ->andFilterWhere(['like', 'phone1', $this->phone1])
            ->andFilterWhere(['like', 'phone2', $this->phone2])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'franchisee.name', $this->franchisee])
           // ->andFilterWhere(['like', 'franchexecutive.name', $this->frnchexecutive])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
