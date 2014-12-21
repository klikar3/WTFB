<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiter */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Schulleiter',
]) . ' ' . $model->LeiterId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulleiters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->LeiterId, 'url' => ['view', 'id' => $model->LeiterId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="schulleiter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
