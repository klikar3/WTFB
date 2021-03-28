<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vertrag */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Vertrag',
]) . ' ' . $model->VertragId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vertrags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->VertragId, 'url' => ['view', 'id' => $model->VertragId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vertrag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
