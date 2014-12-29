<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;

use frontend\models\Grade;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prüfungsliste');
?>
<div class="mitgliedergrade-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 

		$dataProvider->pagination->pageSize = 10;
//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//		$dataProvider->sort = ['defaultOrder' => ['PruefungZum'=>SORT_ASC]];
		
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['style' => 'font-size: 36px;']],
						['format' => 'raw',
             'attribute' => 'NameLink',
        		 'contentOptions' => ['style' => 'font-size: 36px;'],
            ],
						['format' => 'raw',
             'attribute' => 'MitgliederId',
        		 'contentOptions' => ['style' => 'font-size: 36px;'],
            ],
						['format' => 'raw',
             'attribute' => 'PZum',
        		 'contentOptions' => ['style' => 'font-size: 36px; width: 180px;'],
            ],
             [
             'label'=>'Lg.-Gebühr',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Yii::t('app', '35.00');
                      },
        		 'contentOptions' => ['style' => 'font-size: 36px; width: 150px;'],
             ],
             [
             'label'=>'P.-Gebühr',
             'format' => 'raw',
             'value'=>'PGeb',
        		 'contentOptions' => ['style' => 'font-size: 36px;'],
             ],
             [
             'label'=>'Gesamt',
//             'format' => 'raw',
				     'format'=>['decimal',2],
             'value'=>function ($data) {
                        if (empty($data)) return 0;
                        return $data->PGeb + 35.00;
                      },
        		 'contentOptions' => ['style' => 'font-size: 36px;'],
             ],
        ],
        'showFooter' => true,
//        'beforeFooter' => [ [
  //      		'columns' => ['','','']
//        	]
//				]
    ]); ?>

</div>
