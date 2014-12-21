<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mitglieder',
]) . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->MitgliederId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mitglieder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
