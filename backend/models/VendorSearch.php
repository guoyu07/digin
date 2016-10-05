<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Vendor;

/**
 * VendorSearch represents the model behind the search form about `backend\models\Vendor`.
 */
class VendorSearch extends Vendor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'vendtor_type', 'phone1', 'phone2', 'pin', 'plan', 'crtby', 'updby'], 'integer'],
            [['firstname', 'lastname', 'email', 'website', 'businessname', 'logo', 'aboutme', 'address1', 'address2', 'city', 'state', 'location', 'crtdt', 'upddt', 'Is_active'], 'safe'],
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
        $query = Vendor::find();

        if(isset($params['VendorSearch']['crtdt'])){
            $sgn = $params['VendorSearch']['crtdt'];
          $frm = explode('_',$sgn);
          if($frm[1]==""){
              $frm[1]=$frm[0];
          }
         }else{
             $frm[1]= '';
             $frm[0]='';
                     
         }


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
            'vid' => $this->vid,
            'vendtor_type' => $this->vendtor_type,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'pin' => $this->pin,
            'plan' => $this->plan,
            'Is_active' => $this->Is_active,
            //'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'businessname', $this->businessname])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'aboutme', $this->aboutme])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'location', $this->location])
            //->andFilterWhere(['like', 'Is_active', $this->Is_active]);
            ->andFilterWhere(['between','crtdt',$frm[0],$frm[1]]);
        return $dataProvider;
    }
    
    
     public function searchByFranchisee($params)
    {
        $franch_user_frid=  FranchiseeUser::findOne(['userid'=>Yii::$app->user->identity->id]);
        $franch_user_userid=  FranchiseeUser::find()->where(['frid'=>$franch_user_frid['frid']])->all();
        $user=array();
        foreach ($franch_user_userid as $us)
        {
            array_push($user, $us['userid']);            
        }        
                  
        $query = Vendor::find()->where(['in','crtby',$user]);
       // $query = Vendor::find();
        
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
            'vid' => $this->vid,
            'vendtor_type' => $this->vendtor_type,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'pin' => $this->pin,
            'plan' => $this->plan,
            'Is_active' => $this->Is_active,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'businessname', $this->businessname])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'aboutme', $this->aboutme])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'Is_active', $this->Is_active]);

       //var_dump($dataProvider);
        return $dataProvider;
    }
    
    
     public function searchByFranchiseeExecutive($params)
    {                    
        $query = Vendor::find()->where(['crtby'=>Yii::$app->user->identity->id]);
       // $query = Vendor::find();
        
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
            'vid' => $this->vid,
            'vendtor_type' => $this->vendtor_type,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'pin' => $this->pin,
            'plan' => $this->plan,
            'Is_active' => $this->Is_active,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'businessname', $this->businessname])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'aboutme', $this->aboutme])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'Is_active', $this->Is_active]);

       //var_dump($dataProvider);
        return $dataProvider;
    }
}
