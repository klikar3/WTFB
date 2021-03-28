<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Intensiv */

$this->title = Yii::t('app', 'Create Intensiv');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Intensivs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intensiv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
