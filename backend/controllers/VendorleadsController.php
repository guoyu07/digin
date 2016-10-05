<?php

namespace backend\controllers;

use Yii;
use backend\models\VendorLeads;
use backend\models\VendorleadsSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * VendorleadsController implements the CRUD actions for Vendorleads model.
 */
class VendorleadsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vendorleads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorleadsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'arraydata'=> $msgarr,
        ]);
    }

    /**
     * Displays a single Vendorleads model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function saveModels(array $modelarray) {
         $model=$modelarray['model'];        
         $mdlvendor=$modelarray['mdlvendor'];
         $success = true;
           //todo check if uploaded
         $file=$model->excelfile;
         $frid=$_POST['Vendor']['franchisee'];
         $fexid=$_POST['Vendor']['franchexecutive'];
         $uploadedFile = UploadedFile::getInstance($model, 'excelfile');
        
        if(($uploadedFile!== null && $uploadedFile!=='' 
                && $uploadedFile->size !== 0 ) 
                || $model->isNewRecord)
        {
          $fileName = $uploadedFile;  //  file name
          
          $fileSavePath = Yii::$app->basePath . '/vendorleads/' . $frid . '/'.$fexid. '/';
                if (!file_exists($fileSavePath)) {
                    mkdir($fileSavePath, 0755, true);
                }
          $uploadedFile->saveAs($fileSavePath . $fileName);
             
          $importfile=Yii::$app->basePath.'/vendorleads/' . $frid . '/'.$fexid. '/'.$fileName;
          $data = \moonland\phpexcel\Excel::import($importfile); //  $config   $config is an optional

          // var_dump($data);                  
        }
       // echo $_POST['Vendor']['franchexecutive'];   
       $msgarr = array();
       $msgarraynw = array();
       
        foreach ($data as $dt) {
            $vl = new \backend\models\VendorLeads();
            if(isset($dt['email'])){
            $vl->email = $dt['email'];
            }else{
               $vl->email='';  
            }
            if(isset($dt['phone1'])){
            $vl->phone1 = strval(floatval($dt['phone1']));
            }else{
               $vl->phone1 =''; 
            }
             if(isset($dt['phone1'])){
            $vl->phone2 = strval(floatval($dt['phone2']));
             }else{
                $vl->phone2=''; 
             }
            $vl->crtby = $_POST['Vendor']['franchexecutive'];
            $vl->updby = $_POST['Vendor']['franchexecutive'];
            $vl->conversion_date = date('Y-m-d H:i:s');
            $vl->frid = $_POST['Vendor']['franchisee'];

            $vl->firstname = $dt['firstname'];
            $vl->lastname = $dt['lastname'];
            ///$vl->email = $dt['email'];
            $vl->website = $dt['website'];
            $vl->businessname = $dt['businessname'];
            $ventype = \backend\models\Vendortype::find()->where(['type' => $dt['vendor_type']])->one();
            $vl->vendor_type = $ventype['id'];
            //$vl->phone1 = strval(floatval($dt['phone1']));
            //$vl->phone2 = strval(floatval($dt['phone2']));
            $vl->address1 = $dt['address1'];
            $vl->address2 = $dt['address2'];
            $vl->city = $dt['city'];
            $vl->state = $dt['state'];
            $vl->pin = intval(floatval($dt['pin']));
            //$vl->crtby =   $_POST['Vendor']['franchexecutive'];    
            //$vl->updby =   $_POST['Vendor']['franchexecutive'];
            //$vl->conversion_date = date('Y-m-d H:i:s');
            // $vl->frid = $_POST['Vendor']['franchisee'];
            //var_dump($model->attributes);            
           //echo 'phone..=....'. $vl->phone1;
          
           
            if (($vl->phone1 !='' || $vl->phone2 !='') && $vl->email !='') {
               // echo 'hi m in before..save...???????';
                $success = $vl->save();
                //var_dump($success);
            } else {
                // echo 'hi m in after..save...';
                array_push($msgarr, array('firstname'=>$dt['firstname'], 'lastname'=>$dt['lastname'], 'businessname'=>$dt['businessname'], 'city'=>$dt['city'], 'state'=>$dt['state']));  
            }
            // var_dump($msgarr); 
            //echo $success;
        }
            //var_dump($msgarr); 
              //echo 'hi..'.$success;
               $filepath = \Yii::$app->basePath .DIRECTORY_SEPARATOR .'vendorleads'.DIRECTORY_SEPARATOR.$frid.DIRECTORY_SEPARATOR.$fexid.DIRECTORY_SEPARATOR.$fileName;       
                 if (file_exists($filepath)) {
                    unlink($filepath);
                    //echo 'file deleted..';
                 }
                return $msgarr;
      
    }
    /**
     * Creates a new Vendorleads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionConvertdata()
    {
        $id=$_REQUEST['id'];
        $vendorleadsmodel= \backend\models\VendorLeads::find()->where(['vlid'=>$id])->one();        
        $result=array();            
        //var_dump($occupationmodel);
        array_push($result, array('firstname'=>$vendorleadsmodel['firstname'], 'lastname'=>$vendorleadsmodel['lastname'], 'email'=>$vendorleadsmodel['email'], 'website'=>$vendorleadsmodel['website'],  'businessname'=>$vendorleadsmodel['businessname'],  'vendor_type'=>$vendorleadsmodel['vendor_type'], 'phone1'=>$vendorleadsmodel['phone1'],'phone2'=>$vendorleadsmodel['phone2'],'address1'=>$vendorleadsmodel['address1'],'address2'=>$vendorleadsmodel['address2'],'city'=>$vendorleadsmodel['city'],'state'=>$vendorleadsmodel['state'],'pin'=>$vendorleadsmodel['pin'],'frid'=>$vendorleadsmodel['frid'],'crtby'=>$vendorleadsmodel['crtby']));       
        echo json_encode($result);
        /*return $this->render('_form', [
                 'vendorleadsmodel' => $result,
            ]);*/
    } 
    
    public function actionCreate()
    {        
        $model = new VendorLeads();
        $mdlvendor = new \backend\models\Vendor();
        if ($model->load(Yii::$app->request->post())) {
             try {
               $msgarr = $this->saveModels(array(
                        'model' => $model,
                        'mdlvendor'=> $mdlvendor,                       
                    ));
                $searchModel = new VendorleadsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'arraydata'=> $msgarr,
                ]);
               
                   // echo 'commming back here....';
                // get uploaded file name to save the Vendor model
            } catch (Exception $e) {
                //$transaction->rollBack();
                throw $e;
            }
           // return $this->redirect(['view', 'id' => $model->vlid]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'mdlvendor' => $mdlvendor,
            ]);
        }
    }

    /**
     * Updates an existing Vendorleads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->vlid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vendorleads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vendorleads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendorleads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VendorLeads::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
}
