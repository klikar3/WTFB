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
 


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliederliste');
$this->params['breadcrumbs'][] = $this->title;

$plf = new PruefungslisteForm();
$datum = date('d.m.Y');
$plf->datum = $datum;
$plf->pgeb = 35.01;
$plf->disp = 'Wing Tzun';
$content_plf = $this->render('pliste_preform',['plf' => $plf]);

$mcf = new Mitglieder();
//$mcf->BeitrittDatum = $datum;
$mcf->Geschlecht = 'männlich';
$mcf->Funktion = 'Schüler/in';
$mcf->MitgliederId = Mitglieder::find()->max('MitgliederId') + 1;
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

<div class="mitglieder-index">

    <h1><?php /* echo Html::encode($this->title) */ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
          <div class="row">
            <div id="content" class="col-sm-12">


    <?php echo DynaGrid::widget([
//				'storage'=>DynaGrid::TYPE_COOKIE,
				'storage'=>DynaGrid::TYPE_DB,
				'theme'=>'panel-danger',
				'gridOptions'=>[
						'dataProvider'=>$dataProvider,
						'filterModel'=>$searchModel,
						'panel' => [
				        'heading' => '<b>Mitgliederliste</b>',
							 	'before'=>'{dynagridFilter}{dynagridSort}{dynagrid}' . Html::a(Yii::t('app', '<i class="fa glyphicon glyphicon-plus"></i>', [
						    						'modelClass' => 'Mitglieder',
														]), ['/mitglieder/create'], [ 'class' => 'btn btn-success',
													'title'=>'Neues Mitglied anlegen']) . $content_mcf 				    
						],
        		'tableOptions'=>['class'=>'table table-condensed'],
        		'responsive' => true,    
						'toolbar' => [
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
										 	['content'=>$content_mcf  
											],
											'{export}',
											'{toggleData}',
									],
				],
				'options'=>['id'=>'dynagrid-1'], // a unique identifier is important
        'columns' => [
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{email} &nbsp;&nbsp; {update}',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'email' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::toRoute(['mitglieder/email', 'id' => $model->MitgliederId] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
							        ]);
							    },
							],
							'width' => '60px',
						],
// 						['class'=>'kartik\grid\CheckboxColumn', //'order'=>DynaGrid::ORDER_FIX_RIGHT
//						],             
						['format' => 'raw',
             'attribute' => 'NameLink',
            ],
//            'MitgliederId',
//            'MitgliedsNr',
//						'Name',
//            'Vorname',
            'Schulname',
            'LeiterName',
            ['attribute' => 'DispName', 'width' => '100px'],
						'Funktion', 
            'Vertrag',
            ['attribute' => 'Grad', 'width' => '100px' ],
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{markieren} &nbsp;&nbsp; {graduieren}',
							'controller' => 'mitglieder',
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
							
							'width' => '60px',
						],
//            'PruefungZum',
						[
						    'attribute' => 'PruefungZum',
						    'format' => 'raw',
						    'value' => function ($model, $index, $widget) {
						        return Html::checkbox('PruefungZum[]', $model->PruefungZum, ['value' => $index, 'disabled' => true]);
						    },
							'width' => '60px',
							'filterType' => 'checkbox',
//							'filterWidgetOptions' => ['pluginOptions'=>['threeState'=>true]]
						],
        ], // -- columns
//        'export' => true,    
		]); ?>

    <?php /* echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-condensed'],
        'columns' => [
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{email} &nbsp;&nbsp; {update}',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'email' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::toRoute(['mitglieder/email', 'id' => $model->MitgliederId] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
							        ]);
							    },
							],
							'width' => '60px',
//							'dropdown' => true,     
						],
// 						['class'=>'kartik\grid\CheckboxColumn', //'order'=>DynaGrid::ORDER_FIX_RIGHT
//						],             
						['format' => 'raw',
             'attribute' => 'NameLink',
            ],
//            'MitgliederId',
//            'MitgliedsNr',
//						'Name',
//            'Vorname',
            'Schulname',
            'LeiterName',
            ['attribute' => 'DispName', 'width' => '100px'],
						'Funktion', 
            'Vertrag',
            ['attribute' => 'Grad', 'width' => '100px' ],
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{markieren} &nbsp;&nbsp; {graduieren}',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'markieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::toRoute(['mitglieder/mark', 'id' => $model->MitgliederId] ), [
//          					'target'=>'_blank',
										'title' => Yii::t('app', 'Für Prüfung vormerken'),
							        ]);
							    },
								'graduieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-plus"></span>', Url::toRoute(['mitgliedergrade/create', 'model' => $model] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Graduierung'),
							        ]);
							    }
							    
							],
							
							'width' => '60px',
//							'dropdown' => true,     
						],
//            'PruefungZum',
						[
						    'attribute' => 'PruefungZum',
						    'format' => 'raw',
						    'value' => function ($model, $index, $widget) {
						        return Html::checkbox('PruefungZum[]', $model->PruefungZum, ['value' => $index, 'disabled' => true]);
						    },
							'width' => '60px',
							'filterType' => 'checkbox',
							'filterWidgetOptions' => ['pluginOptions'=>['threeState'=>true]]

						],
        ], // -- columns
        'responsive' => true,    
//        'export' => true,    
				'toolbar' => [
            ['content'=>
								Html::a(Yii::t('app', '<i class="fa glyphicon glyphicon-plus"></i>', [
	    						'modelClass' => 'Mitglieder',
									]), ['/mitglieder/create'], [ 'class' => 'btn btn-success',
								'title'=>'Neues Mitglied anlegen']) 
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
					 	['content'=>$content  
						],
						'{export}',
						'{toggleData}',
				],
		    'panel' => [
		        'heading' => '<b>Mitgliederliste</b>',
		        'before' => '', //IMPORTANT
		    ],
		]); */?>
            </div><!-- content -->

         </div>

</div>
<?php // ul.yiiPager .first, ul.yiiPager .last {display: inline;}   ?>


  