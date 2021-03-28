<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SektionenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sektionen');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Sektionen',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sekt_id',
            'kurz',
            'name',

            ['class' => 'yii\grid\ActionColumn',                 
             'options' => [
                    'style' => 'width:6em;',
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
