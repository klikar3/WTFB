<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\grid\GridView;

use frontend\models\Pruefer;
use frontend\models\Disziplinen;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PruefungenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prüfungen');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Prüfung anlegen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'disp.DispName',
						[ 'attribute' => 'datum', 'value' => 'datum', 'format' => ['date', 'php:d.m.Y'], 'label' => 'Datum'  ],
            'pruefer.pName',
//            'erledigt',
						[  'attribute' => 'erledigt',
						    'format' => 'raw',
						    'value' => function ($model, $index, $widget) {
						        return Html::checkbox('erledigt[]', $model->erledigt, ['value' => $index, 'disabled' => true]);
						    },
							'width' => '4em',
							'contentOptions' =>['class' => 'hidden-xs table_class','style'=>'font-size:12px;text-align:center !important'],
							'filterType' => GridView::FILTER_CHECKBOX,
							'label' => 'erledigt',
//							'mergeHeader' => true,
//							'filterWidgetOptions' => ['pluginOptions'=>['threeState'=>true]],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
								'style' => 'font-size:12px;width:4em !important;text-align:center !important;',
							],								
            ],
            ['class' => 'yii\grid\ActionColumn',                 
             'options' => [
                    'style' => 'width:6em;',
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
