<?php

namespace backend\models;

use Yii;
use mPDF;
/**
 * This is the model class for table "vendor".
 *
 * @property integer $vid
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $website
 * @property string $businessname
 * @property string $logo
 * @property integer $vendtor_type
 * @property integer $phone1
 * @property integer $phone2
 * @property string $aboutme
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property integer $pin
 * @property string $location
 * @property integer $plan
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 * @property integer $paychq_text
 * @property integer $Is_blocked
 * @property integer $Is_active
 */
class Vendor extends \yii\db\ActiveRecord
{    
    public $username=null;
    public $password_field=null;
    public $executive=null;
    public $location=null;
    public $frmdt=null;
    public $todt=null;
    public $Date=null;
    public $paymentanddelivery=null;
    public $franchisee=null;
    public $franchexecutive=null;
    public $deliverypartner=null;
    public $dppkg=null;
    public $paytype = null;
    public $paymntopt = null;
    public $delivryopt = null;
    public $dlvrsb = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['firstname', 'lastname', 'email', 'website', 'businessname', 'logo', 'vendtor_type', 'phone1', 'phone2', 'aboutme', 'address1', 'address2', 'city', 'state', 'pin', 'location', 'plan', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['firstname', 'lastname', 'businessname', 'vendtor_type', 'address1', 'city', 'state', 'country', 'pin','plan', 'email', 'phone1', 'username' ], 'required'],// 'location', 'username' 
          
