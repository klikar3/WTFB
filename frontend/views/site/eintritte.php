<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederschulenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Eintritte');
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
/*            var divContents = $("#maustritte-index").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();*/
            window.print();
        });
    </script>
<div class="maustritte-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   <?= ($print == 0) ? Html::a('Druckversion',Url::toRoute(['site/eintritte','von' => $von, 'bis' => $bis, 'schule' => $schule, 'print' => 1]),['class' => 'btn btn-primary']) : '' ?>
<?php
  if ($print == 1) {
?>
  <form id="form1">
    <input type="button" value="Drucken" id="btnPrint" class="btn btn-primary"/>
  </form>
<?php
  }
?>

   <?php if (!empty($print)) {$dataProvider->sort = false; $dataProvider->pagination = false;} ?>
    <div id="dvContainer">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false, //$searchModel,
        'showPageSummary' => true,
        'columns' => [
//            ['attribute' => 'msID', 'width' => '60px'],
            ['attribute' => 'NameLink',
             'format' => 'raw', 
             'width' => '250px',
             'value' => function ($data) use ($print){
                  return ($print == 1) ? $data->mitglieder->Name.', '.$data->mitglieder->Vorname : $data->NameLink;
                  },
            ],
//            'mitglieder.Vorname',
//            'mitglieder.Name',
            ['attribute' => 'schul.SchulDisp',
             'width' => '100px',
             'label' => 'Schule',
            ],
            ['attribute' => 'VDatum',
             'value' => function ($data) {
                  return empty($data->VDatum) ? '' : \DateTime::createFromFormat('Y-m-d', $data->VDatum)->format('d.m.Y');
                  },
             'enableSorting' => ($print == 1) ? false : true,
             'width' => '100px',
            ],
            ['attribute' => 'Von',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Von)->format('d.m.Y');
                  },
             'enableSorting' => ($print == 1) ? false : true,
             'width' => '100px',
            ], 
            ['attribute' => 'MonatsBeitrag',
             'enableSorting' => ($print == 1) ? false : true,
             'width' => '100px',
             'pageSummary' => true,
             'pageSummaryOptions' => [
                'append' => '.00',
             ],
            ],
/*            ['attribute' => 'Bis',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Bis)->format('d.m.Y');
                  }
            ],*/ 
//            'VertragId',

//            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>
    </div>

</div>
