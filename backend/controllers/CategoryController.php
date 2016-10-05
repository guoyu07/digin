<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategoryFacilities;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\AccessRule;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
               'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index','create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create','index', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['Superadmin','Admin'],
                    ],                   
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
		
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);        
                   
        return $this->render('view', [
            'model' => $model,
                 
        ]);
        
    }
    
    

    /*
     *Saves category model & CategoryFacility model and returns the success status 
     *@param array $modelsArray
     *@return boolean 
     */
    public function saveAllModels($modelsArray)
    {       
        $model=$modelsArray['model'];
        $mdlCategoryFacility=$modelsArray['mdlCategoryFacility'];  
        $connection = Yii::$app->db;
        $success=true;  
        
        if(isset($_POST['Category']['category']) && $_POST['Category']['category']!=null)
        {
            $model->parentid=$_POST['Category']['category'];
        }
        else{
            $model->parentid=0;
        }
        $model->name=$_POST['Category']['name'];
        $model->tags=$_POST['Category']['tags'];
        if($model->isNewRecord)
        {    
        $model->tags.=', '.$model->name;              
        } 
        //Calculating path for sub category if parent path exists
        $path=null;
        if($model->parentid!=0){
            $path= Category::findBySql("select path from category where id=".$model->parentid)->one();
        }
        if($path!=null)
        {
            $model->path=$path['path']." > ".$model->name;
        }
        else
        {
           $model->path= $model->name;
        }
                             
        $uploadedFile=UploadedFile::getInstance($model,'image');  
         if(($uploadedFile!== null && $uploadedFile!=='' 
                && $uploadedFile->size !== 0 ) 
                || $model->isNewRecord)
        {
            $fileName = $uploadedFile;  //  file name
            $model->image = $fileName;     
        }
        else
        {
            $model->image=  Category::findOne($model->id)->image;
        }        
        $transaction = $connection->beginTransaction();
        // If the vendor model is saved then proceed to save other models.
        if($model->save())
        {    
            if(isset($_POST['CategoryFacilities']['facidarray'])){
                $mdlCategoryFacility->facidarray=$_POST['CategoryFacilities']['facidarray']; 
            }   
             //Delete all the Category facilities before saving new.
            CategoryFacilities::deleteAll(['catid'=>$model->id]); 
            if(isset($mdlCategoryFacility->facidarray) && $mdlCategoryFacility->facidarray!=''){
            foreach ($mdlCategoryFacility->facidarray as $fc)
             {
                 $fac=new \backend\models\CategoryFacilities();
                 $fac->catid=$modelsArray['model']->id;                 
                 $fac->facid=$fc;             
                 $success=$fac->save();
            }
            }
             if($success)
             {
                 if(($uploadedFile!= null && $uploadedFile!='' ) || $model->isNewRecord)
                 {
                     
                     $fileSavePath=Yii::$app->basePath. '/../images/categoryimages/'. $model->id.'/';                           
                     if (!file_exists ($fileSavePath))
                        mkdir ($fileSavePath, 0755, true);
                    $uploadedFile->saveAs($fileSavePath.$fileName);  // image will uplode to rootDirectory/images/categoryimages/
                 }
                 $transaction->commit();
                return $this->redirect(['index']);
             }
             else
             {
                 $transaction->rollBack();
                  return $this->render('create', [
                    'model' => $model,
                    'mdlCategoryFacility'=>$mdlCategoryFacility,
                  ]);
             }
         }
         else
         {
              return $this->render('create', [
              'model' => $model,
              'mdlCategoryFacility'=>$mdlCategoryFacility,
            ]);
         }
               
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
	$mdlCategoryFacility=new \backend\models\CategoryFacilities();	
        
        $model->status=1;
        if ($model->load(Yii::$app->request->post()))
        {    
            try {
                $mdlCategoryFacility->facidarray=$_POST['CategoryFacilities']['facidarray'];                
                $this->saveAllModels(array('model'=>$model,
                                           'mdlCategoryFacility'=>$mdlCategoryFacility));
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }                                                                
        }
        else if(Yii::$app->request->isAjax)
        {
            return $this->renderAjax('_form', [
                        'model' => $model,
                        'mdlCategoryFacility'=>$mdlCategoryFacility,
            ]);
        }
        else 
        {      
            return $this->render('create', [
              'model' => $model,
              'mdlCategoryFacility'=>$mdlCategoryFacility,
            ]);
        }                  
    }
    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parentcatpath=new Category();
        if($model->parentid!=0)
            $parentcatpath= Category::find()->select('path')->where(["id"=>$model->parentid])->one();
        else {
            $parentcatpath->path='';
        }
        $model->path = $parentcatpath->path;
        $model->category = $model->parentid;
       
        $mdlcatfac=  CategoryFacilities::find()->where(['catid' => $model->id])->all();
        $mdlCategoryFacility=new CategoryFacilities();
        // Now add those to newly created models facidarray
       
        foreach ($mdlcatfac as $fac) {           
            array_push($mdlCategoryFacility->facidarray, $fac->facid);
        }
        // We also need the names of those facilities so get it from facility table.        
        $facids = implode(',', $mdlCategoryFacility->facidarray); 
        $catfacilityData=array();
        if($facids!=''){
        $facility = \backend\models\Facility::findBySql("select id, name from facility where id IN(" . $facids . ")")->all();
        $catfacilityData = ArrayHelper::map($facility, 'id', 'name');
        }
        
        if ($model->load(Yii::$app->request->post()) ) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $this->saveAllModels(array('model' => $model,
                                       'mdlCategoryFacility'=>$mdlCategoryFacility,));
        } else {
            return $this->render('update', [
                'model' => $model,
                'mdlCategoryFacility'=>$mdlCategoryFacility,
                'catfacilityData'=>$catfacilityData
                
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSearchPath()
    {
        $model = new Category();
        //echo "search";
        if(Yii::$app->request->isAjax)
        {
            return $this->renderAjax('searchPath', [
                        'model' => $model,                        
            ]);
        }
    }
    public function actionSearch() {
       echo "search...";
    }
	
	public function actionActvendorproduct(){
        $vecatid=$_POST['id'];
		
        $venidactiv=$_POST['venidactiv'];
        if($venidactiv==0){
        $venidactiv= \backend\models\Category::updateAll(['status'=>1], 'id='.$vecatid);
        }else{
        $venidactiv= \backend\models\Category::updateAll(['status'=>0], 'id='.$vecatid); 
        }
         if($venidactiv>0)
            echo "1";
        else{
            echo "0";
        }
        
    }
	
	
	
}