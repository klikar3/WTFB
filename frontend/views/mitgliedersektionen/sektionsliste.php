<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;

use frontend\models\Grade;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sektionsliste für ' . date('d.m.Y'));

?>
<div class="mitgliedergrade-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        
//		Yii::info("-----Sektionsliste: ".Vardumper::dumpAsString($plf));

		$dataProvider->pagination->pageSize = 200;
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['style' => 'font-size: 12pt;width: 50px;text-align:right;']],
						['format' => 'raw',
             'attribute' => 'mitglied.Name',
        		 'contentOptions' => ['style' => 'font-size: 12pt;width: 200px;'],
            ],
						['format' => 'raw',
             'attribute' => 'mitglied.Vorname',
        		 'contentOptions' => ['style' => 'font-size: 12pt;width: 200px;'],
            ],
						['format' => 'raw',
             'attribute' => 'sektion.name',
        		 'contentOptions' => ['style' => 'font-size: 12pt;width:400px;'],
            ],
						['format' => ['date', 'php:d.m.Y'],
             'attribute' => 'vdatum',
             'label' => 'Vermittelt',
        		 'contentOptions' => ['style' => 'font-size: 12pt; width: 200px;text-align:right;'],
            ],
						['format' => ['date', 'php:d.m.Y'],
             'attribute' => 'pdatum',
             'label' => 'Geprüft',
        		 'contentOptions' => ['style' => 'font-size: 12pt; width: 200px;text-align:right;'],
            ],
        ],
        'showFooter' => false,
//        'beforeFooter' => [ [
  //      		'columns' => ['','','']
//        	]
//				]
    ]); ?>

</div>
