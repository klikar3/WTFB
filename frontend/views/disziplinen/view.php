<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Disziplinen */

$this->title = $model->DispId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disziplinens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disziplinen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->DispId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->DispId], [
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
            'DispId',
            'DispName',
            'sort',
            'DispKurz',
        ],
    ]) ?>

</div>
