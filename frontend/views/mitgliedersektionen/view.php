<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedersektionen */

$this->title = $model->msekt_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedersektionens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliedersektionen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->msekt_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->msekt_id], [
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
            'msekt_id',
            'mitglied_id',
            'sektion_id',
            'vdatum',
            'vermittler_id',
            'pdatum',
            'pruefer_id',
        ],
    ]) ?>

</div>
