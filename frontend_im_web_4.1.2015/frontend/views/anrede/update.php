<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anrede */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Anrede',
]) . ' ' . $model->anrId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anredes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anrId, 'url' => ['view', 'id' => $model->anrId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="anrede-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
