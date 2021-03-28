<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pruefer',
]) . ' ' . $model->prueferId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pruefers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prueferId, 'url' => ['view', 'id' => $model->prueferId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pruefer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
