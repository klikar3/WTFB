<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

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
 
            <div id="content" class="col-sm-6">
    <p>
				<div class="row">
					<div class="col-sm-5">
						<div style="margin-top: 20px">
							<?php
								$mg = new MitgliedergradePrint();
								$datum = date('d.m.Y');
        				$mg->Datum = $datum;
                $mg->MitgliedId = $model->MitgliederId;
              ?>
    						<?php $form = ActiveForm::begin(['action' => ['mitgliedergrade/createfast'],
    																							'fieldConfig'=>['showLabels'=>true],
																									'type' => ActiveForm::TYPE_HORIZONTAL,							
																								]); ?>
								<?php Modal::begin([ 
									'header' => '<h2>Neue Graduierung zuweisen</h2>',
									'toggleButton' => ['label' => 'Graduierung zuweisen', 'class' => 'btn btn-primary'],
	 								'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
														Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
							]);
							?>
							<div class="row" style="margin-bottom: 8px">
								<div class="col-sm-10">
							<?=  $form->field($mg, 'MitgliedId')->textInput(['disabled' => true]); ?>
								</div>
								<div class="col-sm-10">
									<?= $form->field($mg, 'Datum')->widget(DatePicker::classname(),
									[ 'value' => date('d.m.Y'), 'options'=>['placeholder'=>'Graduierungsdatum'], 'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
'todayHighlight' => true, 'todayBtn' => true,
]]); ?>
								</div>
								<div class="col-sm-10">
	    <?= $form->field($mg, 'PrueferId')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
[ 'prompt' => 'Pruefer' ]
) ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($mg, 'GradId')->dropdownList(ArrayHelper::map( Grade::find()->all(), 'gradId', 'GradName', 'DispName' ),
[ 'prompt' => 'Grad' ]
) ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($mg, 'print')->checkBox(
[ 'prompt' => 'GPrint' ]
) ?>
								</div>
							</div>
							<?php Modal::end();?>
							<?php $form = ActiveForm::end(); ?>
						</div>
					</div>
				</div>		
	</p>
                <p>

	<?= GridView::widget([
	        'dataProvider' => $grade,
//	        'filterModel' => $searchModel,
	        'columns' => [
//	            ['class' => 'yii\grid\SerialColumn'],
//							'MitgliedId', 
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz' ],
							[ 'attribute' => 'Disziplin', 'value' => 'disziplinen.DispKurz' ],
//							[ 'attribute' => 'Datum', 'value' => 'Datum', 'format' => ['date', 'php:d.m.Y'] ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName' ],
            	[ 'class' => 'yii\grid\ActionColumn',
            						'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete} &nbsp;&nbsp; {print}',
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
                </p>
            </div>
            </div><!-- content -->
</div><!-- row -->


