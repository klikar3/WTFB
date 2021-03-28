<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Grade */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Grade',
]) . ' ' . $model->gradId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gradId, 'url' => ['view', 'id' => $model->gradId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
