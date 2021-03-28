<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiterschulen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Schulleiterschulen',
]) . ' ' . $model->ssId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulleiterschulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ssId, 'url' => ['view', 'id' => $model->ssId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="schulleiterschulen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
