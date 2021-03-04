<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\datecontrol;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;

//use dosamigos\chartjs\ChartJs;
//use robregonm\rgraph\RGraphAsset;
//use robregonm\rgraph\RGraphBarAsset;
//use robregonm\rgraph\RGraphWidget;
//use robregonm\rgraph\RGraphBar;
//use klikar3\rgraph\RGraphBar;
use klikar3\rgraph\RGraphBar;
use klikar3\rgraph\RGraphLine;

use frontend\models\AuswertungenForm;
use frontend\models\Schulen;


/* @var $this yii\web\View */
$this->title = 'Anwesenheiten';
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);
?>
<div class="site-about">
  <div class="row">    
  <div class="col-md-3"> </div> 
  <div class="panel panel-info col-md-5"> 
    <div class="panel-heading" style="margin: 5px;padding:5px;">   
      <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="panel-body" >   
			<?php 
//					$schulname = 
//					$von = '01.01.2016';
		 			$form = ActiveForm::begin( ['method' => 'post',
					 														'action' => Url::to(['site/anwesenheit',]),
																			'type' => ActiveForm::TYPE_HORIZONTAL,																																
																		 ]	); 
			?>
			<?php echo $form->field($model, 'schule')->dropDownList( ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp', 'disziplinen.DispName' ),
							['style'=>'width:200px']
							)										
//									->label('Textauswahl'); 
			?>
      <?php $form->field($model, 'schule')->widget(Select2::classname(), [
          'data' => ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp', 'disziplinen.DispName' ),
          'language' => 'de',
          'options' => ['multiple' => true, 'placeholder' => 'Schule auswählen ...'],
          'pluginOptions' => [
              'allowClear' => true,
              'style' => 'width:200px;',
          ],
      ])->label(false);
			?>
			<?= $form->field($model, 'von')->widget(DatePicker::classname(), [
							'value' => $model->von, 
							'options'=>['placeholder'=>'Von'], 
							'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy', 'convertFormat' => true,
									'todayHighlight' => true, 'todayBtn' => true,
							]									
					]);
			?>		
			<?= $form->field($model, 'bis')->widget(DatePicker::classname(), [
							'value' => $model->bis, 
							'options'=>['placeholder'=>'Bis',
//                  'style' => 'z-index: 1151 !important; '
              ], 
							'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy', 'convertFormat' => true,
									'todayHighlight' => true, 'todayBtn' => true, 
							]
					]);
			?>

					<div style="text-align: right;">
					<?= Html::resetButton('Rücksetzen', ['class'=>'btn btn-sm btn-default']) . '  ' . 
								Html::submitButton('Auswählen', ['class'=>'btn btn-sm btn-primary']);
					?>
					</div>
			<?php 
				$form = ActiveForm::end();
		 	?>
    </div>
   </div> 
  </div>  
<?php if (!empty($datasets)) {  echo Schulen::findOne($model->schule)->SchulDisp;
				/*$Esum = $Asum = $Ksum = 0;
        foreach ($datasets as $dat) {
            $Esum += $dat['Eintritt'];
            $Asum += $dat['Austritt'];
            $Ksum += $dat['Kuendigung']; */
          
?>    
    <table>
      </td>  <td>  
      <!---
<p><a font style="color:#bcbcbc;background-color:#bcbcbc;font-size:7pt">nbsp;</a><a font style="color:#bcbcbc;font-size:7pt"> Eintritte </a><br>
<a font style="color:#97BBCD;background-color:#97BBCD;font-size:7pt">nbsp;</a><a font style="color:#97BBCD;font-size:7pt"> Austritte </a><br>
<a font style="color:#656BCD;background-color:#656BCD;font-size:7pt">nbsp;</a><a font style="color:#656BCD;font-size:7pt"> Kündigungen </a>
</p>   -->
			</td>  <td>
			<?php 
        /* echo 
			   RGraphBar::widget([
        		'allowDynamic' => true,
				    'data' => !empty($datasets) ? ArrayHelper::getColumn($datasets, function ($element) {
    																							return intval($element['Eintritt']);}
																									) : [ 0 ],
				    'options' => [
				        'height' => 600,
				        'width' => 1000,
		            'colors' => ['green'],
           			'filled' => true,
		            'title' => 'WT-Eintritte',
		            'labels' => !empty($labels) ? ArrayHelper::getColumn($labels,'l') : [ 'No Data' ],
                'numxticks' => 10,
	              'textAngle' => 45,
	              'textSize' => 8,
	              'gutter' => ['left' => 45, 'bottom' => 50, 'top' => 50],
	              'titleSize' => 12,
				    ],
				    'htmlOptions' => [
              'height' =>  '400px',
              'width' => '800px',
          ],
  
				 ]);  
				 echo 
			   RGraphBar::widget([
        		'allowDynamic' => true,
				    'data' => !empty($datasets) ? ArrayHelper::getColumn($datasets, function ($element) {
    																							return intval($element['Austritt']);}
																									) : [ 0 ],
				    'options' => [
				        'height' => 400,
				        'width' => 1000,
		            'colors' => ['red'],
           			'filled' => true,
		            'title' => 'WT-Austritte',
		            'labels' => !empty($labels) ? ArrayHelper::getColumn($labels,'l') : [ 'No Data' ],
                'numxticks' => 10,
	              'textAngle' => 45,
	              'textSize' => 8,
	              'gutter' => ['left' => 45, 'bottom' => 50, 'top' => 50],
	              'titleSize' => 12,
				    ],
				    'htmlOptions' => [
              'height' =>  '400px',
              'width' => '800px',
          ],
  
				 ]); */
/*         $dat = [ArrayHelper::getColumn($datasets, function ($element) {
    																							return intval($element['Eintritt']);}
																									) , ArrayHelper::getColumn($datasets, function ($element) {
    																							return -intval($element['Austritt']);}
																									)]; 
         Yii::warning(VarDumper::dumpAsString($dat),'application');                                     
*/          	
			   echo 
			   RGraphBar::widget([
        		'allowDynamic' => true,
            'allowTooltips' => true,
            'allowKeys' => true,
            'allowResizing' => true,
				    'data' => !empty($datasets) ? ArrayHelper::getColumn($datasets, function ($element) {
    																							return intval($element['anzahl']);}
																									)  : [ 0 ],
				    'options' => [
				        'height' => 600,
				        'width' => 1000,
		            'colors' => ['lightgreen'],
           			'filled' => true,
                'grouping' => 'stacked',
                'labelsAbove' => true,
                'labelsAboveSize' => 10,
                'labelsAboveOffset' => -14,
		            'title' => 'Anwesenheitszahlen', //'WT-Eintritte / WT-Austritte',
		            'labels' => !empty($labels) ? ArrayHelper::getColumn($labels,'datum') : [ 'No Data' ],
//                'numxticks' => 10,
	              'textAngle' => 45,
	              'textSize' => 8,
	              'gutter' => ['left' => 45, 'bottom' => 50, 'top' => 50],
                'outofbonds' => true,
	              'titleSize' => 12,
//                'xaxispos' => 'center',
				    ],
				    'htmlOptions' => [
              'height' =>  '400px',
              'width' => '800px',
          ],
          'id' => 'ea',
				 ]);  
			   
}	else {	?>
<p>&nbsp;<br><br><br><br><br><br><br><br><br><br><br><br></p>
<?php } ?>
			</td>
		</tr>
		</table>


</div>
