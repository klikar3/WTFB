<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Funktion */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Funktion',
]) . ' ' . $model->funkId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Funktions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->funkId, 'url' => ['view', 'id' => $model->funkId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="funktion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
