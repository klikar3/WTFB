<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/*use yii\grid\GridView; */
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\checkbox\CheckboxX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\money\MaskMoney;

use frontend\models\Mitglieder;
use frontend\models\PruefungslisteForm;
use frontend\models\Disziplinen;
use frontend\models\Texte;
 


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliederliste');
$this->params['breadcrumbs'][] = $this->title;

$plf = new PruefungslisteForm();
$datum = date('d.m.Y');
$plf->datum = $datum;
//$plf->pgeb = 40.00;
$plf->disp = 'Wing Tzun';
$content_plf = $this->render('pliste_preform',['plf' => $plf]);

$mcf = new Mitglieder();
//$mcf->BeitrittDatum = $datum;
$mcf->Geschlecht = 'männlich';
$mcf->Funktion = 'Schüler/in';
//$mcf->MitgliederId = Mitglieder::find()->max('MitgliederId') + 1;
$mcf->MitgliederId = Yii::$app->db->createCommand('SELECT MAX(MitgliederId) FROM mitglieder')->queryScalar() + 1;
$mcf->MitgliedsNr = 0;

$content_mcf = $this->render('mgcreate_preform',['mcf' => $mcf]);
//$dataProvider->pagination->LinkPager->firstPageLabel = 'first';

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

<div class="mitglieder-index hidden-xs">

    <h1><?php /* echo Html::encode($this->title) */ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
          <div class="row">
            <div id="content" class="col-12">


    <?php echo DynaGrid::widget([
//				'storage'=>DynaGrid::TYPE_COOKIE,
				'storage'=>DynaGrid::TYPE_DB,
				'theme'=>'simple-condensed',
				'gridOptions'=>[
						'dataProvider'=>$dataProvider,
						'responsiveWrap' => false,
						'filterModel'=>$searchModel,
//						'emptyCell'=>'-',
						'panel' => [
				        'heading' => '<b>Mitgliederliste</b>',
							 	'before'=>'{dynagridFilter}{dynagridSort}{dynagrid}'     
						],
        		'tableOptions'=>['class'=>'table table-striped table-condensed'],
        		'responsive' => true,
						'toolbar' => [
										 	['content'=>$content_mcf  
											],
										 	['content'=>
													Html::a('<i class="fa glyphicon glyphicon-minus"></i>', ['/mitgliederliste/resetpliste'], [
													'class'=>'btn btn-default',
													'target'=>'_blank',
													'data-confirm' => 'Wirklich die Prüfungsmarkierungen zurücksetzen?',
													'data-toggle'=>'tooltip',
													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													])  
											],
										 	['content'=>$content_plf  
											],
											'{export}',
											'{toggleData}',
									],
				],
				'options'=>['id'=>'dynagrid-1'], // a unique identifier is important
        'columns' => [
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{email}{standard}',
							'mergeHeader' => false,
//							'header' => 'Aktion',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'email' => function ($url, $model) {
//									return Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
//													 				'txtid' => 5 ] ), [
									return Html::mailto('<span class="glyphicon glyphicon-envelope"></span>', Url::to($model->Email) .
									"?subject=WingTzun&body=".$model->mitglieder->Anrede." ".$model->Vorname.", %0D%0A %0D%0AViele Grüße %0D%0ASifu Niko und Team",[
//          					'target'=>'_blank',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
							        ]);
							    },
							],
							'width' => '3em',
							'contentOptions' =>['class' => 'hidden-xs table_class'],
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
							],															
						],
// 						['class'=>'kartik\grid\CheckboxColumn', //'order'=>DynaGrid::ORDER_FIX_RIGHT
//						],             
						['format' => 'raw',
              'attribute' => 'NameLink',
              'width' => '10em',
							'label' => 'Name',
							'contentOptions' =>['class' => 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:10em;',
							],
            ],
//            'MitgliederId',
//            'MitgliedsNr',
//						'Name',
//            'Vorname',
            ['attribute' => 'Schulname',
//            	'visible' => false,
//							'format' => 'raw',
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],															
						],
            ['attribute' => 'LeiterName',
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['attribute' => 'DispName', //'width' => '5em',
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:3em;',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
						['attribute' => 'Funktion', 
							'width' => '5em',							
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						], 
            ['attribute' => 'Vertrag',
            	'width' => '7em',
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:7em;',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['attribute' => 'Grad', 'width' => '5em',
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						 ],
            ['attribute' => 'LetzteAenderung', 'width' => '5em', 
							'format' => ['date', 'php:d.m.Y H:i'], 
							'contentOptions' =>['class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'],
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
								'style' => 'width:5em;',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1',
							],								
						],
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{markieren} &nbsp;&nbsp; {graduieren}',
							'controller' => 'mitglieder',
							'mergeHeader' => false,
//							'label' => 'Aktion',
							'buttons' => [ 
								'markieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::toRoute(['mitglieder/mark', 'id' => $model->MitgliederId] ), [
//          					'target'=>'_blank',
										'title' => Yii::t('app', 'Für Prüfung vormerken'),
							        ]);
							    },
								'graduieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-plus"></span>', Url::toRoute(['mitgliedergrade/createfast', 'mId' => $model->MitgliederId, 'grad' => $model->PruefungZum ]), [
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
//							'filterInputOptions' => [
//								'class' => 'hidden-xs table_class',
//							]								
						],
