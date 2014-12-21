<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiterschulen */

$this->title = $model->ssId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulleiterschulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schulleiterschulen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ssId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ssId], [
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
            'ssId',
            'leiter.LeiterName',
            'schul.Schulname',
            'disp.DispName',
        ],
    ]) ?>

</div>
