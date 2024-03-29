<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Intensiv */

$this->title = $model->id . ' - ' . $model->mitglied->Name . ', ' . $model->mitglied->Vorname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Intensiv'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="intensiv-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'mitgliederId',
            'kontaktNachricht:ntext',
            'telefonatAm', 
            'alter',
            'graduierung',
            'wieLangeWt',
            'ausbQuali',
            'unterrichtet',
            'eigeneSchule',
            'eigeneLehrer',
            'organisation',
            'erfAndereStile',
            'ziel',
            'wievielZeit',
            'trainingsPartner',
            'erstTermin',
            'bemerkung:ntext',
        ],
    ]) ?>

</div>
