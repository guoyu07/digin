<?php

namespace backend\controllers;

class VendorpaymentController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPaymentsuccessforpayumoney()
    {        
            \Yii::info("In VendorpaymentController within action Paymentsuccessforpayumoney.");
            
            $txnid=$_POST['txnid'];            
            $status=$_POST['status'];    
            $payuid=$_POST['payuMoneyId']; 
            
            $vendor= \backend\models\Vendor::find()->where(['txnid'=>$txnid])->one();           

            $vendor->location=$vendor->lat.",".$vendor->lng;
            $user= \dektrium\user\models\User::find()->where(['id'=>$vendor->user_id])->one();
            $vendor->username=$user->username;
            
            $vendor->status=$status;    
            $vendor->payu_pal_id=$payuid;
            $vendor->save();
            $vendorpdf=new \backend\models\Vendor();  
            $vendorpdf->Generatepdf($vendor->vid, $user->username); 
         //   var_dump($_POST);
            //var_dump($vendor->vid);
            \Yii::info("Your transaction with PayUmoney is completed successfully!");
             
            return $this->render('success');
        }
        public function actionPaymentfailureforpayumoney()
        {
             \Yii::info("In VendorpaymentController within action Paymentfailureforpayumoney.");
             
             $txnid=$_POST['txnid'];            
             $status=$_POST['status'];             
             $payuid=$_POST['payuMoneyId']; 
             
             $vendor= \backend\models\Vendor::find()->where(['txnid'=>$txnid])->one();           

             $vendor->location=$vendor->lat.",".$vendor->lng;
             $user= \dektrium\user\models\User::find()->where(['id'=>$vendor->user_id])->one();
             $vendor->username=$user->username;
            
             $vendor->status=$status; 
             $vendor->payu_pal_id=$payuid;
             $vendor->pwd='';
             $vendor->save();
             \Yii::info("Your request is declined by PayUmoney!");

            return $this->render('failure');
        }
        
        
        /*************************for PayPal**************************************/
        public function actionPaymentsuccessforpaypal()
        {
            \Yii::info("In VendorpaymentController within action Paymentsuccessforpaypal.");
            $tx=$_GET['tx'];       //paypal unique tx id 
            $st=$_GET['st'];
            $txnid=$_GET['cm'];    //custom parameter passed-through form
            
            $vendor= \backend\models\Vendor::find()->where(['txnid'=>$txnid])->one(); 
            
            $vendor->location=$vendor->lat.",".$vendor->lng;
            $user= \dektrium\user\models\User::find()->where(['id'=>$vendor->user_id])->one();
            $vendor->username=$user->username;
            
            $vendor->status=$st; 
            $vendor->payu_pal_id=$tx;
            $vendor->save();
            $vendorpdf=new \backend\models\Vendor();  
            $vendorpdf->Generatepdf($vendor->vid, $user->username); 
         
            \Yii::info("Your transaction with PayPal is completed successfully!");
             
            return $this->render('paypalsuccess');
        }
        
        public function actionPaymentfailureforpaypal()
        {
            \Yii::info("In VendorpaymentController within action Paymentfailureforpaypal.");
            $tx=$_GET['tx'];       //paypal unique tx id 
            $st=$_GET['st'];
            $txnid=$_GET['cm'];    //custom parameter passed-through form
            
            $vendor= \backend\models\Vendor::find()->where(['txnid'=>$txnid])->one();           

            $vendor->location=$vendor->lat.",".$vendor->lng;
            $user= \dektrium\user\models\User::find()->where(['id'=>$vendor->user_id])->one();
            $vendor->username=$user->username;
            
            $vendor->status=$st; 
            $vendor->payu_pal_id=$tx;
            $vendor->pwd='';
            $vendor->save();
            \Yii::info("Your request is declined by PayPal!");

            return $this->render('paypalfailure');
        }

        public function actionPaymentfailure()
        {
            \Yii::info("In VendorpaymentController within action Paymentfailure. Logged userid is: ".\Yii::$app->user->identity->id);         
            if($_SERVER['REQUEST_METHOD'] === 'GET')
            {
                $txnid=$_GET['txnid']; 
			    \Yii::info("Your request is declined by PayPal!");
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                 $txnid=$_POST['txnid'];            
                 $status=$_POST['status'];             
                 $payuid=$_POST['payuMoneyId']; 
				 \Yii::info("Your request is declined by PayUmoney!");
            }
            
            $vendor= \backend\models\Vendor::find()->where(['txnid'=>$txnid])->one();      
            $vendor->location=$vendor->lat.",".$vendor->lng;
            $user= \dektrium\user\models\User::find()->where(['id'=>$vendor->user_id])->one();
            $vendor->username=$user->username;
            $vendor->Is_active=0;
            if(isset($status) && isset($payuid)){
                $vendor->status=$status; 
                $vendor->payu_pal_id=$payuid;            
            }else{
                $vendor->status="failure"; 
            }
            $vendor->save();
            
            $data=array();
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $plan=  \backend\models\Plan::find()->where(['id'=>$vendor->plan])->one();
                $data=['txnid'=>$txnid, 'amt'=>$plan['charge'], 'currcode'=>$vendor->currencycode];
            }
            
            $vendormdl=new \backend\models\Vendor();
            $vendormdl->sendmail($vendor->vid, $vendor->email, $vendor->phone1, $user->username, $vendor->pwd, "");
            
            return $this->render('failure', ['data'=>$data]);            
        }
        
}
