<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;
use yii\helpers\VarDumper;

use frontend\models\Grade;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seminarliste für ' . Yii::$app->formatter->asDate($plf->datum, 'dd.MM.YYYY'));

?>
<div class="mitgliedergrade-index" style="padding-left:20px;">
    <div style="text-align: center;">
    <h3><?= Html::encode($this->title) ?></h3></div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        
		//Yii::info("-----Prüfungsliste: ".Vardumper::dumpAsString($plf));

		$dataProvider->pagination->pageSize = 200;
//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//		$dataProvider->sort = ['defaultOrder' => ['PruefungZum'=>SORT_ASC]];
		
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel, 
//        'layout'=>"{summary}\n{items}\n{pager}",
        'layout'=>"{items}",
//        'bordered' => true,
        'tableOptions' => [
            'style' => 'font-size: 13pt;border: 1px solid black;text-align:right'
        ],
//        'options' => [ 
//            'style' => 'border: 1px solid black;'
//        ],
        'headerRowOptions' => [ 
            'style' => 'font-size: 12pt;border: 1px solid black;height:20pt;text-align:right;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 
             'contentOptions' => ['style' => ';width: 50px;height:2.3em;text-align:right;padding:2px;border: 1px solid black;border-top:1px;border-left: 0px;margin-left:0px;'],
             'headerOptions' => ['style'=>'height:2.5em;text-align:right;border-right: 1px solid black;border-bottom: 2px solid black;'],
//              'options' => [
//                  'style' => 'border: 1px 1px 0px 0px solid black;'
//              ],
            ],
						['format' => 'raw',
             'attribute' => 'NameLink',
             'value'=>function ($data) {
                        return empty($data->Nachname) ? "" : $data->Vorname." ".$data->Nachname; //$data->Name;
                      },
        		 'contentOptions' => ['style' => 'text-align:left;width: 500px;padding-left:4px;border:1px solid black;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:left;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],                                                                      
/*						['format' => 'raw',
             'attribute' => 'MitgliederId',
        		 'contentOptions' => ['style' => 'font-size: 36px;'],
            ],
*/            
						['format' => 'raw',
             'attribute' => 'PZum',
             'label' => 'Prüfung',
        		 'contentOptions' => ['style' => 'width: 100px;text-align:right;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:right;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
             [
             'label'=>'Lg.-Gebühr',
             'format' => 'raw',
             'value'=>function ($data) use($plf) {
                        return Yii::t('app', $plf->pgeb);
                      },
        		 'contentOptions' => ['style' => 'width: 100px;text-align:right;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:right;border-right: 1px solid black;border-bottom: 2px solid black;'],
             ],
             [
             'label'=>'P.-Gebühr',
//				     'format'=>['decimal',2],
             'format' => 'raw',
             'value'=>function ($data) {
                        return ($data->PGeb=='0') ? '' : Yii::$app->formatter->asInteger($data->PGeb);
                      },
        		 'contentOptions' => ['style' => 'width: 100px;text-align:right;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:right;border-right: 1px solid black;border-bottom: 2px solid black;'],
             ],
             [
             'label'=>'Gesamt',
             'format' => 'raw',
//				     'format'=>['decimal',2],
             'value'=>function ($data) use($plf) {
                        return ($data->PGeb=='0') ?  '': ($data->PGeb + $plf->pgeb );
                      },
        		 'contentOptions' => ['style' => 'width: 100px;text-align:right;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;border-right: 0px;'],
             'headerOptions' => ['style'=>'text-align:right;border-bottom: 2px solid black;'],
             ],
        ],
        'showFooter' => false,
//        'beforeFooter' => [ [
  //      		'columns' => ['','','']
//        	]
//				]
    ]); ?>

</div>
