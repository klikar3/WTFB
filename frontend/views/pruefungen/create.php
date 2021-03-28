<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefungen */

$this->title = Yii::t('app', 'Prüfung anlegen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prüfungen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pruefungen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
