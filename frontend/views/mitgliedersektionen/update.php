<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedersektionen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mitgliedersektionen',
]) . $model->msekt_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedersektionens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->msekt_id, 'url' => ['view', 'id' => $model->msekt_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mitgliedersektionen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
