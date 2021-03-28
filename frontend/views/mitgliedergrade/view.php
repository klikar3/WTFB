<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedergrade */

$this->title = $model->mgID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedergrades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div id="content" class="col-sm-10">
		<div class="mitgliedergrade-view">

    <h1><?php /*echo Html::encode($this->title)*/ ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Zurück'), ['mitglieder/view', 'id' => $model->MitgliedId],['class'=>'btn btn-primary',
		        ]) ?>
    </p>

    <?= DetailView::widget([
    		'id' => 'dv_vmg',
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}{delete}',
				'panel'=>[
					'heading'=>'Mitglied: ' . $model->mitglied->Name . ', ' . $model->mitglied->Vorname,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
            [ 'attribute' => 'mgID',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_TEXT,
            	'displayOnly' => true,
            ],
/*           	[ 'attribute' => 'MitgliedId',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_TEXT,
            	'displayOnly' => false,
            ], */
            [ 'attribute' => 'GradId',
            	'value' => $model->grad->gKurz,
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["0" => ""], ArrayHelper::map( Grade::find()->all(), 'gradId', 'GradName', 'DispName' )),
							 ]             
            ],
//            'GradId',
            [ 'attribute' => 'Datum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d'
							]
            ],
//            'Datum',
//            'PrueferId',
            [ 'attribute' => 'PrueferId',
            	'value' => $model->pruefer->pName,
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["0" => ""], ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' )),
							 ]             
            ],
        ],
    ]);
		 ?>
		 </div>
	</div>
</div>
