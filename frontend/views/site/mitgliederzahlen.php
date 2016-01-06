<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use dosamigos\chartjs\ChartJs;
//use robregonm\rgraph\RGraphAsset;
//use robregonm\rgraph\RGraphBarAsset;
//use robregonm\rgraph\RGraphWidget;
//use robregonm\rgraph\RGraphBar;
use klikar3\rgraph\RGraphBar;
use klikar3\rgraph\RGraphLine;


/* @var $this yii\web\View */
$this->title = 'Mitgliederzahlen';
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
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
				<?= 
				   RGraphBar::widget([
					    'data' => ArrayHelper::getColumn($datasets,'WT-Eintritt'),
					    'options' => [
        'height' => 400,
        'width' => 800,
					        'chart' => [
					            'gutter' => [
					                'left' => 35,
					            ],
					            'colors' => ['red'],
					            'title' => 'A basic chart',
					            'labels' => ArrayHelper::getColumn($labels,'l'),
					        ]
					    ]
					]);
				?>
				<?= 
				   RGraphLine::widget([
					    'data' => ArrayHelper::getColumn($datasets,'WT-Eintritt'),
					    'options' => [
        'height' => 400,
        'width' => 800,
					        'chart' => [
					            'gutter' => [
					                'left' => 35,
					            ],
					            'colors' => ['red'],
					            'title' => 'A basic chart',
					            'labels' => ArrayHelper::getColumn($labels,'l'),
					        ]
					    ]
					]);
				?>
</div>
