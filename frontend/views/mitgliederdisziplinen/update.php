<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederdisziplinen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mitgliederdisziplinen',
]) . ' ' . $model->maId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliederdisziplinens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->maId, 'url' => ['view', 'id' => $model->maId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mitgliederdisziplinen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
