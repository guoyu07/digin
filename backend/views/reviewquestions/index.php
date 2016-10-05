<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReviewquestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Review Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/reviewquestion.js"></script>
<div class="reviewquestions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!--?= Html::a(Yii::t('app', 'Create Reviewquestions'), ['create'], ['class' => 'btn btn-success']) ?-->
    </p>
    
 <div class="reviewquestions-form">
<?php Pjax::begin() ?>
    
    <?php $form = ActiveForm::begin(['id'=>'reviewquestionform']); ?>
    
    <div class="row">
        <div class="col-xs-5">
            <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>
        </div>
    </div>
     
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 <?php Pjax::end() ?>
</div>

<div id="message" style="display: none;"></div>


<?php Pjax::begin(['id'=>'reviewquestiongrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'qid',
            'question:ntext',
           /* 'crtdt',
            'crtby',
            'upddt',
             'updby',*/

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
