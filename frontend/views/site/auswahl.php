<?php
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\checkbox\CheckboxX;

use frontend\models\AuswertungenForm;
use frontend\models\InteressentVorgaben;
use frontend\models\Mitglieder;
use frontend\models\Schulen;


/* @var $this yii\web\View */
$schulen = ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp' );
$wohers = ArrayHelper::map( InteressentVorgaben::find()->where(['code' => 'Woher'])->orderBy('sort')->all(), 'wert', 'wert' );

if (Yii::$app->controller->action->id == 'sektionsauswahl') {
  $this->title = 'Sektionsliste';
  $ziel = ['/mitgliedersektionen/sektionsliste',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [10 => "Stuttgart WT"] + $schulen : $schulen;
}  
if ((Yii::$app->controller->action->id == 'infoabendauswahl') or (Yii::$app->controller->action->id == 'info-abendliste')){
  $this->title = 'InfoAbend-Liste';
  $ziel = ['/site/info-abendliste',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
}                                   
if ((Yii::$app->controller->action->id == 'probetrainingauswahl') or (Yii::$app->controller->action->id == 'probe-trainingliste')){
  $this->title = 'Probetraining-Liste';
  $ziel = ['/site/probe-trainingliste',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
}                                   
if (Yii::$app->controller->action->id == 'interessentenauswahl') {
  $this->title = 'Interessenten-Liste';
  $ziel = ['/site/interessentenliste',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
}  
if (Yii::$app->controller->action->id == 'schuelerzahlenauswahl') {
  $this->title = 'Schülerzahlen-Liste';
  $ziel = ['/site/schuelerzahlen',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
}  
if (Yii::$app->controller->action->id == 'geburtstagsliste') {
  $this->title = 'Geburtstags-Liste';
  $ziel = ['/site/geburtstagsliste',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
}  
if (Yii::$app->controller->action->id == 'dvdlistenauswahl') {
  $this->title = 'DVD-Liste';
  $ziel = ['/site/dvdliste',];
  $schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
}  
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);

//Yii::warning(VarDumper::dumpAsString($schulen),'application');
//Yii::warning(VarDumper::dumpAsString($schulauswahl),'application');
?>
<div class="row">
  <div class="col-md-3"> </div>   
  <div class="col-md-4"> 
  <div class="panel panel-info"> 
    <div class="panel-heading" style="margin: 5px;padding:5px;">   
    <h4><?= Html::encode($this->title.' für') ?></h4>
    </div>
    <div class="panel-body" style="margin: 5px;padding:5px;">   
			<?php 
		 			$form = ActiveForm::begin( ['method' => 'post',
					 														'action' => Url::to($ziel),                                      
																			'type' => ActiveForm::TYPE_HORIZONTAL,																																
																		 ]	); 
			?>
			<?php /*$form->field($model, 'schule')->dropDownList( ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp', 'disziplinen.DispName' ),
							['multiple'=>'multiple',
//							'style'=>'width:200px'
                ])										
									->label(false); 
*/			?>
      <?= $form->field($model, 'schule')->widget(Select2::classname(), [
          'data' => $schulauswahl,
          'language' => 'de',
          'options' => ['multiple' => true, 'placeholder' => 'Schule auswählen ...'],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ])->label(false);
			?>
<?php if (Yii::$app->controller->action->id == 'infoabendauswahl') { ?>
      <?= $form->field($model, 'woher')->widget(Select2::classname(), [
          'data' => $wohers,
          'language' => 'de',
          'options' => ['multiple' => true, 'placeholder' => 'Woher auswählen ...'],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ])->label(false);
			?>
<?php } ?>  
<?php if (Yii::$app->controller->action->id == 'interessentenauswahl') { ?>
      <?= $form->field($model, 'woher')->widget(Select2::classname(), [
          'data' => $wohers,
          'language' => 'de',
          'options' => ['multiple' => true, 'placeholder' => 'Woher auswählen ...'],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ])->label(false);
			?>
      <?= $form->field($model, 'fon')->widget(CheckboxX::classname(), [
          'initInputType' => CheckboxX::INPUT_CHECKBOX ,
//          'language' => 'de',
//          'autoLabel'=>true,
//          'options' => ['style'=>'width:200px'],
          'pluginOptions' => [
              'threeState' => false, 'enclosedLabel' => true
          ],
      ])->label(false);
      ?>
      <?= $form->field($model, 'ia')->widget(CheckboxX::classname(), [
          'initInputType' => CheckboxX::INPUT_CHECKBOX ,
          'pluginOptions' => [
              'threeState' => false, 'enclosedLabel' => true
          ],
      ])->label(false);
      ?>
      <?= $form->field($model, 'pt')->widget(CheckboxX::classname(), [
          'initInputType' => CheckboxX::INPUT_CHECKBOX ,
          'pluginOptions' => [
              'threeState' => false, 'enclosedLabel' => true
          ],
      ])->label(false);
      ?>
<?php } ?>          
<?php if (Yii::$app->controller->action->id == 'schuelerzahlenauswahl') { ?>
<br><br>
<?= $form->field($model, 'von')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app', 'Month')],
                    'attribute2'=>'to_date',
//                    'type' => DatePicker::TYPE_RANGE,
                    'pluginOptions' => [
                        'autoclose' => true,
//                        'viewMode'=>'Month',
                        'minViewMode'=>'months',
                        'format' => 'dd.mm.yyyy'
                    ]
                ]) ?>
<?php } ?>          
					<div style="text-align: right;padding-bottom:5px;">
					<?= Html::submitButton('Auswählen', ['class'=>'btn btn-sm btn-primary', 'formTarget' => '_blank']);
					?>
					</div>
			<?php 
				$form = ActiveForm::end();
		 	?>

  </div>
  </div>
  </div> 
</div> 
