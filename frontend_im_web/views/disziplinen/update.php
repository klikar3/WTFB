<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Disziplinen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Disziplinen',
]) . ' ' . $model->DispId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disziplinens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DispId, 'url' => ['view', 'id' => $model->DispId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="disziplinen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
