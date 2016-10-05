<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var $this   yii\web\View
 * @var $title  string
 * @var $module dektrium\user\Module
 */

$this->title = $title;

?>

<?= $this->render('/_alert', [
    'module' => $module,
]) ?>

<script type="text/javascript">   
function Redirect() 
{  
   if(window.location.href.indexOf("frontend") > -1) {       
        window.location="http://<?=$_SERVER['SERVER_NAME'] ?>/index.php";
    }
    else if(window.location.href.indexOf("backend") > -1){        
        window.location="http://<?=$_SERVER['SERVER_NAME'] ?>/index.php";
    }
} 
//You will be redirected to a new page in 5 seconds 
setTimeout('Redirect()', 5000);   
</script>