<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
header('Content-Type: text/html; charset=utf-8');  
AppAsset::register($this);

?>
<?php $this->beginPage(); 

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
 
    <!--meta charset="< ?= Yii::$app->charset ? >"-->
    <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Digin',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
    $vendor = new backend\models\Vendor();
    $getvid = $vendor->getVid();
    }
    $role='';
    $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach($userrole as $r)
    {
      $role=$r->name;
    }
    if (!Yii::$app->user->isGuest) {
    $menuItems = [
        ['label' => 'Dashboard', 'url' => ['/site/index'], 'visible'=>$role!='Subscriber'],
        ['label'=> 'Masters', 'url'=>'#', 'items'=>[
            ['label' => 'Category', 'url' => ['/category/index'], 'visible'=>$role=='Admin' || $role=='Superadmin' ],
		['label' => 'Plan', 'url' => ['/plan/index'], 'visible'=>$role=='Admin' || $role=='Superadmin' ],
		['label' => 'Facility', 'url' => ['/facility/index'], 'visible'=>$role=='Admin' || $role=='Superadmin' ],
		['label' => 'Vendor Type', 'url' => ['/vendortype/index'], 'visible'=>$role=='Admin' || $role=='Superadmin' ],
                ['label' => 'Product', 'url' => ['/product/index'], 'visible'=>$role=='Admin' || $role=='Superadmin' || $role=='Vendor'],
                ['label' => 'Vendor', 'url' => ['/vendor/index'], 'visible'=>$role=='Executive' || $role=='Admin' || $role=='Superadmin'],                                
                ['label' => 'Review Questions', 'url' => ['/reviewquestions/index'], 'visible'=>$role=='Admin' || $role=='Superadmin'],
                ['label' => 'User', 'url' => ['/user-detail/index'], 'visible'=>$role=='Admin' || $role=='Superadmin']
        ], 'visible'=>$role!='Subscriber'],
       
    ];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
    } else {
        $menuItems[] = ['label'=> 'My Account', 'url'=>'#', 'items'=>[
                    //['label' => 'Profile', 'url' => ['/user/settings/profile']],
                   // ['label' => 'Edit Profile', 'url' => ['/vendor/update','id' =>$getvid,'Edit'=>1],'visible'=>$role=='Vendor'],
                    ['label' => 'Change Password', 'url' => ['/user/settings/account']],
                    ['label' => 'Logout (' . Yii::$app->user->identity->username . ')','url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']]
                ]];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Digin <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>
     

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    //'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
 <script type="text/javascript">   
      $(document).on('click', '.showModalButton', function(){
        //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        /*if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal via title tag
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {*/
            //if modal isn't open; open it and load content
            $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
             //dynamiclly set the header for the modal via title tag
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        //}
    });
</script> 

<!--<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/moment.js"></script>-->
<!--<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/daterangepicker.js"></script>-->



