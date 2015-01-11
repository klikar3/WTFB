<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulen */

$this->title = $model->SchulId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schulen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->SchulId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->SchulId], [
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
            'SchulId',
            'Schulname',
            'sort',
            'Disziplin',
        ],
    ]) ?>

</div>
