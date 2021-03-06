<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Intensiv */

//$this->title = Yii::t('app', 'Update Intensiv: {name}', [
//    'name' => $model->id,
//]);
$this->title = $model->id . ' - ' . $model->mitglied->Name . ', ' . $model->mitglied->Vorname;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Intensiv'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="intensiv-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
