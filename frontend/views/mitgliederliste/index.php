<?php

use yii\helpers\Html;
use yii\helpers\Url;
/*use yii\grid\GridView; */
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
 


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliederliste');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
          <div class="row">

            <div id="content" class="col-sm-12">

    <p>
        <?= Html::a(Yii::t('app', 'Neues Mitglied anlegen', [
    			'modelClass' => 'Mitglieder',
				]), ['/mitglieder/create'], [ 'class' => 'btn btn-success']) ?>
				
				<?= 
				Html::a('<i class="fa glyphicon glyphicon-print"></i> Prüfungsliste erstellen', ['/mitgliederliste/pruefungsliste'], [
				'class'=>'btn btn-success',
				'target'=>'_blank',
				'data-toggle'=>'tooltip',
				'title'=>'Öffnet die Prüfungsliste in einem neuen Tab'
		]);  ?>  
				<?= 
				Html::a('<i class="fa glyphicon glyphicon-del"></i> Markierungen zurücksetzen', ['/mitgliederliste/resetpliste'], [
				'class'=>'btn btn-danger',
				'target'=>'_blank',
				'data-confirm' => 'Wirklich die Prüfungsmarkierungen zurücksetzen?',
				'data-toggle'=>'tooltip',
				'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
		]);  ?>  
		</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {markieren} &nbsp;&nbsp; {graduieren}',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'markieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::toRoute(['mitglieder/mark', 'id' => $model->MitgliederId] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Für Prüfung vormerken'),
							        ]);
							    },
								'graduieren' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-plus"></span>', Url::toRoute(['mitgliedergrade/create', 'model' => $model] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Graduierung'),
							        ]);
							    }
							    
							],
							
							'width' => '120px',
/*							'dropdown' => true,     */
						],
// 						['class'=>'kartik\grid\CheckboxColumn', //'order'=>DynaGrid::ORDER_FIX_RIGHT
//						],             
						['format' => 'raw',
             'attribute' => 'NameLink',
            ],
//            'MitgliederId',
//            'MitgliedsNr',
//						'Name',
//            'Vorname',
            'Schulname',
            'LeiterName',
            'DispName',
						'Funktion', 
            'Vertrag',
            'Grad',
            'PruefungZum',
        ],
        'responsive' => true,    
//        'export' => true,    
//				'toolbar' => [
//						'{export}',
//						'{toggleData}',
//				],
		    'panel' => [
		        'heading' => '<b>Mitgliederliste</b>',
		        'before' => '', //IMPORTANT
		    ],
		]); ?>
            </div><!-- content -->

         </div>

</div>
