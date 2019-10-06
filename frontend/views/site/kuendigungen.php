<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederschulenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kündigungen');
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
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            window.print();
        });
    </script>

<div class="maustritte-index">

   <div class="row"> 
      <div class="col-md-6">
          <h1><?= Html::encode($this->title) ?></h1>
      </div>  
      <div class="col-md-6" style="text-align:right">    
   <?= ($print == 0) ? Html::a('Druckversion',Url::toRoute(['site/kuendigungen','von' => $von, 'bis' => $bis, 'schule' => $schule, 'print' => 1]),['class' => 'btn btn-primary']) : '' ?>
        <?php
          if ($print == 1) {
        ?>
          <form id="form1">
            <input type="button" value="Drucken" id="btnPrint" class="btn btn-primary"/>
          </form>
        <?php
          }
        ?> 
      </div>
   </div>
   <?php if (!empty($print)) {$dataProvider->sort = false; $dataProvider->pagination = false;} ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'showPageSummary' => true,
        'columns' => [
//            ['attribute' => 'msID', 'width' => '60px'],
            ['attribute' => 'NameLink',
             'format' => 'raw', 
             'label' => 'Name',
             'width' => '200px'
            ],
//            'mitglieder.Vorname',
//            'mitglieder.Name',
            ['attribute' => 'schul.SchulDisp',
             'label' => 'Schule',
            ],
//            'SchulId',
            ['attribute' => 'mgl.Grad',
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


//            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>

</div>
