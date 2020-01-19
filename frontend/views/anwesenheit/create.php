<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anwesenheit */

$this->title = Yii::t('app', 'Create Anwesenheit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anwesenheits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anwesenheit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
