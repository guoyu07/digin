<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orderitem;
use backend\models\VendorProducts;
use backend\models\Vendor;

/**
 * OrderitemSearch represents the model behind the search form about `backend\models\Orderitem`.
 */

/*NOTE:-*********************If There change in searchpage then change in controller Export action********************************/
class OrderitemSearch extends Orderitem
{
    
    public $vendor;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oritemid', 'quantity', 'crtby', 'updby'], 'integer'],
            [['rate', 'producttotal'], 'number'],
            [['upddt','vpid','vendor','vendor_pay_date','status','crtdt'], 'safe'],
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
        $query = Orderitem::find();
        
        $auth=Yii::$app->authManager;
        $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);
        
       
        $query = Orderitem::find()->all();
        
        
         if(isset($params['OrderitemSearch']['vendor_pay_date'])){
            $sgn = $params['OrderitemSearch']['vendor_pay_date'];
            
          $frm = explode('_',$sgn);
          if($frm[1]==""){
              $frm[1]=$frm[0];
          }
         }else{
             //$frm[1]= '';
             //$frm[0]='';
             $frm[1]= date('Y-m-d');
             $frm[0] =date("Ymd", strtotime("-1 months"));
             //$frm[0]='2016-07-03';
                     
         }
         $fltr = '';
         if(isset($params['OrderitemSearch']['status'])){
             $fltrsts = ($params['OrderitemSearch']['status']);
             if($fltrsts==1){
                 $fltr =1;
             }else{
                 $fltr =0;
             }
         }
         
        if(isset($params['OrderitemSearch']['crtdt'])){
            $sgn = $params['OrderitemSearch']['crtdt'];
            
          $frmnw = explode('_',$sgn);
          if($frmnw[1]==""){
              $frmnw[1]=$frmnw[0];
          }
         }else{
            $frmnw[1]= date('Y-m-d');
             $frmnw[0] =date("Ymd", strtotime("-1 months"));
         }
        
        
        
        if((array_keys($userRole)[0]=='Vendor')){
        $vid = Vendor::findOne(['user_id'=>Yii::$app->user->identity->id]);
        $vpids = VendorProducts::find()->where(['vid'=>$vid['vid']])->all();
        $vennm = Vendor::find()->where(['vid'=>$vid['vid']])->one();
        $vpid = array();
      foreach ($vpids as $vp){
               array_push($vpid, $vp['vpid']);
      }
        }else{
        $query = Orderitem::find();
        
        
        }
         if((array_keys($userRole)[0]!='Vendor')){
        $query->joinWith(['vendor']);
        }
        //$query->joinWith(['orderitem']);
        
        //var_dump($vpid);
         //$query = Orderitem::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
if((array_keys($userRole)[0]!='Vendor')){
        $query->andFilterWhere([
            'oritemid' => $this->oritemid,
             //'orid' => $this->orid,
            //'vpid' => $this->vpid,
            'rate' => $this->rate,
            'quantity' => $this->quantity,
            'producttotal' => $this->producttotal,
            //'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
         ]);

        $query->andFilterWhere(['like', 'vendor.businessname', $this->vendor]);
        $query->andFilterWhere(['between','vendor_pay_date',$frm[0],$frm[1]]);
        $query->andFilterWhere(['between','orderitem.crtdt',$frmnw[0],$frmnw[1]]);
        $query->andFilterWhere(['like','paid_to_vendor',$fltr]);
         
}    
         if((array_keys($userRole)[0]=='Vendor')){
         $query->andWhere(['vpid'=>$vpid]);
         
         }
        
        return $dataProvider;
    }
    
    
}
