<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anwesenheit */

$this->title = Yii::t('app', 'Update Anwesenheit: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anwesenheits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="anwesenheit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
