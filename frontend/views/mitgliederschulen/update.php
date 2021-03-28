<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederschulen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mitgliederschulen',
]) . ' ' . $model->msID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliederschulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->msID, 'url' => ['view', 'id' => $model->msID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mitgliederschulen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
