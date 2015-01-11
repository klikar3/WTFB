<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedergrade */

$this->title = $model->mgID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedergrades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliedergrade-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->mgID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->mgID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mgID',
            'MitgliedId',
            'GradId',
            'Datum',
            'PrueferId',
        ],
    ]) ?>

</div>
