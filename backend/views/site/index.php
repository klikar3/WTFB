<?php
use yii\helpers\ArrayHelper;

use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kartik\sortable\Sortable;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;

use backend\models\Anwesenheitsliste;
use backend\models\Trainings;
use backend\models\Schulen;
use backend\models\mitglieder;

/* @var $this yii\web\View */

$this->title = 'Anwesenheitsliste';
?>
<div class="site-index">

   <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
        <?php    
			$form = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data'], // important
			    'id' => 'formds',
//			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
			?>
     
            <?= $form->field($model, 'schule')->widget(Select2::classname(), [
                'data' => ArrayHelper::map( Schulen::find()->with('disziplin')->all(), 'SchulId', 'SchulDisp' ),
                'language' => 'de',
                'options' => ['multiple' => true, 'placeholder' => 'Schule auswaehlen ...'],
                'pluginOptions' => [
                    'allowClear' => true,
//                    'style' => 'width:200px;',
                ],
            ])->label(false);
			?>
       <?php    
			ActiveForm::end();   
		?> 
            </div>
            <div class="col-lg-4">
       <?php    
			$form2 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data'], // important
			    'id' => 'formd',
//			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
			?>
     
			<?= $form2->field($model, 'datum')->widget(DatePicker::classname(), [
							'value' => $model->datum, 
							'options'=>['placeholder'=>'Von'], 
							'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy', 'convertFormat' => true,
									'todayHighlight' => true, 'todayBtn' => true,
							]									
					])->label(false);
			?>		
           <?php    
    			ActiveForm::end(); 
    		?> 
            </div>
            <div class="col-lg-4">
           <?php    
    			$form3 = ActiveForm::begin([
    			    'options'=>['enctype'=>'multipart/form-data'], // important
    			    'id' => 'formt',
    //			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],
    
    			]);
			?>
     
            <?= 
                $form3->field($model, 'training')->widget(Select2::classname(), [
                'data' => ArrayHelper::map( Trainings::find()->all(), 'id', 'description', 'description' ),
                'language' => 'de',
                'options' => ['multiple' => true, 'placeholder' => 'Schule auswaehlen ...'],
                'pluginOptions' => [
                    'allowClear' => true,
//                    'style' => 'width:200px;',
                ],
            ])->label(false);
			ActiveForm::end();   
		?> 
            </div>
        </div>
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
</div>
