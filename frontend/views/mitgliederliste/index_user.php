<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
/*use yii\grid\GridView; */
use yii\helpers\VarDumper;


use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\checkbox\CheckboxX;
use kartik\datecontrol\datecontrol;
use kartik\widgets\DatePicker;
use kartik\money\MaskMoney;

use frontend\models\Mitglieder;
use frontend\models\PruefungslisteForm;
use frontend\models\Disziplinen;
use frontend\models\Texte;
 


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Member List');
$this->params['breadcrumbs'][] = $this->title;

$plf = new PruefungslisteForm();
$datum = date('d.m.Y');
$plf->datum = $datum;
//$plf->pgeb = 40.00;
$plf->disp = 'Wing Tzun';
$content_plf = $this->render('pliste_preform',['plf' => $plf]);

$mcf = new Mitglieder();
//$mcf->BeitrittDatum = $datum;
//$mcf->Geschlecht = 'männlich';
$mcf->Funktion = 'Schüler/in';
//$mcf->MitgliederId = Mitglieder::find()->max('MitgliederId') + 1;
$mcf->MitgliederId = Yii::$app->db->createCommand('SELECT MAX(MitgliederId) FROM mitglieder')->queryScalar() + 1;
$mcf->MitgliedsNr = 0;

$content_mcf = $this->render('mgcreate_preform',['mcf' => $mcf]);
$dataProvider2 = $dataProvider;

$mcef = new \yii\base\DynamicModel([
        'emailInhalt', 'Schulort', 'Funktion', 'MitgliederId', 'KontaktAm', 'Disziplin'
    ]);                             
$mcef->addRule(['emailInhalt', 'Schulort', 'Funktion', 'MitgliederId', 'Disziplin'], 'required')
    ->addRule(['emailInhalt'], 'string',['max'=>999])
    ->addRule('Funktion', 'string',['max'=>32])
    ->addRule('Schulort', 'string',['max'=>32])
    ->addRule('Disziplin', 'string',['max'=>32])
    ->addRule('KontaktAm' ,'date', ['format' => 'php:Y-m-d'])
    ->addRule('MitgliederId', 'integer');
$mcef->MitgliederId = $mcf->MitgliederId;
$mcef->Funktion = 'Schüler/in';

$content_mecf = $this->render('mgemailcreate_preform',['mcf' => $mcef]);;

// Set LinkPager defaults
\Yii::$container->set('yii\widgets\LinkPager', [
        'options' => ['class' => 'pagination'],
/*        'firstPageCssClass' => 'prev',
        'lastPageCssClass' => 'next',
        'prevPageCssClass' => 'prev',
        'nextPageCssClass' => 'next',
        'activePageCssClass' => 'active',
        'disabledPageCssClass' => 'disabled',
*/        'firstPageLabel' => '««',
        'lastPageLabel' => '»»',
        'maxButtonCount' => 7
]);    
?>

<span class="mitglieder-index d-none d-sm-block">
    <?php echo DynaGrid::widget([
//				'storage'=>DynaGrid::TYPE_COOKIE,
				'storage'=>DynaGrid::TYPE_DB,
//				'theme'=>'simple-condensed',
				'options'=>['id'=>'dynagrid-1'], // a unique identifier is important
        'matchPanelStyle' => false,
				'gridOptions'=>[
						'dataProvider'=>$dataProvider,
						'responsiveWrap' => false,
            'condensed' => true,
						'filterModel'=>$searchModel,
            'id' => 'dgrid-11',
						'summary' => '{begin}-{end} '.Yii::t('app', 'of').' {totalCount}',
            'options'=>['id'=>'grid-1'], // a unique identifier is important
//  					'headerRowOptions' => [ 'style' => 'font-size:0.85em'],
//  					'rowOptions' => [ 'style' => 'font-size:0.85em'],
				    'formatter' => [
				        'class' => 'yii\i18n\Formatter',
				        'nullDisplay' => '',
				    ],
//						'emptyCell'=>'-',
						'panel' => [
				        'heading' => '<b>Mitgliederliste</b>',
                'headingOptions' => [
                    'class' => 'card-header text-white my-card',
                ],
							 	'before'=>'{dynagridFilter}{dynagridSort}{dynagrid}'     
						],
//        		'tableOptions'=>['class'=>'table table-striped table-condensed'],
        		'responsive' => true,
						'toolbar' => [
										 	['content'=>$content_mcf . '&nbsp;'  
											],
										 	['content'=>$content_mecf . '&nbsp;'  
											],
										 	['content'=>
													Html::a('<i class="fa fa-minus"></i>', ['/mitgliederliste/resetpliste'], [
													'class'=>'btn btn-default',
													'target'=>'_blank',
													'data-confirm' => 'Wirklich die Prüfungsmarkierungen zurücksetzen?',
													'data-toggle'=>'tooltip',
													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													]) . '&nbsp;'  
											],
										 	['content'=>$content_plf  . '&nbsp;' 
											],
											'{export}' . '&nbsp;',
											'{toggleData}',
									],
				],
/*       'sortableOptions' => [
          'options'=>[
            'id'=> '1-dynagrid-widget'
          ]
        ],
*/        'columns' => [
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{email}{standard}',
							'mergeHeader' => false,
//							'header' => 'Aktion',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'email' => function ($url, $model) {
//									return Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
//													 				'txtid' => 5 ] ), [
									return Html::mailto('<span class="fa fa-envelope"></span>', Url::to($model->Email) .
									"?subject=WingTzun&body=".$model->mitglieder->Anrede." ".$model->Vorname.", %0D%0A %0D%0AViele Grüße %0D%0ASifu Niko und Team",[
//          					'target'=>'_blank',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
							        ]);
							    },
							],
							'width' => '3em',
							'contentOptions' =>['class' => 'hidden-xs table_class'],
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
							],															
						],
