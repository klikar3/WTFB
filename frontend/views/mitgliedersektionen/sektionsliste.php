<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\VarDumper;

use kartik\grid\GridView;

use frontend\models\Grade;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sektionsliste für ' . $schule . ' am ' . date('d.m.Y'));

?>
<div class="mitgliedergrade-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        
//		Yii::info("-----Sektionsliste: ".Vardumper::dumpAsString($plf));

		$dataProvider->pagination->pageSize = 200;
    $dataProvider->sort = false;
//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//		$dataProvider->sort = ['defaultOrder' => ['PruefungZum'=>SORT_ASC]];
		
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel, 
//        'layout'=>"{summary}\n{items}\n{pager}",
        'layout'=>"{items}",
		    'formatter' => [
		        'class' => 'yii\i18n\Formatter',
		        'nullDisplay' => '',
		    ],
        'tableOptions' => [
            'style' => 'width: 800px;',
        ],
        'headerRowOptions' => [ 
            'style' => 'font-family: helvetica, verdana, sansserif;font-size: 14pt;border: 2px solid black;text-align:right;',
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 
        		 'contentOptions' => ['style' => 'text-align:right;'],
            ],
						['format' => 'raw',
             'attribute' => 'mitglied.Name',
              'value' => function ($data) {
//                  Yii::warning(VarDumper::dumpAsString($data),'application');
                  return $data->Vorname . ' ' .$data->Nachname;
                  },
//        		 'contentOptions' => ['style' => 'font-family: helvetica, verdana, sansserif;font-size: 12pt;width: 200px;border: 1px solid black;border-top:0px;border-left: 0px;'],
            ],
//						['format' => 'raw',
//             'attribute' => 'mitglied.Vorname',
////        		 'contentOptions' => ['style' => 'font-family: helvetica, verdana, sansserif;font-size: 12pt;width: 200px;border: 1px solid black;border-top:0px;border-left: 0px;'],
//              'value' => function ($data) {
////                  Yii::warning(VarDumper::dumpAsString($data),'application');
//                  return !empty($data->mitglied->Vorname) ? $data->mitglied->Vorname : '-';
//                  },
//            ],
						['format' => 'raw',
             'attribute' => 'sektion.name',
             'label' => 'Programm',
        		 'contentOptions' => ['style' => 'text-align:left;'],
            ],
//						['format' => ['date', 'php:d.m.Y'],
//             'attribute' => 'vdatum',
//             'label' => 'Vermittelt',
////        		 'contentOptions' => ['style' => 'font-family: helvetica, verdana, sansserif;font-size: 12pt; width: 200px;text-align:right;border: 1px solid black;border-top:0px;border-left: 0px;'],
//            ],
						['format' => ['date', 'php:d.m.Y'],
             'attribute' => 'pdatum',
             'label' => 'Abgenommen',
        		 'contentOptions' => ['style' => 'text-align:center;'],
            ],
        ],
        'showFooter' => false,
//        'beforeFooter' => [ [
  //      		'columns' => ['','','']
//        	]
//				]
    ]); ?>

</div>
