<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
//use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;
use kartik\popover\PopoverX;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\InteressentVorgaben;
use frontend\models\Intensiv;
use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
<div class="col-md-6">
       <?= DetailView::widget([
    		'id' => 'dv_vbi',
        'model' => $intensiv,
				'condensed'=>true,
//				'container' => ['style' => 'font-size:0.9em'],
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=> 'Kontakt', //$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,					
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $intensiv->mitgliederId, 'tabnum' => 1, 'iId' => $intensiv->id/*, 'style' => 'font-size:1em',*/],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
        'valueColOptions'=>['style'=>'width:30%'], 
        'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
        'attributes' => [
            [ 'attribute' => 'KontaktAm',
            	'format' => ['date', 'php:d.m.Y'],
              'valueColOptions'=>['style'=>'width:30%;'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
  //        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
  								'type' => DateControl::FORMAT_DATE,
  						    'displayFormat' => 'php:d.m.Y',
  						    'saveFormat' => 'php:Y-m-d',
  						    'options' => [
  										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
  								],
  						],
            ],
            [ 'attribute' => 'KontaktArt',
            	'format' => 'raw',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
  								'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "KontaktArtWti"])->orderBy('sort')->all(), 'wert', 'wert' )),
  						 ],             
            ],
            [ 'attribute' => 'Woher',
            	'format' => 'raw',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
  								'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "WoherWti"])->orderBy('sort')->all(), 'wert', 'wert' )),
  						 ],             
            ],   
            [ 'attribute' => 'kontaktNachricht',
            	'label' => 'Kontakt-Nachricht',
              'format' => 'raw',
              'type' => DetailView::INPUT_TEXTAREA,
            ],
            [ 'attribute' => 'telefonatAm',
            	'format' => ['date', 'php:d.m.Y'],
              'valueColOptions'=>['style'=>'width:30%;'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
  //        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
  								'type' => DateControl::FORMAT_DATE,
  						    'displayFormat' => 'php:d.m.Y',
  						    'saveFormat' => 'php:Y-m-d',
  						    'options' => [
  										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
  								],
  						],
            ],
           ['attribute'=>'alter',
            'label' => 'Alter',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'graduierung',
//            'label' => 'Graduierung',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'wieLangeWt',
//            'label' => 'Wie lange WT',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'ausbQuali',
//            'label' => 'Ausbilder-Qualifizierung',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'unterrichtet',
            'label' => 'Unterrichtet',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'eigeneSchule',
            'label' => 'Eigene Schule',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'eigeneLehrer',
            'label' => 'Eigene Lehrer',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'organisation',
            'label' => 'Organisation',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'erfAndereStile',
//            'label' => 'Erfahrung in anderen Stilen',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'ziel',
            'label' => 'Ziel',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'wievielZeit',
            'label' => 'Wieviel Zeit',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'trainingsPartner',
            'label' => 'Trainingspartner',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
          [ 'attribute' => 'erstTermin',
          	'format' => ['date', 'php:d.m.Y'],
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => true,
   					'label' => 'Ersttermin am',
         	  'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
                'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
  							    ],
						],
          ],
            [ 'attribute' => 'einstufung',
            	'format' => 'raw',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
  								'data' => ["" => "", "hoch" => "hoch", "mittel" => "mittel", "niedrig" => "niedrig"],
  						 ],             
            ],   
           [
                'group'=>true,
                'label'=>false, //'Teil 2: Aussetzen',
                'rowOptions'=>['class'=>'table-info'],
//                'groupOptions'=>['style'=>'background: lightblue;'],
                'groupOptions'=>['style'=>'background: #d9edf7;height:2em;'],
            ],
            [ 'attribute' => 'bemerkung',
            	'label' => 'Bemerkung',
              'format' => 'raw',
              'type' => DetailView::INPUT_TEXTAREA,
            ],

        ],
    ]) ?>
    <?php  /*
          echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model->MitgliederId]);
          echo Html::hiddenInput('MailingListId', 1);
          echo Html::hiddenInput('FormId', 2);
          echo Html::hiddenInput('FormEncoding', 'utf-8');
//          echo Html::hiddenInput('HTMLForm', 'subform');
          echo Html::hiddenInput('u_EMail', $model->Email,['id' => "u_EMail"]);
          echo Html::hiddenInput('u_Gender', ($model->Geschlecht == 'männlich') ? 'm' : 'w',['id' => "u_Gender_f"]);
          echo Html::hiddenInput('u_FirstName', $model->Vorname,['id' => "u_FirstName"]);
          echo Html::hiddenInput('u_LastName', $model->Name,['id' => "u_LastName"]);
          echo Html::hiddenInput('u_Salutation', (strpos($model->Anrede, 'Herr') !== false ) ? 'Hallo Herr' : ((strpos($model->Anrede, 'Frau') !== false ) ? 'Hallo Frau' : 'Hallo Familie' ),['id' => "u_Salutation"]);
          echo Html::hiddenInput('Action', 'subscribe');
          echo Html::submitButton('In NL-Interessent eintragen', ['class' => 'btn btn-sm btn-default']);
          echo Html::endForm();  */
    ?>

</div>
