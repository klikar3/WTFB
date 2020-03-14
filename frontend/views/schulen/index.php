<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SchulenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Schulen');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schulen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
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
              'width' => '100px', 'label' => 'Interessenten Liste',
            ],
            [ 'attribute' => 'swmInteressentenForm',
              'width' => '80px', 'label' => 'Interessenten Form',
            ],
            [ 'attribute' => 'swmMitgliederListe',
              'width' => '80px', 'label' => 'Mitglieder Liste',
            ],
            [ 'attribute' => 'swmMitgliederForm',
              'width' => '80px', 'label' => 'Mitglieder Form' ,
            ],
	        ],
    ]); ?>

</div>
