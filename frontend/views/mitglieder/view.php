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
     
    $items = [
		    [
				    'label'=>'<i class="glyphicon glyphicon-user"></i> Person',
				    'content'=>$this->render('_view_allgemein', array(
				//                                'form' => $form, 
				                                'model'=>$model,
				                        ) ),
				//    'active'=>true,
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=1'])]
		    ],
		    [
				    'label'=>'<i class="glyphicon glyphicon-tower"></i> Schule',
				    'content'=>$this->render('_view_schule', array(
				                                'model'=>$model, 
				                        ) ),
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
		    ],
		    [
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Vertrag',
				    'content'=>$this->render('_view_vertrag', array(
				                                'model'=>$model, 'contracts' => $contracts
				                        ) ),
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
		    ],
				[
				    'label'=>'<i class="glyphicon glyphicon-euro"></i> Zahlung',
						'content'=>$this->render('_view_zahlung', array(
		                                'model'=>$model, 
		                        ) ),
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Graduierung',
						'content'=>$this->render('_view_grade', array(
		                                'model'=>$model, 'grade' => $grade, 
		                        ) ),
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-question-sign"></i> Interessent',
						'content'=>$this->render('_view_interessent', array(
		                                'model'=>$model,  
		                        ) ),
				],
/*			    [
				    'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
				    'items'=>[
						    [
						    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
								    'encode'=>false,
								    'content'=>'',
								//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
						    ],
						    [
						    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
								    'encode'=>false,
								    'content'=>'',//$content4,
//								    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
						    ],
				    ],
		    ],  */
    ];
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$this->title = $model->Vorname . ' ' . $model->Name;
$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-view">
  <div class="row">
    <div id="content" class="col-sm-10">
      <div class="row">
		 		<div class="col-sm-4">
		        <?= Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-primary',
		        ]) ?>
		        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->MitgliederId], [
		            'class' => 'btn btn-danger',
		            'data' => [
		                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
		                'method' => 'post',
		            ],
		        ]) ?>
		        <?php // Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            //'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        //]) 
						?>				</div>
			</div>
			<?php    // Ajax Tabs Left
			    echo TabsX::widget([
			    'items'=>$items,
			    'position'=>TabsX::POS_ABOVE,
 					'bordered'=>true,
			    'encodeLabels'=>false
			    ]);
			?>
    </div><!-- content -->

  </div>

</div>
