<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedersektionenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliedersektionens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Create Mitgliedersektionen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'msekt_id',
            'mitglied_id',
            'sektion_id',
            'vdatum',
            'vermittler_id',
            'pdatum',
            'pruefer_id',

            ['class' => 'yii\grid\ActionColumn',                 
             'options' => [
                    'style' => 'width:6em;',
                ],
            ],
        ],
    ]); ?>
</div>
