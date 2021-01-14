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
        'fadeDelay' => 50,
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
            	'label' => Yii::t('app', 'Contact-Message'),
              'format' => 'raw',
              'type' => DetailView::INPUT_TEXTAREA,
            ],
            [ 'attribute' => 'telefonatAm',
            	'format' => ['date', 'php:d.m.Y H:i'],
              'valueColOptions'=>['style'=>'width:30%;'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => false,
  //        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
  								'type' => DateControl::FORMAT_DATETIME,
						    'displayFormat' => 'php:d.m.Y H:i',
						    'saveFormat' => 'php:Y-m-d H:i:s',
                'displayTimezone' => 'Europe/Berlin', 
                'saveTimezone' => 'UTC',
  						    'options' => [
  										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
  								],
  						],
            ],
           ['attribute'=>'alter',
            'label' => Yii::t('app', 'Age'),
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
            'label' => Yii::t('app', 'Unterrichtet'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'eigeneSchule',
            'label' => Yii::t('app', 'Has School'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'eigeneLehrer',
            'label' => Yii::t('app', 'Has Teachers'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'organisation',
            'label' => Yii::t('app', 'Organisation'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'erfAndereStile',
//            'label' => 'Erfahrung in anderen Stilen',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'ziel',
            'label' => Yii::t('app', 'Goal'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'wievielZeit',
            'label' => Yii::t('app', 'How much Time'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'trainingsPartner',
            'label' => Yii::t('app', 'Training partner'),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
          [ 'attribute' => 'erstTermin',
          	'format' => ['date', 'php:d.m.Y H:i'],
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => false,
   					'label' => Yii::t('app', 'First Appointment On'),
         	  'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATETIME,
						    'displayFormat' => 'php:d.m.Y H:i',
						    'saveFormat' => 'php:Y-m-d H:i:s',
                'displayTimezone' => 'Europe/Berlin',
                'saveTimezone' => 'Europe/Berlin',
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
            	'label' => Yii::t('app', 'Notice'),
              'format' => 'raw',
              'type' => DetailView::INPUT_TEXTAREA,
            ],

        ],
    ]) ?>
    <?php 
      if ((!empty($intensiv->mitglied->Disziplin))||($intensiv->mitglied->Schulort == 'WT-Intensiv')) {
        ($intensiv->mitglied->Schulort == 'WT-Intensiv') ? $disp = 1 :   
        $disp = Disziplinen::find()->andWhere(['DispName' => $intensiv->mitglied->Disziplin])->select('DispId')->one();        
        $schul = Schulen::find()->andWhere(['Schulname' => $intensiv->mitglied->Schulort, 'Disziplin' => $disp])->one();
//        \Yii::warning($intensiv->mitglied->Schulort);
//        \Yii::warning($disp);
//        \Yii::warning($schul);
        if ((!empty($schul)) && ($schul->swmInteressentenListe != 0 ) && ($schul->swmInteressentenForm != 0 )) {
            echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$intensiv->mitglied->MitgliederId]);
            echo Html::hiddenInput('MailingListId', $schul->swmInteressentenListe);
            echo Html::hiddenInput('FormId', $schul->swmInteressentenForm);
            echo Html::hiddenInput('FormEncoding', 'utf-8');
  //          echo Html::hiddenInput('HTMLForm', 'subform');
            echo Html::hiddenInput('u_EMail', $intensiv->mitglied->Email,['id' => "u_EMail"]);
            echo Html::hiddenInput('u_Gender', ($intensiv->mitglied->Geschlecht == Yii::t('app', 'male')) ? 'm' : 'w',['id' => "u_Gender_f"]);
            echo Html::hiddenInput('u_FirstName', $intensiv->mitglied->Vorname,['id' => "u_FirstName"]);
            echo Html::hiddenInput('u_LastName', $intensiv->mitglied->Name,['id' => "u_LastName"]);
            echo Html::hiddenInput('u_Salutation', (strpos($intensiv->mitglied->Anrede, 'Herr') !== false ) ? 'Hallo Herr' : ((strpos($intensiv->mitglied->Anrede, 'Frau') !== false ) ? 'Hallo Frau' : 'Hallo Familie' ),['id' => "u_Salutation"]);
            echo Html::hiddenInput('Action', 'subscribe');
            echo Html::submitButton(Yii::t('app', 'Enter into Newsletter for Interested Persons'), ['class' => 'btn btn-sm btn-default']);
            echo Html::endForm(); 
        }    
      }
    ?>

</div>
