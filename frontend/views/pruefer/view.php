<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefer */

$this->title = $model->prueferId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pruefers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pruefer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->prueferId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->prueferId], [
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
            'prueferId',
            'pName',
            'sort',
        ],
    ]) ?>

</div>
