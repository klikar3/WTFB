<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Texte */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Texte',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Textes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="texte-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
