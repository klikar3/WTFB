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
            	'template' => '{email} &nbsp;&nbsp; {update}',
							'controller' => 'mitglieder',
							'buttons' => [ 
								'email' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::toRoute(['mitglieder/email', 'id' => $model->MitgliederId] ), [
          					'target'=>'_blank',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
							        ]);
							    },
							],
							'width' => '60px',
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
            ['attribute' => 'Grad', 'width' => '100px' ],
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{markieren} &nbsp;&nbsp; {graduieren}',
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
							
							'width' => '60px',
/*							'dropdown' => true,     */
						],
//            'PruefungZum',
/*						[
						    'attribute' => 'PruefungZum',
						    'format' => 'raw',
						    'value' => function ($model, $index, $widget) {
						        return Html::checkbox('PruefungZum[]', $model->PruefungZum, ['value' => $index, 'disabled' => true]);
						    },
						],
*/        ],
        'responsive' => true,    
//        'export' => true,    
				'toolbar' => [
						'{export}',
						'{toggleData}',
				],
		    'panel' => [
		        'heading' => '<b>Mitgliederliste</b>',
		        'before' => '', //IMPORTANT
		    ],
		]); ?>
            </div><!-- content -->

         </div>

</div>
