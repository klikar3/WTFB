<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Texte */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Texte',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Texte'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="texte-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
