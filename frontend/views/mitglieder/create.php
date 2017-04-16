<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
<<<<<<< HEAD
use yii\helpers\Url;
use yii\bootstrap\Modal;
/*use yii\grid\GridView; */
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use kartik\widgets\ActiveForm;
//use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\money\MaskMoney;

//use frontend\models\PruefungslisteForm;
use frontend\models\Disziplinen;
use frontend\models\Funktion;
use frontend\models\Schulen;
?>

			<?php /*Modal::begin([ 'id' => 'mg-cr-mod',
				'header' => '<center><h5>Mitglied anlegen</h5></center>',
				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-success', 
													'title'=>'Mitglied anlegen'],
				'size'=>'modal-sm',
				'clientOptions' => [ 'style' => 'adjust:center;',
											'backdrop' => true,
											'keyboard' => true,
				],					
				'footer' =>  '<div style="float: right;">'.Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default', 'style'=>"margin-right:5px;"]) . "  &nbsp;" . 
						Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary']).'</div>',
//				'footer'=>Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary']) 									
		]);
*/		?>
	<div class="modal-content container-fluid">
	
			<?php $form = ActiveForm::begin([ 'method' => 'post',
																			  'action' => Url::to(['/mitglieder/create']),
																			  'enableClientValidation' => true,
																				'enableAjaxValidation' => false, 
																				'fieldConfig'=>['showLabels'=>true],
																				'type' => ActiveForm::TYPE_VERTICAL,
																				'formConfig' => [//'labelSpan' => 3, 
																													'deviceSize' => ActiveForm::SIZE_SMALL,
																													'showErrors' => true,
																				],
//																				'options'=>['style'=>'width:20em;margin:0px;']												
																			]); ?>
				<?= $form->field($mcf, 'Vorname',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;']
																			 ])//->textInput(['style'=>'width:10em;font-size:0.85em;height:2em']) width:18.75em;
																			 ;
				?>
				<?= $form->field($mcf, 'Name',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;']
																			 ])
									 ;
				?>
				<?= $form->field($mcf, 'Geschlecht',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'width:20em;font-size:0.85em;']
																			 ])->dropdownList(array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich']),
																														['style'=>'']); 
				?>
			
				<?php /* echo $form->field($mcf, 'BeitrittDatum')->widget(DatePicker::classname(),   width:16em;
																								[ 'value' => date('d.m.Y'), 
																								'options'=>['placeholder'=>'Graduierungsdatum'], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																									'todayHighlight' => true, 'todayBtn' => true,]
																								]); */?>

        <?= $form->field($mcf, 'Schulort',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;']
																			 ])->dropdownList(array_merge(["" => ""], ArrayHelper::map( Schulen::find()->all()/*->distinct()->orderBy('SchulId')->all()*/, 
									'Schulname', 'Schulname' )),['style'=>'']);
				?>

        <?= $form->field($mcf, 'Funktion',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;']
																			 ])->dropdownList(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
									'inhalt', 'inhalt' )),['style'=>'']);
				?>
				<?= $form->field($mcf, 'MitgliederId',['labelOptions'=>['style'=>'font-size:0em;height:0em;padding-top:0em;'],
																			 'inputOptions' => ['style'=>'width:0em;font-size:0em;height:0em;'],
																			 'options' => ['style'=>'width:0em;font-size:0em;height:0em;'],
																			 ])->hiddenInput(['style'=>'width:0em;height:0em;padding:0em;'])
//																			 ->label('',['style'=>'width:0em;height:0em;padding:0em;']);
//																			 ->label('none');
				?>
<div style="float: right;margin-bottom:8px;"> <?= Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-sm btn-default',
		        ]) . "  &nbsp;" .  Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default', 'style'=>"margin-right:5px;"]) . "  &nbsp;" . 
						Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary']); ?></div>
		<?php $form = ActiveForm::end(); ?>
		</div>
		<?php //Modal::end();
		
		// class="col-xs-8 col-xs-offset-1 col-sm-8 col-sm-offset-1"                      class="col-md-offset-4 
		//col-xs-11 col-sm-11 col-md-11 col-lg-11 
		//    col-md-offset-2"  		   				style="text-align:right;"


		?>
		
		        <?php /*echo Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-sm btn-primary',
		        ])*/ ?>
		
=======
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use kartik\tabs\TabsX;
     


/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$this->title = Yii::t('app', 'Neues {modelClass} erstellen', [
    'modelClass' => 'Mitglied',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieder'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
			
<div class="mitglieder-view">
  <div class="row">
    <div id="content" class="col-sm-8">
			    <?php $form = ActiveForm::begin([
							'type' => ActiveForm::TYPE_HORIZONTAL,							
							'id' => 'create-form',
							'enableAjaxValidation' => false,
							'enableClientValidation' => true,
 							'formConfig' => ['labelSpan' => 4, 'spanSize' => ActiveForm::SIZE_SMALL, 'showErrors' => true],
							'fieldConfig' => [
								'autoPlaceholder'=>false
							]
							]); ?>      
			<div class="row">
		 		<div class="col-sm-4">
			        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					        <?= Html::a(Yii::t('app', 'Back'), Yii::$app->request->getReferrer(), [
					            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-primary',
					        ]) ?>
				</div>
			</div>
      <div class="row">
		 		<div class="col-sm-4">
		        <?= Html::a(Yii::t('app', 'Back'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-primary',
		        ]) ?>
		        <?= Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        ]) ?>				</div>
			</div>
						<?php     
    $items = [
		    [
				    'label'=>'<i class="glyphicon glyphicon-user"></i> Person',
				    'content'=>$this->render('_form_allgemein', array(
				                                'form' => $form, 
				                                'model'=>$model,
				                        ) ),
				//    'active'=>true,
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=1'])]
		    ],
		    [
				    'label'=>'<i class="glyphicon glyphicon-tower"></i> Schule',
				    'content'=>$this->render('_view_schule', array(
				                                'model'=>$model, 
				                        ) ),
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
		    ],
		    [
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Vertrag',
				    'content'=>$this->render('_form_vertrag', array(
				                                'form' => $form, 
				                                'model'=>$model, 'contracts' => $contracts
				                        ) ),
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
		    ],
				[
				    'label'=>'<i class="glyphicon glyphicon-euro"></i> Zahlung',
						'content'=>$this->render('_view_zahlung', array(
		                                'model'=>$model, 
		                        ) ),
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Graduierung',
						'content'=>$this->render('_form_grade', array(
				                                'form' => $form, 
		                                'model'=>$model, 'grade' => $grade, 
		                        ) ),
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-question-sign"></i> Interessent',
						'content'=>$this->render('_view_interessent', array(
		                                'model'=>$model,  
		                        ) ),
				],
    ];
?> 
			<?php    // Ajax Tabs Left
			    echo TabsX::widget([
			    'items'=>$items,
			    'position'=>TabsX::POS_ABOVE,
 					'bordered'=>true,
			    'encodeLabels'=>false
			    ]);
			?>
    </div><!-- content -->
			    <?php ActiveForm::end(); ?>

  </div>

</div>
>>>>>>> refs/remotes/github/master