            [['vendtor_type','plan','crtby', 'updby', 'user_id', 'payment', 'delivery','Is_blocked','Is_active', 'isbyfranchisee', 'dppkgid'], 'integer'],
            [['aboutme', 'googleaddr','phone1','phone2','pin'], 'string'],
            [['shift'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['firstname', 'lastname', 'location', 'country','account_name'], 'string', 'max' => 100],
            [['email','account_no','ifsc_code'], 'string', 'max' => 150],
            [['email'], 'email'],
            [['pin'], 'match', 'pattern' => '/^[0-9 a-z A-Z -]+$/'],
            [['phone1','phone2'], 'match', 'pattern' => '/\+?[0-9()-]+$/'],
            [['username'], 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            [['username'], 'string', 'min'=>6],
            [['username'], 'trim'],
            [['password_field'],'string','min'=>6],
            [['account_no'], 'string', 'min' => 8],
            [['account_no'], 'string', 'max' => 18],
            [['website', 'businessname','bank_name'], 'string', 'max' => 200],
            [['address1', 'address2'], 'string', 'max' => 50],
            [['city', 'state'], 'string', 'max' => 30],
            [['logo'], 'file', 'skipOnEmpty' => true],
            [['logo'], 'file'],
            [['txnid', 'status', 'currencycode', 'payu_pal_id'], 'string', 'max' => 30],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1'],
            ['updby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vid' => 'Vid',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'website' => 'Website',
            'businessname' => 'Business Name',
            'logo' => 'Logo',
            'vendtor_type' => 'Vendor Type',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'aboutme' => 'About Me',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'pin' => 'Pin',
            'location' => 'Location',
            'googleaddr' => 'Google Address',
            'plan' => 'Plan',
            'password_field' => 'Password',
            'crtdt'=>'Date',
            'paytype'=>'Payment Type',
            'payment' => 'Payment',
            'delivery' => 'Delivery',
            'paymentanddelivery' => 'Payment & Delivery',
            'franchexecutive' => 'Franchisee Executive',
            'deliverypartner' => 'Delivery Partner',
            'dppkg' => 'Delivery Partner Package',
            'bank_name'=>'Bank Name',
            'account_no'=>'Account No',
            'ifsc_code'=>'IFSC Code',
            'account_name'=>'Account Name',
            'paymntopt' => 'Payment Options',
            //'delivryopt' => 'Delivery Options',
            'dlvrsb' => 'For other places'
            /*'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',*/
        ];
    }
    
    
    
    public function getVendorFacility($id)
    {
        $facarray=array();
        $facilities='';
        $venfacility= VendorFacilities::find()->where(['vid' => $id])->all();
        foreach ($venfacility as $d){        
            $fac=Facility::find()->where(['id'=>$d->facid])->all();            
            foreach ($fac as $f)
             {               
                array_push($facarray,$f->name);
             }
        }
        $facilities=  implode(', ', $facarray);        
        return $facilities;
    }
    
    public function getPaymentType($id)
    {
        $paytyparray=array();
        $paytypes='';
        $venpaytype=  VendorReceivablePayType::find()->where(['vid' => $id])->all();
        foreach ($venpaytype as $pt)
        {
            $pay=  Paymentype::find()->where(['ptid'=>$pt->ptypeid])->all();
            foreach ($pay as $p)
            {
                array_push($paytyparray, $p->type);
            }
        }
        $paytypes=  implode(', ', $paytyparray);
        return $paytypes;
    }
    
    /*public function beforeSave($insert) {
    if(isset($this->password_field)) 
       // $this->password = Security::generatePasswordHash($this->password);
        $this->password_field = Yii::$app->security->generatePasswordHash($this->password_field);
        echo "Pass...".var_dump($this->password);
    return parent::beforeSave($insert); 
    }*/
    
    public function validatePassword($password)
    {
        if(isset($this->password_field))
           //echo "true....".$password;
           return  Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }
    
      public function getVendorBlocked($vid)
    {
         if($this->findOne($vid)!=null)
         {
             return $this->findOne($vid)->Is_blocked;
             
         }
    }
    
     public function getVendorActive($vid)
    {
         if($this->findOne($vid)!=null)
         {
             return $this->findOne($vid)->Is_active;             
         }
    }
    
    public function isDigindelivery($vid)
    {
        $vendor=Vendor::find()->where(['vid'=>$vid])->one();
        return $vendor['delivery'];
        
    }
    
    
    /*******************get vendorCity and Deliverycity************************/
    public function getVendorCity($vid){
        $vendor=Vendor::find()->where(['vid'=>$vid])->one();
        $pincode = Pincode::find()->where(['pincode'=>$vendor['pin']])->one();
        $city = \frontend\models\Cities::find()->where(['id'=>$pincode['cityid']])->one();
        return $city['name'];
    }
    
   public function getDeliveryCity($uid){
        $addr=  Address::find()->where(['userid'=>$uid])->one();
        $pincode = Pincode::find()->where(['pincode'=>$addr['pin']])->one();
        $city = \frontend\models\Cities::find()->where(['id'=>$pincode['cityid']])->one();
        return $city['city'];
    }
    
    /*********************get VendorContry And deliveryCountry************************/
    public function getVendorCountry($vid)
    {
        $vendor=Vendor::find()->where(['vid'=>$vid])->one();
        return $vendor['country'];
    }
   
    public function getDeliveryCountry($uid){
        $addr = Address::findOne(['userid'=>$uid]);
        return $addr['country'];
    }
    
    /**********************getVendor pin and Delivery Pin***************************/
   public function  getVendorPin($vid){
        $vendor=Vendor::find()->where(['vid'=>$vid])->one();
        return $vendor['pin'];
    }
 
   public function getDeliveryPin(){
        $addr = Address::findOne(['userid'=>$uid]);
        return $addr['pin'];
   }

    public function isPayment($vid)
    {
         $vendor=Vendor::find()->where(['vid'=>$vid])->one();
         return $vendor['payment'];
    }

    public function getVendorPincode($vpid)
    {
         $query = (new \yii\db\Query())   
                   ->select(['v.pin', 'v.city'])
                   ->from('vendor v')
                   ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                   ->where(['vp.vpid'=>$vpid]);  
         $venpin=$query->all(); 
         return $venpin;
    }
    
    public function getVendordppkgid($vid)
    {
        $dppkgid=  Vendor::find()->where(['vid'=>$vid])->one();
        return $dppkgid;
    }

    public function getDeliveryPackage($pkgid)
    {
        //$pkgid= Dppackage::find()->where(['dpid'=>1])->one();
        //return $pkgid['id'];
        $dppkg=  Dppackage::find()->where(['id'=>$pkgid])->one();        
        return $dppkg;
    }  
    
   
    
    /************for PDF **********************/
    public function Generatepdf($vid, $unm)  //$pass
    {         
        Yii::info('PDF is generating...');       
        $mpdf = new mPDF();  
        $vendor=  Vendor::find()->where(["vid"=>$vid])->one();
        $plan=  \backend\models\Plan::find()->where(['id'=>$vendor->plan])->one();
        $paytype=  \backend\models\VendorReceivablePayType::find()->where(['vid'=>$vid])->one();
        
        if($plan['charge']!=0)
        {    
        $connection=  (new \yii\db\Query());
        $connection->createCommand()->insert('invoicenumbers', ['invoiceno' => null])->execute();
        $qry=(new \yii\db\Query())
            ->select('AUTO_INCREMENT')
            ->from('information_schema.TABLES')
            ->where(['TABLE_SCHEMA'=>"ad045fcf_diginnu_new"])
            ->andWhere(['TABLE_NAME'=>'invoicenumbers'])
            ->all();
        $invoiceno=$qry[0]['AUTO_INCREMENT'];
        
        $address=$vendor['address1'].", ".$vendor['address2'].", ".$vendor['city'].", ".$vendor['state'].", ".$vendor['country'].", ".$vendor['pin'];
        $crtdt=  explode(' ', $vendor['crtdt']);
        $data=["name"=>$vendor['firstname']." ".$vendor['lastname'], "address"=>$address, "phone"=>$vendor['phone1'], "email"=>$vendor['email'], "business"=>$vendor['businessname'], "plan"=>$plan['name'], "currency"=>$vendor['currencycode'], "charge"=>$plan['charge'], "crtdt"=>$crtdt[0], "enddate"=>$vendor['subscriptionenddate'], "paytype"=>$paytype['ptypeid'], "payno"=>$paytype['chq_no'], "invoiceno"=>$invoiceno];
     
        $mpdf->WriteHTML(Yii::$app->controller->renderPartial('receipt', ['data'=>$data]));
       
        $pdfname = preg_replace('/\s+/', '', $vendor['businessname']."_".$vid);       
        $fileSavePath = Yii::$app->basePath . '/../receipts/vendorpdf/' . $vid . '/';
        if (!file_exists($fileSavePath)) {
              mkdir($fileSavePath, 0755, true);
        }
        $mpdf->Output($fileSavePath.$pdfname.'.pdf','F');     
        }       
   //     $this->sendmail($vid, $vendor['email'], $vendor['phone1'], $unm, $pass, $pdfname); 
        $this->sendmail($vid, $vendor['email'], $vendor['phone1'], $unm, $vendor['pwd'], $pdfname); 
        Yii::info('PDF is generated...'); 
       return true;          
    }
    
  public function getVid()
  {
        $vendor = Vendor::find()->where(['user_id' =>Yii::$app->user->identity->id])->one();
        //var_dump($vid);
        return $vendor['vid'];
  }

  /***************To send email************************/
    public function sendmail($vid, $email, $phone, $unm, $pass, $pdfname)
    {
         Yii::info('Started sending mail...'); 
         $message='<p>New mail from Digin <br> <b>Subject:&nbsp;</b>Vendor Registration Details<br><b>From:&nbsp;</b>mail@digin.in <br><b>Message:&nbsp;</b>'.$email.' Your account has been registered successfully</p><br><p>Your login credentials are as follows:<br><b>Username:&nbsp;</b>'.$unm.'<br><b>Password:&nbsp;</b>'.$pass.'</p>';         
         $attachment=  Yii::$app->basePath . '/../receipts/vendorpdf/' . $vid . '/'.$pdfname.'.pdf'; 
         $message=\Yii::$app->mailer->compose()
                   ->setFrom('mail@digin.in')                    
                   ->setTo($email)
                   ->setBcc('mail@digin.in')      
                   ->setSubject('Vendor Account Registration Details')
                   ->setHtmlBody($message);
                  
        if(file_exists($attachment))
        {
             $message->attach($attachment)
                   ->send();
        }
        else{
            $message->send();
        }
         Yii::info('End sending mail...'); 
         
         $sms=new \backend\models\Smssetting();
         $url=$sms->getUrlWithPwd($pass, $unm, $phone);
         $sms->sendMessage($url);           
         
         Vendor::updateAll(['pwd'=>''], 'vid='.$vid);
         return;
      }

}