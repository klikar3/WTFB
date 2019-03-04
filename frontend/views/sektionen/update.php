<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sektionen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sektionen',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sektionen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->sekt_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sektionen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
