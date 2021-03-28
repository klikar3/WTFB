<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;
use yii\helpers\VarDumper;

//use frontend\models\Grade;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php
$dt = date('d.m.Y');
$this->title = (Yii::$app->controller->action->id == 'info-abendliste') ? Yii::t('app', 'Info-Abend - Liste ') : 'Interessenten - Liste';
//$this->title = Yii::t('app', Yii::$app->controller->action->id);

?>                                                                                                              
<div class="ialiste-index" style="padding-left:20px;">

    <h4><span style="font-family:helvetica, verdana, sansserif;"><?php echo Html::encode($this->title.' für '.$schule ) ?></span></h4>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => false, //$searchModel, 
//        'layout'=>"{summary}\n{items}\n{pager}",
        'layout'=>"{items}",
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
//        'bordered' => true,
        'tableOptions' => [
            'style' => 'font-family: helvetica, verdana, sansserif;font-size: 11pt;border: 1px solid black;text-align:right;'
        ],
//        'options' => [ 
//            'style' => 'border: 1px solid black;'
//        ],
        'headerRowOptions' => [ 
            'style' => 'font-family: helvetica, verdana, sansserif;font-size: 12pt;border: 1px solid black;height:20pt;text-align:right;'
        ],
        'filterRowOptions' => [ 
            'style' => 'font-family: helvetica, verdana, sansserif;font-size: 12pt;border: 1px solid black;height:0pt;text-align:right;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 
        		 'contentOptions' => ['style' => 'height:2.6em;text-align:right;width: 30px;padding-left:2px;padding-right:4px;border:1px solid black;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
						['format' => 'raw',
             'attribute' => 'Name',
             'enableSorting' => false,
             'value'=>function ($data) {
                        return empty($data->Name) ? "" : $data->Name.', '.$data->Vorname;
                      },
        		 'contentOptions' => ['style' => 'height:2.6em;text-align:left;width: 200px;padding-left:4px;border:1px solid black;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],                                                                      
						['format' => 'raw',
             'attribute' => 'KontaktAm',
             'label' => 'Kontakt',
             'value' => function ($data) {
                        return empty($data->KontaktAm) ? '' : \DateTime::createFromFormat('Y-m-d', $data->KontaktAm)->format('d.m.Y');
                      },
             'enableSorting' => false,
        		 'contentOptions' => ['style' => 'text-align:left;width: 85px;padding:2px;border:1px solid black;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],                                                                      
						['format' => 'raw',
             'attribute' => 'Email',
             'enableSorting' => false,
             'label' => 'Email',
        		 'contentOptions' => ['style' => 'width: 200px;text-align:left;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
						['format' => 'raw',
             'attribute' => 'Disziplin',
             'label' => 'Disz',
             'value' => function ($data) { 
                        return ((empty($data->Disziplin) ? "" : ($data->Disziplin == "WT-Kinder") ? "K" : "W")) ;
                      },
             'enableSorting' => false,
        		 'contentOptions' => ['style' => 'width: 15px;text-align:center;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
						['format' => 'raw',
             'attribute' => 'Telefon1',
             'value' => function ($data) { 
                        return ((empty($data->Telefon1) ? "" : $data->Telefon1 ) . 
                               (empty($data->Telefon2) ? "" : " " . $data->Telefon2) . 
                               (empty($data->HandyNr) ? "" : " " . $data->HandyNr)) ;
                      },
             'enableSorting' => false,
        		 'contentOptions' => ['style' => 'width: 100px;text-align:left;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
						['format' => 'raw',
             'attribute' => 'EinladungIAzum',
             'label' => 'IA am',
             'value' => function ($data) {
                        return empty($data->EinladungIAzum) ? '' : \DateTime::createFromFormat('Y-m-d', $data->EinladungIAzum)->format('d.m.Y');
                      },
             'enableSorting' => false,
        		 'contentOptions' => ['style' => 'text-align:left;width: 85px;padding:2px;border:1px solid black;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],                                                                      
             [
             'label'=>'best.',
             'format' => 'raw',
             'enableSorting' => false,
             'value'=>function ($data) {
                        return ($data->IABest) ? "X" : "";
                      },
        		 'contentOptions' => ['style' => 'font-size: 13pt;width: 40px;text-align:center;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
             ],
						['format' => 'raw',
             'attribute' => 'WarZumIAda',
             'enableSorting' => false,
             'label' => 'da',
             'value'=>function ($data) {
                        return ($data->WarZumIAda) ? "X" : "";
                      },
        		 'contentOptions' => ['style' => 'width: 40px;text-align:center;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
						['format' => 'raw',
             'attribute' => 'Woher',
             'enableSorting' => false,
             'label' => 'Woher',
        		 'contentOptions' => ['style' => 'width: 150px;text-align:left;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
             [
             'label'=>'PT am',
             'enableSorting' => false,
             'format' => 'raw',
             'value' => function ($data) {
                        return empty($data->ProbetrainingAm) ? '' : \DateTime::createFromFormat('Y-m-d', $data->ProbetrainingAm)->format('d.m.Y');
                      },
        		 'contentOptions' => ['style' => 'width: 85px;text-align:center;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
             ],
						['format' => 'raw',
             'attribute' => 'PTwarDa',
             'enableSorting' => false,
             'label' => 'da',
             'value'=>function ($data) {
                        return ($data->PTwarDa) ? "X" : "";
                      },
        		 'contentOptions' => ['style' => 'width: 40px;text-align:center;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
            ],
             [ 'attribute' => 'Bemerkung1',
             'label'=>'Bemerkung',
             'format' => 'raw',
             'enableSorting' => false,
//             'value'=>function ($data) {
//                        return Yii::t('app', ' ');
//                      },
        		 'contentOptions' => ['style' => 'width: 200px;text-align:left;padding:2px;border: 1px solid black;border-top:0px;border-left: 0px;'],
             'headerOptions' => ['style'=>'text-align:center;border-right: 1px solid black;border-bottom: 2px solid black;'],
             ],
        ],
        'showFooter' => false,
//        'beforeFooter' => [ [
  //      		'columns' => ['','','']
//        	]
//				]
    ]); ?>
</div>
