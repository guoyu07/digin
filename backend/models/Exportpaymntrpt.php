<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exportpin".
 *
 * @property integer $id
 * @property string $state
 * @property string $city
 * @property integer $pincode
 */
class Exportpaymntrpt extends \yii\base\Model
{
       
    public $order_No=null;
    public $vendor_name=null;
    public $payment_Date=null;
    public $shipment_Cost=null;
    public $payment=null;
    public $digin_Commission=null;
    public $pay_to_vendor=null;
    public $payment_Status=null;
    public $order_date=null;
    public $account_no=null;
    public $account_name=null;
    public $ifsc_code=null;
    public $bank_name=null;
    public $delivery_detail=null;
    /**
     * @inheritdoc
     */
   /* public static function tableName()
    {
        return 'exportpin';
    } */

    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid','vendor_Name', 'displayid','shipment','producttotal','Payment','vpid'], 'required'],
            [['vid','shipment','vpid','account_no'], 'integer'],
            [['vendor_Name','account_name','delivery_detail'],'string', 'max' => 100],
            [['ifsc_code','bank_name'], 'string', 'max' => 200],
            [['Payment_date','order_date'], 'safe'],
           ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vid' => 'VID',
            'vendor_Name' => 'Vendor Name',
            'displayid' => 'Order No',
            'shipment' => 'Shipment',
            'Payment' => 'Payment',
            'paid_to_vendor' => 'Payment Status',
            'vpid' => 'Vpid',
            'Payment_date' => 'Pay Date',
            'order_date' => 'Order Date',
            'ifsc_code' => 'IFSC Code',
            'bank_name' => 'Bank Name',
             'account_name' => 'Account Name',
             'account_no' => 'Account No',
            'delivery_detail' => 'Delivery Details'
            
        ];
    }
}
