<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use kartik\widgets\ActiveForm;

use frontend\models\AuswertungenForm;
use frontend\models\Schulen;
use frontend\models\Mitglieder;


/* @var $this yii\web\View */
$this->title = 'Interessenten für:';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
  <div class="col-md-3"> </div>   
  <div class="col-md-4">    
    <h3><?= Html::encode($this->title) ?></h3>
			<?php 
		 			$form = ActiveForm::begin( ['method' => 'post',
					 														'action' => Url::to(['site/schuelerzahlen',]),
																			'type' => ActiveForm::TYPE_HORIZONTAL,																																
																		 ]	); 
			?>
			<?= $form->field($model, 'schule')->dropDownList( ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp', 'disziplinen.DispName' )//,
//							['style'=>'width:200px']
                'multiple'=>'multiple'
							)										
									->label(false); 
			?>

					<div style="text-align: right;">
					<?= Html::submitButton('Auswählen', ['class'=>'btn btn-sm btn-primary']);
					?>
					</div>
			<?php 
				$form = ActiveForm::end();
		 	?>

  </div> 
</div>  