<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederschulenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Austritte');
$this->params['breadcrumbs'][] = $this->title;

// Set LinkPager defaults
\Yii::$container->set('yii\widgets\LinkPager', [
        'options' => ['class' => 'pagination'],
        'firstPageCssClass' => 'prev',
        'lastPageCssClass' => 'next',
        'prevPageCssClass' => 'prev',
        'nextPageCssClass' => 'next',
        'activePageCssClass' => 'active',
        'disabledPageCssClass' => 'disabled',
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last'
]);  
?>
<div class="maustritte-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'filterModel' => false,
        'showPageSummary' => true,
//        'emptyCell'=>'-',
        'columns' => [
//            ['attribute' => 'msID', 'width' => '60px'],
            ['attribute' => 'NameLink',
             'format' => 'raw', 
             'width' => '200px'
            ],
//            'mitglieder.Vorname',
//            'mitglieder.Name',
            'schul.SchulDisp',
//            'SchulId',
            [ 'attribute' => 'mgl.Grad',
              'label' => 'Grade',
              'value' => function ($data) {
                  return !empty($data->mgl->Grad) ? $data->mgl->Grad : '-';
                  },
            ],
            ['attribute' => 'Von',
              'label' => 'Eintritt',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Von)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'KuendigungAm',
              'label' => 'Kündigung',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->KuendigungAm)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'Bis',
              'label' => 'Austritt',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Bis)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'MonatsBeitrag',
//             'enableSorting' => ($print == 1) ? false : true,
             'width' => '100px',
             'pageSummary' => true,
             'pageSummaryOptions' => [
                'append' => '.00',
             ],
            ],
//            'VertragId',

//            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>

</div>
