<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mitglieder',
]) . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->MitgliederId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mitglieder-update">

    <h1><?= Html::encode($this->title) ?></h1>
  <div class="row">
    <div id="content" class="col-sm-12">
			    <?php $form = ActiveForm::begin([
							'type' => ActiveForm::TYPE_HORIZONTAL,							
							'id' => 'create-form',
							'enableAjaxValidation' => false,
							'enableClientValidation' => true,
 							'formConfig' => ['labelSpan' => 4, 'spanSize' => ActiveForm::SIZE_SMALL, 'showErrors' => true],
							'fieldConfig' => [
								'autoPlaceholder'=>false
							]
							]); ?>      
			<div class="row">
		 		<div class="col-sm-4">
			        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					        <?= Html::a(Yii::t('app', 'Back'), Yii::$app->request->getReferrer(), [
					            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-primary',
					        ]) ?>
				</div>
			</div>
      <div class="row">

    		<div class="col-sm-12">
			
						<?php     $items = [
								    [
										    'label'=>'<i class="glyphicon glyphicon-user"></i> Allgemein',
										    'content'=>$this->render('_form_allgemein', array(
										                                'form' => $form, 
										                                'model'=>$model,
										                        ) ),
										//    'active'=>true,
										//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=1'])]
								    ],
								    [
										    'label'=>'<i class="glyphicon glyphicon-euro"></i> Verträge',
										    'content'=>$this->render('_form_vertrag', array(
										                                'form' => $form, 
										                                'model'=>$model, 
										                        ) ),
										//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
								    ],
										[
										    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Graduierung',
												'content'=>$this->render('_form_grade', array(
								                                'form' => $form, 
								                                'model'=>$model, 'grade' => $grade, 
								                        ) ),
												//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
										],
						    ];
						   // Ajax Tabs Left
						    echo TabsX::widget([
						    'items'=>$items,
						    'position'=>TabsX::POS_ABOVE,
 								'bordered'=>true,
						    'encodeLabels'=>false
						    ]);
						?>

			    <?php ActiveForm::end(); ?>
			
			</div>
			</div>

    </div><!-- row -->
		</div><!-- content -->
  </div>


    <?= ''/*$this->render('_form', [
        'model' => $model,
    ])*/ ?>

</div>
