<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

use dosamigos\chartjs\ChartJs;
//use robregonm\rgraph\RGraphAsset;
//use robregonm\rgraph\RGraphBarAsset;
//use robregonm\rgraph\RGraphWidget;
//use robregonm\rgraph\RGraphBar;
//use klikar3\rgraph\RGraphBar;
use klikar3\rgraph\RGraphLine;

use frontend\models\AuswertungenForm;
use frontend\models\Schulen;


/* @var $this yii\web\View */
$this->title = 'Mitgliederzahlen';
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
  <div class="row">    
			<?php
//					$schule = 10;
//					$von = '01.01.2016';
		 			$form = ActiveForm::begin( ['method' => 'post',
					 														'action' => Url::to(['site/mitgliederzahlen',]),
																			'type' => ActiveForm::TYPE_HORIZONTAL,																																
																		 ]	); 
			?>
			<?= $form->field($model, 'schule')->dropDownList( ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'Schulname', 'Disziplin' ),
							['style'=>'width:200px']
							)										
//									->label('Textauswahl'); 
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
							'options'=>['placeholder'=>'Bis'], 
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
<?php if (!empty($datasets)) {
?>    
    <table>
    	<tr> <td>
<p><a font style="color:#bcbcbc;background-color:#bcbcbc;font-size:7pt">nbsp;</a><a font style="color:#bcbcbc;font-size:7pt"> WT-Eintritte </a><br>
<a font style="color:#97BBCD;background-color:#97BBCD;font-size:7pt">nbsp;</a><a font style="color:#97BBCD;font-size:7pt"> WT-Austritte </a><br>
<a font style="color:#656BCD;background-color:#656BCD;font-size:7pt">nbsp;</a><a font style="color:#656BCD;font-size:7pt"> WT-Kündigungen </a>
</p>
			</td>  <td>
<?= ChartJs::widget([
    'type' => 'Line',
    'options' => [
        'height' => 400,
        'width' => 800,
    ],
    'clientOptions' => [
      	'scaleShowGridLines' => true,
      	'scaleShowVerticalLines' => false,
      	'legend' => true,
      	'legendTemplate' => '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    // String - Template string for single tooltips
    'tooltipTemplate' => "<%if (label){%><%=label%>: <%}%><%= value %>",

    // String - Template string for multiple tooltips
    'multiTooltipTemplate' => "<%= value %>",
    'customTooltips' => false,
		],
    'data' => [
        'labels' => ArrayHelper::getColumn($labels,'l'),
        'datasets' => [
            [
                'label1' => "WT-Eintritte",
								'fillColor' => "rgba(220,220,220,0.5)",
                'strokeColor' => "rgba(220,220,220,1)",
                'pointColor' => "rgba(220,220,220,1)",
                'pointStrokeColor' => "#fff",
                'data' => ArrayHelper::getColumn($datasets,'WT-Eintritt'),
            ],
            [
                'label1' => "WT-Austritte",
                'fillColor' => "rgba(151,187,205,0.5)",
                'strokeColor' => "rgba(151,187,205,1)",
                'pointColor' => "rgba(151,187,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => ArrayHelper::getColumn($datasets,'WT-Austritt')
            ],
            [
                'label1' => "WT-Kündigungen",
                'fillColor' => "rgba(101,107,205,0.5)",
                'strokeColor' => "rgba(101,107,205,1)",
                'pointColor' => "rgba(101,107,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => ArrayHelper::getColumn($datasets,'WT-Kuendigung')
            ],
        ],
    ]
]);
?>
			</td>
		</tr>
		</table>


    <table>
    	<tr> <td>
<p><a font style="color:#bcbcbc;background-color:#bcbcbc;font-size:7pt">nbsp;</a><a font style="color:#bcbcbc;font-size:7pt"> Esck-Eintritte </a><br>
<a font style="color:#97BBCD;background-color:#97BBCD;font-size:7pt">nbsp;</a><a font style="color:#97BBCD;font-size:7pt"> Esck-Austritte </a><br>
<a font style="color:#656BCD;background-color:#656BCD;font-size:7pt">nbsp;</a><a font style="color:#656BCD;font-size:7pt"> Esck-Kündigungen </a>
</p>
			</td>  <td>
<?= ChartJs::widget([
    'type' => 'Line',
    'options' => [
        'height' => 400,
        'width' => 800,
    ],
    'clientOptions' => [
      	'scaleShowGridLines' => true,
      	'scaleShowVerticalLines' => false,
      	'legend' => true,
      	'legendTemplate' => '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    // String - Template string for single tooltips
    'tooltipTemplate' => "<%if (label){%><%=label%>: <%}%><%= value %>",

    // String - Template string for multiple tooltips
    'multiTooltipTemplate' => "<%= value %>",
    'customTooltips' => false,
		],
    'data' => [
        'labels' => ArrayHelper::getColumn($labels,'l'),
        'datasets' => [
            [
                'label1' => "Esck-Eintritte",
								'fillColor' => "rgba(220,220,220,0.5)",
                'strokeColor' => "rgba(220,220,220,1)",
                'pointColor' => "rgba(220,220,220,1)",
                'pointStrokeColor' => "#fff",
                'data' => ArrayHelper::getColumn($datasets,'E-Eintritt'),
            ],
            [
                'label1' => "Esck-Austritte",
                'fillColor' => "rgba(151,187,205,0.5)",
                'strokeColor' => "rgba(151,187,205,1)",
                'pointColor' => "rgba(151,187,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => ArrayHelper::getColumn($datasets,'E-Austritt')
            ],
            [
                'label1' => "Esck-Kündigungen",
                'fillColor' => "rgba(101,107,205,0.5)",
                'strokeColor' => "rgba(101,107,205,1)",
                'pointColor' => "rgba(101,107,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => ArrayHelper::getColumn($datasets,'E-Kuendigung')
            ],
        ],
    ]
]);
?>
			</td>  <td>
			</td>
		</tr>
		</table>
			<?php  
			   RGraphLine::widget([
        		'allowDynamic' => true,
				    'data' => !empty($datasets) ? array_map('intval', ArrayHelper::getColumn($datasets,'WT-Eintritt')) : [ 0 ],
				    'options' => [
				        'height' => 400,
				        'width' => 800,
		            'colors' => ['red'],
           			'filled' => true,
		            'title' => 'WT-Eintritte',
		            'labels' => !empty($labels) ? array_map(function($val){return substr($val,0,15);},
                                  array_column(array_chunk(ArrayHelper::getColumn($labels,'l'),count($labels)/10),0)
                        ) : [ 'No Data' ],
                'numxticks' => 10,
	              'textAngle' => 45,
	              'textSize' => 8,
	              'gutter' => ['left' => 45, 'bottom' => 50, 'top' => 50],
	              'titleSize' => 12,
				    ]
				 ]);
}			?>
</div>
