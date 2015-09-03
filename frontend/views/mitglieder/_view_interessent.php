<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\InteressentVorgaben;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
    <?= DetailView::widget([
    		'id' => 'dv_vi',
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'Mitglied: ' . $model->Name . ', ' . $model->Vorname,
					'type'=>DetailView::TYPE_INFO,
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 7, ],
				],
        'attributes' => [
            // 'Bemerkungen',
            // 'Betreff',
            // 'Text',
            // 'KontaktAm',
            [ 'attribute' => 'KontaktAm',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
//        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
            	'widgetOptions' => [
//            			'value' => 'KontaktAm',
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
//             'KontaktArt',
            [ 'attribute' => 'KontaktArt',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "KontaktArt"])->orderBy('sort')->all(), 'wert', 'wert' )),
							 ]             
            ],
//             'Woher',
            [ 'attribute' => 'Woher',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "Woher"])->orderBy('sort')->all(), 'wert', 'wert' )),
							 ]             
            ],
            [ 'attribute' => 'Schulort',
	            'format' => 'raw',
	            'type' => DetailView::INPUT_SELECT2,
	            'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
									'Schulname', 'Schulname' )),
							]
	          ],
	          [ 'attribute' => 'Disziplin',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->orderBy('sort')->all(), 'DispName', 'DispName' )),
							 ]             
            ],
            // 'Bemerkung1',
            [ 'attribute' => 'EinladungIAzum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
//        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
            	'widgetOptions' => [
//            			'value' => 'KontaktAm',
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
//             'warZumIAda'
            [ 'attribute'=>'WarZumIAda', 
						  'type'=>DetailView::INPUT_CHECKBOX_X,    
							'value' => $model->showTriState($model->WarZumIAda),
    					'autoLabel' => true,
    					'label' => 'War zum IA da',
							'widgetOptions' => [				
										'pluginOptions'=>[  
											'threeState' => false, 
										],
							],
						],
//							    'inline'=>true, 
//										    'iconChecked'=>'<i class="glyphicon glyphicon-minus"></i>',
//										    'iconUnchecked'=>'<i class="glyphicon glyphicon-minus"></i>',
//										    'iconNull'=>'<i class="glyphicon glyphicon-remove"></i>',
//												'threeState' => false, 
//             'zumIAnichtDa',
            [ 'attribute' => 'ProbetrainingAm',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
             ['attribute'=>'PTwarDa','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
							'value' => $model->showTriState($model->PTwarDa),
							'widgetOptions' => [				
										'pluginOptions'=>[  
											'threeState' => false, 
										],
							],
						 ],                         

//             'zumPTnichtDa',
             ['attribute'=>'VertragAbgeschlossen','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
							'value' => $model->showTriState($model->VertragAbgeschlossen),
							'widgetOptions' => [				
										'pluginOptions'=>[  
											'threeState' => false, 
										],
							],
						 ],
             ['attribute'=>'VertragMit','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
							'value' => $model->showTriState($model->VertragMit),
							'widgetOptions' => [				
										'pluginOptions'=>[  
											'threeState' => false, 
										],
							],
						 ],
            // 'Abschlussgespraech',
             'Bemerkung2',
             'GutscheinVon',
            // 'Name2Schule',
            // 'DM2Schule',
            // 'NeuerBeitrag',
            // 'Vereinbarung',
            // 'RechnungsNr',
            // 'VErgaenzungAb',
            // 'Land',
            // 'AussetzenDauer',
            // 'SFirm',
          // 'BListe',
        ],
    ]) ?>