// 						['class'=>'kartik\grid\CheckboxColumn', //'order'=>DynaGrid::ORDER_FIX_RIGHT
//						],             
						['format' => 'raw',
              'attribute' => 'NameLink',
              'width' => '10em',
							'label' => Yii::t('app', 'Name'),
//							'contentOptions' =>['class' => 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:10em;',
							],
            ],
            'MitgliederId',
//            'MitgliedsNr',
//						'Name',
//            'Vorname',
            ['attribute' => 'Schulname',
              'label' => Yii::t('app', 'Location'),
//            	'visible' => false,
//							'format' => 'raw',
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],															
						],
            ['attribute' => 'LeiterName',
              'label' => Yii::t('app', 'Headmaster'),
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['attribute' => 'DispName', //'width' => '5em',
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:4em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
						['attribute' => 'Funktion', 
							'width' => '5em',							
              'label' => Yii::t('app', 'Function'),
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						], 
            ['attribute' => 'Vertrag',
            	'width' => '7em',
              'label' => Yii::t('app', 'Contract'),
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:7em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['attribute' => 'Grad', 'width' => '5em',
              'label' => Yii::t('app', 'Level'),
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						 ],
            ['attribute' => 'LetzteAenderung', 'width' => '8em', 
							'format' => ['date', 'php:d.m.Y H:i'], 
              'label' => Yii::t('app', 'Last Change'),
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:8em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['attribute' => 'GeburtsDatum', 'width' => '8em', 
							'format' => ['date', 'php:d.m.Y'],
							'label' => Yii::t('app', 'B.Day'), 
//							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:6em;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{graduieren} &nbsp;&nbsp; {markieren}',
							'controller' => 'mitglieder',
							'mergeHeader' => false,
//							'label' => 'Aktion',
							'buttons' => [ 
								'markieren' => function ($url, $model) {
									return Html::a( $model->printed ? '<span class="fa fa-print" style="color:lightgreen"></span>'
                                                  : '<span class="fa fa-print"></span>'
                                  , Url::toRoute(['mitgliedergrade/print', 'id' => $model->mgID] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Letzte Prüfungsurkunde nochmals drucken'),
							        ]);
							    },
								'graduieren' => function ($url, $model) {
									return Html::a('<span class="fa fa-plus"></span>', Url::toRoute(['mitgliedergrade/createfast', 'mId' => $model->MitgliederId, 'grad' => $model->PruefungZum ]), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Graduierung'),
							        ]);
							    }
							    
							],							
							'contentOptions' =>['class' => 'hidden-xs col-1 table_class','style' => 'font-size:12px;'],
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
							],															
							'width' => '60px',
						],
//            'PruefungZum',
						[
						    'attribute' => 'PruefungZum',
						    'format' => 'raw',
						    'value' => function ($model, $index, $widget) {
						        return Html::checkbox('PruefungZum[]', $model->PruefungZum, ['value' => $index, 'disabled' => true]);
						    },
							'width' => '4em',
							'contentOptions' =>['class' => 'hidden-xs table_class','style'=>'font-size:12px;text-align:center !important'],
							'filterType' => GridView::FILTER_CHECKBOX,
							'label' => 'P. zum',
//							'mergeHeader' => true,
//							'filterWidgetOptions' => ['pluginOptions'=>['threeState'=>true]],
							'filterInputOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
								'style' => 'font-size:12px;width:4em !important;text-align:center !important;',
							],								
							'headerOptions' => [
//								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
								'style' => 'text-align:center !important',
							],																
						],
        ], // -- columns
//        'export' => true,    
		]); ?>

            <!--</div> content -->
     
 <?php // echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
 ?>
