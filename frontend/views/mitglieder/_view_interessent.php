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
					'heading'=>'Mitglied # ' . $model->MitgliedsNr,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
            // 'Bemerkungen',
            // 'Betreff',
            // 'Text',
            // 'KontaktAm',
            [ 'attribute' => 'KontaktAm',
            	'format' => ['date', 'php:Y-m-d'],
            	'type' => DetailView::INPUT_WIDGET,
            	'widgetOptions' => [
//            			'value' => 'KontaktAm',
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'd.m.Y',
							    'saveFormat' => 'Y-m-d',
							]
            ],
//             'KontaktArt',
            [ 'attribute' => 'KontaktArt',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "KontaktArt"])->orderBy('sort')->all(), 'id', 'wert' )),
							 ]             
            ],
//             'Woher',
            [ 'attribute' => 'Woher',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "Woher"])->orderBy('sort')->all(), 'id', 'wert' )),
							 ]             
            ],
            // 'Bemerkung1',
             'EinladungIAzum',
//             'warZumIAda'
             ['attribute'=>'warZumIAda', 'type'=>DetailView::INPUT_CHECKBOX],
//             'zumIAnichtDa',
             'ProbetrainingAm',
             'PTwarDa',
//             'zumPTnichtDa',
             'VertragAbgeschlossen',
             'VertragMit',
             'Abschlussgespraech',
            // 'Bemerkung2',
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




