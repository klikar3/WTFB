<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use frontend\models\Mitglieder;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use yii\bootstrap\Modal;

use kartik\widgets\ActiveForm;
//use kartik\widgets\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedergrade */
/* @var $form yii\widgets\ActiveForm */
?>

                <p>

	<?= GridView::widget([
	        'dataProvider' => $grade,
//	        'filterModel' => $searchModel,
	        'columns' => [
//	            ['class' => 'yii\grid\SerialColumn'],
//							'MitgliedId', 
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz' ],
							[ 'attribute' => 'Disziplin', 'value' => 'disziplinen.DispKurz' ],
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName' ],
							[ 'attribute' => 'Datum', 'value' => 'Datum', 'format' => ['date', 'php:d.m.Y'] ],
				],
	    ]); ?>
                </p>
<div class="mitgliedergrade-form">
    
    <?php $form = ActiveForm::begin([
                      'type' => ActiveForm::TYPE_HORIZONTAL,
                      'id' => 'mgcrea-form-horizontal',
											'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM,
												'showErrors' => true,
											]
          ]); ?>

    <?= $form->field($model, 'MitgliedId')->hiddenInput()->label('') ?>
							<div class="row">																	
    							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <?= $form->field($model, 'GradId')->dropdownList(ArrayHelper::map( Grade::find()->select(['gradId', 'concat(GradName,\' \',DispName) as GradName'])->orderBy('gradId')->asArray()->all(), 'gradId', 'GradName', 'DispName' ),
            [ 'prompt' => '',
            ]
            )->label('Graduierung') ?>
                							</div>
                							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'Datum')->widget(DateControl::classname(), [
            							'type'=>DateControl::FORMAT_DATE,
            							'ajaxConversion'=>true,
             							'displayFormat' => 'php:d.m.Y',
             							'saveFormat' => 'php:Y-m-d',
            							'value' => 'Datum',
            //							'options' => ['placeholder' => 'Graduierungsdatum ...'],
            							'pluginOptions' => [	
            									'autoclose'=>true
            							] 
            						]) 
		?>
                  </div>
              </div>
							<div class="row">																	
    							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <?= $form->field($model, 'PrueferId')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
[ 'prompt' => '' ]
)->label('Prüfer') ?>
                  </div>
    							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<?= $form->field($model, 'print')->checkBox(
	[ 'prompt' => 'Print' ]
	) ?>
                  </div>
              </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Zuweisen') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
