<?php
namespace frontend\models;
 
class RequestMyPUDO{
var $ClientId;//string
var $UserName;//string
var $Password;//string
var $CustomerCode;//string
var $Address;//string
var $City;//string
var $Zipcode;//string
var $Outformat;//string
var $Latitude;//string
var $Longitude;//string
}

class RequestMyPUDOResponse{
}

class PushOrderData_PUDOResponse{
var $PushOrderData_PUDOResult;//string
}

class PushOrderData_PUDO{
var $ClientId;//string
var $UserName;//string
var $Password;//string
var $xmlBatch;//string
}



class PushReverseOrderData_PUDO{
var $ClientId;//string
var $UserName;//string
var $Password;//string
var $RequestId;//string
var $ConsignorName;//string
var $ConsignorAddress1;//string
var $ConsignorAddress2;//string
var $MobileNo;//string
var $Pincode;//string
var $SkuDescription;//string
var $DeclaredValue;//string
var $AgentId;//string
var $CustomerCode;//string
var $VendorName;//string
var $VendorAddress1;//string
var $VendorAddress2;//string
var $VendorPincode;//string
var $VendorTeleNo;//string
var $TransportMode;//string
var $IsPUDO;//string
var $TypeOfDelivery;//string
var $AwbNo;//string
var $ItemChecked;//string
}

class PushReverseOrderData_PUDOResponse{
var $PushReverseOrderData_PUDOResult;//string
}

class WsdlforDTDC 
 {
 var $soapClient;
 
private static $classmap = array('RequestMyPUDO'=>'RequestMyPUDO'
,'RequestMyPUDOResponse'=>'RequestMyPUDOResponse'
,'PushOrderData_PUDO'=>'PushOrderData_PUDO'
,'PushOrderData_PUDOResponse'=> 'frontend\models\PushOrderData_PUDOResponse'
,'PushReverseOrderData_PUDO'=>'PushReverseOrderData_PUDO'
,'PushReverseOrderData_PUDOResponse'=>'PushReverseOrderData_PUDOResponse'

);

 function __construct($url='http://instacom.dotzot.in/services/InstacomCustomerServices.asmx?WSDL')
 {
  $this->soapClient = new \SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));
 }
 
function RequestMyPUDO($RequestMyPUDO)
{
    
$RequestMyPUDOResponse = $this->soapClient->RequestMyPUDO($RequestMyPUDO);
return $RequestMyPUDOResponse;

}
function PushOrderData_PUDO($PushOrderData_PUDO)
{   
   \Yii::info("In method PushOrderData_PUDO");  
$PushOrderData_PUDOResponse = $this->soapClient->PushOrderData_PUDO($PushOrderData_PUDO);
return $PushOrderData_PUDOResponse;

}
function PushReverseOrderData_PUDO($PushReverseOrderData_PUDO)
{

$PushReverseOrderData_PUDOResponse = $this->soapClient->PushReverseOrderData_PUDO($PushReverseOrderData_PUDO);
return $PushReverseOrderData_PUDOResponse;

}

}


?>