//            'PruefungZum',
						[
						    'attribute' => 'PruefungZum',
						    'format' => 'raw',
						    'value' => function ($model, $index, $widget) {
						        return Html::checkbox('PruefungZum[]', $model->PruefungZum, ['value' => $index, 'disabled' => true]);
						    },
							'width' => '4em',
							'contentOptions' =>['class' => 'hidden-xs table_class','style'=>'font-size:12px;'],
							'filterType' => 'checkbox',
							'label' => 'P. zum',
//							'mergeHeader' => true,
//							'filterWidgetOptions' => ['pluginOptions'=>['threeState'=>true]]
							'filterInputOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
							],								
							'headerOptions' => [
								'class' => 'hidden-xs col-1 col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-1',
							],																
						],
        ], // -- columns
//        'export' => true,    
		]); ?>

            </div><!-- content -->

         </div>
 <?php // echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
 ?>
</div>


<div class="col-xs-12 visible-xs">

    <h1><?php /* echo Html::encode($this->title) */ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php echo DynaGrid::widget([
//				'storage'=>DynaGrid::TYPE_COOKIE,
				'storage'=>DynaGrid::TYPE_DB,
				'theme'=>'simple-condensed',
				'gridOptions'=>[
						'dataProvider'=>$dataProvider,
						'filterModel'=>$searchModel,
						'options'=>['id'=>'grid-1',], // a unique identifier is important
//						'containerOptions' => ['style' => 'min-width: 300px;'],
//						'emptyCell'=>'-',
						'panel' => [
				        'heading' => '<b>Mitgliederliste</b>',
							 	'before'=>'',
//								 'class' => 'col-12',
//								 'theme'=>'panel-condensed',     
						],
        		'tableOptions'=>['class'=>'table table-striped table-condensed','condensed' => true,],
//        		'headerRowOptions' => ['class' => 'col-xs-12', 'style' => 'font-size:1em;'],
//        		'rowOptions' => ['class' => 'col-xs-12', 'style' => 'min-width: 400px;'],
//        		'filterRowOptions' => ['class' => 'col-xs-12', 'style' => 'font-size:1em;'],
        		'responsive' => true,
						'responsiveWrap' => false,
						'toolbar' => false/*[
										 	['content'=>$content_mcf  
											],
										 	['content'=> 
													Html::a('<i class="fa glyphicon glyphicon-minus"></i>', ['/mitgliederliste/resetpliste'], [
													'class'=>'btn btn-default',
													'target'=>'_blank',
													'data-confirm' => 'Wirklich die Prüfungsmarkierungen zurücksetzen?',
													'data-toggle'=>'tooltip',
													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													])  
											],
										 	['content'=>$content_plf  
											],
											'{export}',
											'{toggleData}',
									]*/,
				],				
				'options'=>['id'=>'dynagrid-1'], // a unique identifier is important
        'columns' => [
/*            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{email}',
							'mergeHeader' => true,
							'controller' => 'mitglieder',
							'options' => [
								'id' => 'test_id',
							],
							'buttons' => [ 
								'email' => function ($url, $model) {
									return Html::mailto('<span class="glyphicon glyphicon-envelope"></span>', Url::to($model->Email) .
									"?subject=WingTzun&body=".$model->mitglieder->Anrede." ".$model->Vorname.", %0D%0A %0D%0AViele Grüße %0D%0ASifu Niko und Team",[
//          					'target'=>'_blank',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
							        ]);
							    },
							],
							'width' => '3em',
							'contentOptions' =>['class' => 'col-xs-1'],
							'headerOptions' => [
								'class' => 'col-xs-1'
							],															
						],
*/						['format' => 'raw',
              'attribute' => 'NameLink',
              'width' => '40%',
							'label' => 'Name',
							'contentOptions' =>['style' => 'font-size:0.8em;'],
							'filterInputOptions' => ['style' => 'font-size:0.8em;',],
							'headerOptions' => ['style' => 'font-size:0.8em;'],															
            ],
/*            ['attribute' => 'Schulname',
							'contentOptions' =>['class' => 'col-xs-2', 'style' => 'font-size:1em;'],
							'filterInputOptions' => [
								'class' => 'col-xs-2', 'style' => 'font-size:1em;'
//								'style' => 'width:5em;',
							],
							'headerOptions' => [
								'class' => 'col-xs-2', 'style' => 'font-size:1em;',
							],															
						],
*/ //           ['attribute' => 'LeiterName',
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
              'width' => '30%',
							'format' => ['date', 'php:d.m.Y H:i'], 
							'contentOptions' =>['style' => 'font-size:0.8em;'],
							'filterInputOptions' => ['style' => 'font-size:0.8em;',],								
							'headerOptions' => ['style' => 'font-size:0.8em;',],								
						],
/*            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{markieren} &nbsp;&nbsp; {graduieren}',
							'controller' => 'mitglieder',
							'mergeHeader' => false,
							'buttons' => [ 
								'markieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::toRoute(['mitglieder/mark', 'id' => $model->MitgliederId] ), [
//          					'target'=>'_blank',
										'title' => Yii::t('app', 'Für Prüfung vormerken'),
							        ]);
							    },
								'graduieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-plus"></span>', Url::toRoute(['mitgliedergrade/createfast', 'mId' => $model->MitgliederId, 'grad' => $model->PruefungZum ]), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Graduierung'),
							        ]);
							    }
							    
							],							
							'options' => [
								'id' => 'test_id2',
							],
							'contentOptions' =>['class' => 'col-1','style' => 'font-size:12px;'],
							'headerOptions' => [
								'class' => 'col-1',
							],															
							'width' => '3em',
//							'filterInputOptions' => [
//								'class' => 'col1',
//							]								
						],
*/        ], // -- columns
//        'export' => true,    
		]); ?>


        
 <?php // echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
 ?>
</div>
<?php // ul.yiiPager .first, ul.yiiPager .last {display: inline;}   ?>


  