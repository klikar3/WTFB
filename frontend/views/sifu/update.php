<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sifu */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sifu',
]) . ' ' . $model->sId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sifus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sId, 'url' => ['view', 'id' => $model->sId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sifu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