</span>
<span class="d-block d-sm-none">    
<?php //echo $content_mcf 
/* \Yii::$container->set('yii\widgets\LinkPager', [
        'options' => ['class' => 'pagination'],
        'firstPageCssClass' => 'prev',
        'lastPageCssClass' => 'next',
        'prevPageCssClass' => 'prev',
        'nextPageCssClass' => 'next',
        'activePageCssClass' => 'active',
        'disabledPageCssClass' => 'disabled',
       'firstPageLabel' => '««',
        'lastPageLabel' => '»»',
        'maxButtonCount' => 3
]); */ 

$summary = Html::a('<i class="fa fa-plus"></i>', ['/mitglieder/create'], [
													'class'=>'btn btn-success', 
													'style'=>"padding-top:0.1em;margin-top:0em;height:1.8em;",
													'data-toggle'=>'tooltip',
													'title'=>'Neuen Eintrag anlegen'
												]
											).'&nbsp;&nbsp;&nbsp;{begin}-{end} von {totalCount}'; 
                      
$toolbar = [
//										 	['content'=>$content_mcf,  
//											],
										 	['content'=>
													Html::a('<i class="fa fa-plus"></i>', ['/mitglieder/create'], [
													'class'=>'btn btn-success',
//													'target'=>'_blank',
//													'data-confirm' => 'Wirklich die Prüfungsmarkierungen zurücksetzen?',
													'data-toggle'=>'tooltip',
													'title'=>'Neuen Eintrag anlegen'
												]
											)]
									]; 
                  
            
//$dataProvider->pagination->setPageSize(25) ;                                       
//Yii::warning('----dataprovider: '.VarDumper::dumpAsString($dataProvider->pagination),'application');
?>

  <div id="content2" name="content2" class="col-12 modal-content">

    <?php /*echo  DynaGrid::widget([
				'storage'=>DynaGrid::TYPE_DB,
				'theme'=>'simple-condensed',
				'options' => ['id'=>'dynagrid-2'], // a unique identifier is important
				'gridOptions'=>[
						'dataProvider'=>$dataProvider2,
						'filterModel'=>$searchModel,
            'id' => 'dgrid-22',
						'summary' => $summary,
						'options' => ['id' => 'dgrid-2'], // a unique identifier is important
						'panel' => [
				        'heading' => '<b>Mitgliederliste</b>',
							 	'before'=>'{dynagridFilter}{dynagridSort}{dynagrid}',
//                'after' => '{pager}',     
//							 	'before'=>'',
//								 'class' => 'col-xs-12',
//								 'theme'=>'panel-condensed',     
						],
//						'panelAfterTemplate' => 'aaa{pager}',
//						'panelFooterTemplate' => '{pager}{toolbar}',
            'formatter' => [
				        'class' => 'yii\i18n\Formatter',
				        'nullDisplay' => '',
				    ],
//        		'tableOptions'=>['class'=>'table table-striped table-condensed','condensed' => true,],
//        		'headerRowOptions' => ['class' => 'col-xs-12', 'style' => 'font-size:1em;'],
//        		'rowOptions' => ['class' => 'col-xs-12', 'style' => 'min-width: 400px;'],
//        		'filterRowOptions' => ['class' => 'col-xs-12', 'style' => 'font-size:1em;'],
        		'responsive' => true,
						'responsiveWrap' => false,
//            'pager' => $pager,
						'toolbar' => false, //$toolbar, 
				],
//        'sortableOptions' => [
//            'id'=> '2-dynagrid-widget'
//        ],
        'columns' => [
						['format' => 'raw',
              'attribute' => 'NameLink',
              'width' => '30%',
							'label' => 'Name',
							'contentOptions' =>['style' => 'font-size:0.8em;'],
							'filterInputOptions' => ['style' => 'font-size:0.8em;',],
							'headerOptions' => ['style' => 'font-size:0.8em;'],															
            ],
 //           ['attribute' => 'LeiterName',
//							'contentOptions' =>['class' => 'col-xs-3 col-sm-3', 'style' => 'font-size:1em;'],
//							'filterInputOptions' => [ 'class' => 'col-xs-3 col-sm-3', 'style' => 'font-size:1em;'],
//							'headerOptions' => [ 'class' => 'col-xs-3 col-sm-3', 'style' => 'font-size:1em;', ],								
//						],
            ['attribute' => 'Vertrag',
              'width' => '30%',
							'contentOptions' =>['style' => 'font-size:0.8em;'],
							'filterInputOptions' => [ 'style' => 'font-size:0.8em;',],								
							'headerOptions' => ['style' => 'font-size:0.8em;', ],								
						],
           ['attribute' => 'LetzteAenderung', 
              'width' => '20%',
							'format' => ['date', 'php:d.m.Y H:i'], 
							'contentOptions' =>['style' => 'font-size:0.8em;'],
							'filterInputOptions' => ['style' => 'width:8em;font-size:0.8em;',],								
							'headerOptions' => ['style' => 'font-size:0.8em;',],								
						],
            ['attribute' => 'LetztAendSifu', 'width' => '20%', 
							'format' => ['date', 'php:d.m.Y H:i'], 
							'label' => 'Letzt.Änd.Sifu', 
							'contentOptions' =>[
								'class' => Yii::$app->user->identity->isAdmin ? 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1' : 'hidden',
								'style' => 'width:20%;font-size:0.8em;',
							],
							'filterInputOptions' => [
								'class' => Yii::$app->user->identity->isAdmin ? 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1' : 'hidden',
								'style' => 'width:8em;font-size:0.8em;',
							],								
							'headerOptions' => [
								'class' => Yii::$app->user->identity->isAdmin ? 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1' : 'hidden',
								'style' => 'width:20%;font-size:0.8em;',
							],								
						],
        ], // -- columns
//        'export' => true,    
		]);*/ ?>
