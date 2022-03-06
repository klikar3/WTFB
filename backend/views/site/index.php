<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use kartik\datecontrol\DateControl;
use kartik\depdrop\DepDrop;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\sortable\Sortable;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Typeahead;

use backend\models\Anwesenheitsliste;
use backend\models\Trainings;
use backend\models\Schulen;
use backend\models\mitglieder;

/* @var $this yii\web\View */

$this->title = 'Anwesenheitsliste';
?>
<div class="card site-index">


  <div class="card-header">

        <div class="row">
            <div class="col-lg-4">
        <?php    
			$form = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data'], // important
			    'id' => 'formds',
			    'action'=>['index'], // 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
			?>
     
            <?= $form->field($model, 'schule')->widget(Select2::classname(), [
                'data' => $schulen,
                'language' => 'de',
                'options' => ['id' => 'schule-id', 'multiple' => true, 'placeholder' => 'Schule auswaehlen ...'],
                'pluginOptions' => [
                    'allowClear' => true,
//                    'style' => 'width:200px;',
                ],
            ])
            ->label(false);
			?>
            </div>
            <div class="col-lg-4">
     
			<?= $form->field($model, 'datum')->widget(DatePicker::classname(), [
							'value' => $model->datum, 
							'options'=>['placeholder'=>'Datum'], 
							'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy', 'convertFormat' => true,
									'todayHighlight' => true, 'todayBtn' => true,
							]									
					])  
                ->label(false);
			?>		
            </div>
            <div class="col-lg-4">
            <?= 
                $form->field($model, 'training')
                        ->widget(DepDrop::classname(), [
                            'type' => DepDrop::TYPE_SELECT2,
                            'data' => $trainings,
                            'options' => ['id' => 'subcat2-id', 'placeholder' => 'Select ...'],
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'depends' => ['schule-id'],
                                'url' => Url::to(['/site/trainings']),
                                'params' => ['input-type-1', 'input-type-2']
                            ]
                        ])
                        ->label(false);
			?>
            <?= Html::submitButton('Auswählen', ['class'=>'btn btn-sm btn-primary']);
            ?>		
        <?php    
			ActiveForm::end();   
		?> 
            </div>
        </div>
    </div>
    <div class="card-body">
         <div class="row">
            <div class="col-lg-5">
       <?php	$form2 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data'], // important
			    'id' => 'formds',
			    'action'=>['create'], // 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
			?>
        <?= $form2->field($model, 'mitglied')->widget(Typeahead::classname(), [
                          'options' => ['placeholder' => 'Filter as you type ...'],
                          'pluginOptions' => ['highlight'=>true],
                          'dataset' => [
                              [
                                  'local' => Arrayhelper::getColumn($mitglieder, 'content'),
                                  'limit' => 1
                              ]
                          ]
                      ])
            ->label(false);
			?>
            <?= Html::submitButton('Eintragen', ['class'=>'btn btn-sm btn-primary']);
            ?>		
        <?php    
			ActiveForm::end();   
		?> 
            </div>
            <div class="col-lg-5">
 	<?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'responsiveWrap' => false,
			   	'condensed'=>true,
				  'hover'=>true,
          'options' => ['id' => 'exp_row_grade',
          ], 
//					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
//					],
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
//					'rowOptions' => [ 'style' => 'font-size:0.85em',
//					],
	        'columns' => [
                [ 'class' => '\kartik\grid\SerialColumn' ],				
                [ 'attribute' => 'content', ],
             	[ 'class' => '\kartik\grid\ActionColumn',
              						'template' => '{delete}',
  												'header' => '<span style="text-align-left;">'.Yii::t('app', 'Actions').'</span>',
  												'controller' => 'mitgliedergrade',
  												'deleteOptions' => [
  														'data-confirm' => Yii::t('app', 'Really delete this Level?'),
  												],
  //												'width' => '30px',
  							],
  				],
	    ]); ?>
            </div>
        </div>
    </div>
</div>
<div class="card">
      <div class="row">
          <div class="col-lg-5">

      <?php
echo Sortable::widget([
  'connected'=>true,
  'items'=> $mitglieder //[
//        ['content'=>'From Item 1', 'mid' => 'test1'],
//        ['content'=>'From Item 2', 'mid' => 'test2'],
//        ['content'=>'From Item 3', 'mid' => 'test3'],
//        ['content'=>'From Item 4', 'mid' => 'test4'],
//    ]
]);
?>
          </div>
		<div class="col-lg-2 text-center">
			<div class="dynagrid-sortable-separator"><i class="fas fa-arrows-alt-h"></i><i class="glyphicon glyphicon-resize-horizontal"></i></div>
		</div>
          <div class="col-lg-5">
      <?php
echo Sortable::widget([
  'connected'=>true,
  'items' => $anwesende,
  'itemOptions'=>['class'=>'alert alert-warning'],
  'pluginOptions'=> ['forcePlaceholderSize' => true, 
                      'placeholder' => '<tr><td colspan="7">&nbsp;</td></tr>'
                  ],
  'items'=>[
  ]
]);
?>
          </div>
      </div>

</div>
