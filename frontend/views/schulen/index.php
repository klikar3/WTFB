<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SchulenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Schools');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Create School', [
    'modelClass' => 'Schulen',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SchulId',
            'Schulname',
            'sort',
            [ 'attribute' => 'Disziplin',
             'value'=>function ($data) {
                        return empty($data->disziplinen->DispName) ? "-" : $data->disziplinen->DispName;
                      },
            ],
            ['class' => 'kartik\grid\ActionColumn', 
              'width' => '80px',
            ],
            [ 'attribute' => 'swmInteressentenListe',
              'width' => '100px', 'label' => Yii::t('app', 'Interessent List'),
            ],
            [ 'attribute' => 'swmInteressentenForm',
              'width' => '80px', 'label' => Yii::t('app', 'Interessent Form'),
            ],
            [ 'attribute' => 'swmMitgliederListe',
              'width' => '80px', 'label' => Yii::t('app', 'Member List'),
            ],
            [ 'attribute' => 'swmMitgliederForm',
              'width' => '80px', 'label' => Yii::t('app', 'Member Form') ,
            ],
	        ],
    ]); ?>

</div>