<?php
    if (empty(Yii::$app->user->identity)) {$laes = [] ;}
    else {
              $laes = Yii::$app->user->identity->isAdmin ?               ['attribute' => 'LetztAendSifu', 'width' => '20%', 
  							'format' => ['date', 'php:d.m.Y H:i'], 
  							'label' => 'Letzt.Änd.Sifu', 
  							'contentOptions' =>[
  								'class' => Yii::$app->user->identity->isAdmin ? 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1' : 'hidden',
  								'style' => 'width:20%;font-size:0.8em;',
  							],
  							'filterInputOptions' => [
  								'class' => Yii::$app->user->identity->isAdmin ? 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1' : 'hidden',
  								'style' => 'width:8em;font-size:0.8em;',
  							],								
  							'headerOptions' => [
  								'class' => Yii::$app->user->identity->isAdmin ? 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1' : 'hidden',
  								'style' => 'width:20%;font-size:0.8em;',
  							],								
  						]
               : [];
            }  


    echo GridView::widget([
						'dataProvider'=>$dataProvider,
						'filterModel'=>$searchModel,
						'summary' => $summary,
            'id' => 'dgrid-22',
						'options' => ['id' => 'dgrid-2',], // a unique identifier is important
						'panel' => [
				        'heading' => '<b>Mitgliederliste</b>',
                'headingOptions' => [
                    'class' => 'card-header text-white my-card',
                ],
//							 	'before'=>'{dynagridFilter}{dynagridSort}{dynagrid}',
//                'after' => '{pager}',     
							 	'before'=>'',
                'id' => 'pgrid-2',
//								 'class' => 'col-xs-12',
//								 'theme'=>'panel-condensed',     
						],
//						'panelAfterTemplate' => 'aaa{pager}',
//						'panelFooterTemplate' => '{pager}{toolbar}',
            'formatter' => [
				        'class' => 'yii\i18n\Formatter',
				        'nullDisplay' => '',
				    ],
//        		'tableOptions'=>['class'=>'table table-striped table-condensed','condensed' => true,],
//        		'headerRowOptions' => ['class' => 'col-xs-12', 'style' => 'font-size:1em;'],
//        		'rowOptions' => ['class' => 'col-xs-12', 'style' => 'min-width: 400px;'],
//        		'filterRowOptions' => ['class' => 'col-xs-12', 'style' => 'font-size:1em;'],
        		'responsive' => true,
						'responsiveWrap' => false,
//            'pager' => $pager,
						'toolbar' => false, /*$toolbar, */
            'hover'=>true,
            'columns' => [
  						['format' => 'raw',
                'attribute' => 'NameLink',
                'width' => '30%',
  							'label' => 'Name',
  							'contentOptions' =>['style' => 'font-size:0.8em;'],
  							'filterInputOptions' => ['style' => 'font-size:0.8em;',],
  							'headerOptions' => ['style' => 'font-size:0.8em;'],															
              ],
              ['attribute' => 'Vertrag',
                'width' => '30%',
  							'contentOptions' =>['style' => 'font-size:0.8em;'],
  							'filterInputOptions' => [ 'style' => 'font-size:0.8em;',],								
  							'headerOptions' => ['style' => 'font-size:0.8em;', ],								
  						],
             ['attribute' => 'LetzteAenderung', 
                'width' => '20%',
  							'format' => ['date', 'php:d.m.Y H:i'], 
  							'contentOptions' =>['style' => 'font-size:0.8em;'],
  							'filterInputOptions' => ['style' => 'width:8em;font-size:0.8em;',],								
  							'headerOptions' => ['style' => 'font-size:0.8em;',],								
  						],
//             $laes, 
          ], // -- columns
    ]);
?>
            <!--</div> content -->

        
 <?php // echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
 ?>
</div>
</span>   <!-- visible-xs -->


  
