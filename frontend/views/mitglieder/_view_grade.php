<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
//use kartik\widgets\DatePicker;

use frontend\models\Mitgliedergrade;
use frontend\models\MitgliedergradePrint;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-info"><div class="panel-heading">
							<?php
								$mg = new MitgliedergradePrint();
								$datum = date('Y-m-d');
        				$mg->Datum = $datum;
                $mg->MitgliedId = $model->MitgliederId;
                $mg->GradId = '';
                
              ?>
    						<?php $form = ActiveForm::begin([ 'id' => 'mg-cr-vg',
//    																							'enableClientValidation' => true,
																									'action' => ['mitgliedergrade/createfast',
																															'mId' => $mg->MitgliedId,
																															'grad' => ''],
    																							'fieldConfig'=>['showLabels'=>true],
																									'type' => ActiveForm::TYPE_HORIZONTAL,							
																								]); ?>
								 <?= 'Mitglied: ' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
								<?php Modal::begin([ 
									'header' => '<h2>Neue Graduierung zuweisen an<br>'.$model->Name.', '.$model->Vorname.'</h2>',
									'toggleButton' => ['label' => 'Graduierung zuweisen', 'class' => 'btn btn-sm btn-primary'],
	 								'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
														Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
							]);
							?>
							<div class="row" style="margin-bottom: 8px">
								<div class="col-sm-10">
							<?=  $form->field($mg, 'MitgliedId')->textInput(['disabled' => true]); ?>
								</div>
								<div class="col-sm-10">
									<?= $form->field($mg, 'Datum')->widget(DateControl::classname(),
									[ //'value' => date('d.m.Y'), 
										'type'=>DateControl::FORMAT_DATE,
										'ajaxConversion'=>true,
			 							'displayFormat' => 'php:d.m.Y',
			 							'saveFormat' => 'php:Y-m-d',
										'options'=>[
//											'placeholder'=>'Graduierungsdatum', 
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
										]	
									]); ?>
								</div>
								<div class="col-sm-10">
	    <?= $form->field($mg, 'PrueferId')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
[ 'prompt' => 'Pruefer' ]
)->label('Prüfer') ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($mg, 'GradId')->dropdownList(ArrayHelper::map( Grade::find()->all(), 'gradId', 'GradName', 'DispName' ),
[ 'prompt' => 'Grad' ]
)->label('Grad') ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($mg, 'print')->checkBox(
[ 'prompt' => 'Print' ]
) ?>
								</div>
							</div>
							<?php Modal::end();?>
							<?php $form = ActiveForm::end(); ?>
						</div>
			</div>		
	</div>
</div>

	<?php /* echo GridView::widget([
	        'dataProvider' => $grade,
//	        'filterModel' => $searchModel,
	        'columns' => [
//	            ['class' => 'yii\grid\SerialColumn'],
//							'MitgliedId', 
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz' ],
							[ 'attribute' => 'Disziplin', 'value' => 'disziplinen.DispKurz' ],
							[ 'attribute' => 'Datum', 'value' => 'Datum', 'format' => ['date', 'php:d.m.Y'] ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName' ],
            	[ 'class' => 'yii\grid\ActionColumn',
            						'template' => '{view} &nbsp;&nbsp; {delete} &nbsp;&nbsp; {print}',
												'controller' => 'mitgliedergrade',
												'buttons' => [ 
													'print' => function ($url, $model) {
        										return Html::a('<span class="glyphicon glyphicon-print"></span>', Url::toRoute(['mitgliedergrade/print', 'id' => $model->mgID] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Urkunde drucken'),
												        ]);
												    }
												],
//												'width' => '30px',
							],
				],
	    ]);*/ ?>


 	<?= GridView::widget([
	        'dataProvider' => $grade,
	        'columns' => [
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index) { 
                        return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $id) {
								$cont = Mitgliedergrade::findOne($id);
                return Yii::$app->controller->renderPartial('_grad-detail', ['model'=>$cont]);
            		},
							],
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz' ],
							[ 'attribute' => 'Disziplin', 'value' => 'disziplinen.DispKurz' ],
							[ 'attribute' => 'Datum', 'value' => 'Datum', 'format' => ['date', 'php:d.m.Y'] ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName' ],
            	[ 'class' => 'yii\grid\ActionColumn',
            						'template' => '{view} &nbsp;&nbsp; {delete} &nbsp;&nbsp; {print}',
												'controller' => 'mitgliedergrade',
												'buttons' => [ 
													'print' => function ($url, $model) {
        										return Html::a('<span class="glyphicon glyphicon-print"></span>', Url::toRoute(['mitgliedergrade/print', 'id' => $model->mgID] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Urkunde drucken'),
												        ]);
												    }
												],
//												'width' => '30px',
							],
				],
	    ]); ?>


