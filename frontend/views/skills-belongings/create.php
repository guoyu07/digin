<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsBelongings */

$this->title = 'Create Skills Belongings';
$this->params['breadcrumbs'][] = ['label' => 'Skills Belongings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-belongings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
