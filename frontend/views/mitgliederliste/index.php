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

<div class="mitglieder-index">

    <h1><?php /* echo Html::encode($this->title) */ ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
          <div class="row">
            <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


    <?php echo DynaGrid::widget([
//				'storage'=>DynaGrid::TYPE_COOKIE,
				'storage'=>DynaGrid::TYPE_DB,
				'theme'=>'simple-condensed',
				'gridOptions'=>[
						'dataProvider'=>$dataProvider,
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
							'contentOptions' =>['class' => 'table_class'/*,'style'=>'font-size:0.9em;'*/],
						],
// 						['class'=>'kartik\grid\CheckboxColumn', //'order'=>DynaGrid::ORDER_FIX_RIGHT
//						],             
						['format' => 'raw',
             'attribute' => 'NameLink',
							'label' => 'Name',
							'contentOptions' =>['class' => 'table_class'/*,'style'=>'font-size:0.9em;'*/],
            ],
//            'MitgliederId',
//            'MitgliedsNr',
//						'Name',
//            'Vorname',
            ['attribute' => 'Schulname',
							'contentOptions' =>['class' => 'table_class'],
						],
            ['attribute' => 'LeiterName',
							'contentOptions' =>['class' => 'table_class'],
						],
            ['attribute' => 'DispName', 'width' => '5em',
													'contentOptions' =>['class' => 'table_class'],
						],
						['attribute' => 'Funktion', 'width' => '5em',							
							'contentOptions' =>['class' => 'table_class'],
						], 
            ['attribute' => 'Vertrag',
							'contentOptions' =>['class' => 'table_class'],
						],
            ['attribute' => 'Grad', 'width' => '7em',
							'contentOptions' =>['class' => 'table_class'],
						 ],
            ['attribute' => 'LetzteAenderung', 'width' => '9em', 'format' => ['date', 'php:d.m.Y H:i'], 
							'contentOptions' =>['class' => 'table_class'/*,'style'=>'font-size:0.8em;'*/],                
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
							
//							'contentOptions' =>['class' => 'table_class','style'=>'font-size:12px;'],
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
							'contentOptions' =>['class' => 'table_class','style'=>'font-size:12px;'],
							'filterType' => 'checkbox',
							'label' => 'P. zum',
//							'mergeHeader' => true,
//							'filterWidgetOptions' => ['pluginOptions'=>['threeState'=>true]]
						],
        ], // -- columns
//        'export' => true,    
		]); ?>

            </div><!-- content -->

         </div>
 <?php // echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
 ?>
</div>
<?php // ul.yiiPager .first, ul.yiiPager .last {display: inline;}   ?>


  