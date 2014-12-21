<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedergrade */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mitgliedergrade',
]) . ' ' . $model->mgID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedergrades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mgID, 'url' => ['view', 'id' => $model->mgID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mitgliedergrade-update">

    <h1><?= Html::encode($this->title) ?> f&uuml;r <br><?= $model->mitglied->Vorname . ' ' . $model->mitglied->Name  ?>

</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
