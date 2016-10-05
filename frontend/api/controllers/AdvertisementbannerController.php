<?php

namespace frontend\api\controllers;

class AdvertisementbannerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionGetbanneradvertisement()
    {
          
        $lat=$_GET['lat'];
        $lng=$_GET['lng'];
         /*if(isset($lat)&&($lat!='')){
          $lat=$_GET['lat'];
          }
          if(isset($lng)&&($lng!='')){
          $lng=$_GET['lng'];
          
          }*/
          //echo 'lat:-...'.$lat;
          //echo 'lang:-...'.$lng;
          $url=$_SERVER['SERVER_NAME'];
          
           $imagearr = array();
           $url1="http://".$url."/images/";
           
           if(isset($lat)&&($lat!='') && (isset($lng)&&($lng!=''))){
            array_push($imagearr,['Image'=>'images/slider/PethkarMotors.jpg','url'=>$url1.'slider/PethkarMotors.jpg','Link'=>'digin.in']);
            array_push($imagearr,['Image'=>'images/slider/PetZone.jpg','url'=>$url1.'slider/PetZone.jpg','Link'=>'digin.in']);
            array_push($imagearr,['Image'=>'images/slider/pastaromeo.jpg','url'=>$url1.'slider/pastaromeo.jpg','Link'=>'digin.in']);
            array_push($imagearr,['Image'=>'images/slider/HimalayaHerbal.jpg','url'=>$url1.'slider/HimalayaHerbal.jpg','Link'=>'digin.in']);
          
          //echo json_encode($imagearr);
            
            /***Pegination***/
            $data=array();
            $aarayresult = array();
            $imagearr1 = array();
            $page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
            $total = count( $imagearr ); //total items in array    
            $limit = 2; //per page    
            $totalPages = ceil( $total/ $limit ); //calculate total pages
            $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
            $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
            $offset = ($page - 1) * $limit;
            if( $offset < 0 ) $offset = 0;
            $yourDataArray = array_slice( $imagearr, $offset, $limit);
            array_push($imagearr1,['Toatl Pages'=>$totalPages]);
            array_push($imagearr1,['Current Page'=>$_GET['page']]);
//            array_push($yourDataArray,$imagearr1);
//            array_push($imagearr1, $yourDataArray);
             array_push($aarayresult, $yourDataArray);
              array_push($aarayresult, $imagearr1);
            echo json_encode($aarayresult);
  
          }  
    }
    
    
    public function actionGetoffers()
     {    
            $lat=$_GET['lat'];
            $lng=$_GET['lng'];
            //echo 'lat:-...'.$lat;
            //echo 'lang:-...'.$lng;
            $url=$_SERVER['SERVER_NAME'];

            $imagearr = array();
            if(isset($lat)&&($lat!='') && (isset($lng)&&($lng!=''))){
            $url1="http://".$url."/images/catitems/";
            
            array_push($imagearr,['Image'=>'PNGadgilSons1.jpg','url'=>$url1.'PNGadgilSons1.jpg','Offer_Id'=>'11']);
            array_push($imagearr,['Image'=>'PopularBook3.jpg','url'=>$url1.'PopularBook3.jpg','Offer_Id'=>'12']);
            array_push($imagearr,['Image'=>'ShaktiSports1.jpg','url'=>$url1.'ShaktiSports1.jpg','Offer_Id'=>'13']);
            array_push($imagearr,['Image'=>'thebeanstore1.jpg','url'=>$url1.'thebeanstore1.jpg','Offer_Id'=>'14']);
            
             //echo json_encode($imagearr);
            
            /***Pegination***/
             $aarayresult = array();
            $imagearr1 = array();
            $page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
            $total = count( $imagearr ); //total items in array    
            $limit = 2; //per page    
            $totalPages = ceil( $total/ $limit ); //calculate total pages
            $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
            $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
            $offset = ($page - 1) * $limit;
            if( $offset < 0 ) $offset = 0;
            $yourDataArray = array_slice( $imagearr, $offset, $limit );
            //echo json_encode($yourDataArray);
            array_push($imagearr1,['Toatl Pages'=>$totalPages]);
            array_push($imagearr1,['Current Page'=>$_GET['page']]);
            //array_push($yourDataArray,$imagearr1);
            array_push($aarayresult, $yourDataArray);
            array_push($aarayresult, $imagearr1);
            echo json_encode($aarayresult);
            }
    
        }
    

 }
