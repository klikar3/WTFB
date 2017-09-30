<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

use frontend\models\Pruefer;
use frontend\models\Sektionen;
use frontend\models\SektionenSearch;
use frontend\models\Sifu;
use frontend\models\SifuSearch;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedersektionen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliedersektionen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mitglied_id')->textInput() ?>

    <?php // echo $form->field($model, 'sektion_id')->textInput(); ?>
    <?php  echo $form->field($model, 'sektion_id')->dropdownList(ArrayHelper::map( Sektionen::find()->all(), 'sekt_id', 'kurz' ),
														[ 'prompt' => 'Sektion', 'id' => 'field-gid' ])->label('Sektion');  ?>

		<?php  echo $form->field($model, 'vdatum')->widget(DateControl::classname(),
		[ //'value' => date('d.m.Y'), 
			'type'=>DateControl::FORMAT_DATE,
			'ajaxConversion'=>true,
			'displayFormat' => 'php:d.m.Y',
			'saveFormat' => 'php:Y-m-d',
			'autoWidget' => true,
			'id' => 'mgfs_vdatu',
			'options'=>[
				'id' => 'mgfs_vdatum',
					'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
				]	
			]); ?>

		<?php  echo $form->field($model, 'vermittler_id')->dropdownList(ArrayHelper::map( Sifu::find()->all(), 'sId', 'SifuName' ),
													[ 'prompt' => 'Vermittler', 'id' => 'field-pid' ])->label('Vermittler');  ?>

		<?php  echo $form->field($model, 'pdatum')->widget(DateControl::classname(),
		[ //'value' => date('d.m.Y'), 
			'type'=>DateControl::FORMAT_DATE,
			'ajaxConversion'=>true,
			'displayFormat' => 'php:d.m.Y',
			'saveFormat' => 'php:Y-m-d',
			'autoWidget' => true,
			'id' => 'mgfs_pdatu',
			'options'=>[
				'id' => 'mgfs_pdatum',
					'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
				]	
			]); ?>

		<?php  echo $form->field($model, 'pruefer_id')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
													[ 'prompt' => 'Pruefer', 'id' => 'field-pid' ])->label('Prüfer');  ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
