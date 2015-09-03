<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\tabs\TabsX;

use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use frontend\models\Texte;


    $items = [
		    [
				    'label'=>'<i class="glyphicon glyphicon-user"></i> Person',
				    'content'=>$this->render('_view_allgemein', array(
				//                                'form' => $form, 
				                                'model'=>$model,
				                        ) ),
						'active' => $tabnum == 1?true:false,
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=1'])]
		    ],
/*		    [
				    'label'=>'<i class="glyphicon glyphicon-tower"></i> Schule',
				    'content'=>$this->render('_view_schule', array(
				                                'model'=>$model, 
				                        ) ),
						'active' => $tabnum == 2?true:false,				

		    ],
*/		    [
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Vertrag',
				    'content'=>$this->render('_view_vertrag', array(
				                                'model'=>$model, 'contracts' => $contracts
				                        ) ),
						'active' => $tabnum == 3?true:false,
		    ],
				[
				    'label'=>'<i class="glyphicon glyphicon-euro"></i> Zahlung',
						'content'=>$this->render('_view_zahlung', array(
		                                'model'=>$model, 
		                        ) ),
						'active' => $tabnum == 4?true:false,
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Graduierung',
						'content'=>$this->render('_view_grade', array(
		                                'model'=>$model, 'grade' => $grade, 
		                        ) ),
						'active' => $tabnum == 5?true:false,				
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-pencil"></i> Notiz',
						'content'=>$this->render('_view_notiz', array(
		                                'model'=>$model,  
		                        ) ),
						'active' => $tabnum == 6?true:false,
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-question-sign"></i> Interessent',
						'content'=>$this->render('_view_interessent', array(
		                                'model'=>$model,  
		                        ) ),
						'active' => $tabnum == 7?true:false,
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
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieder'), 'url' => ['/mitgliederliste/index']];
$this->params['breadcrumbs'][] = $this->title;
if($model->hasErrors()){
  echo BaseHtml::errorSummary($model);
}?>
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
    <div id="right" class="col-sm-2">
      <div class="row">
      	<p>&nbsp;<br>&nbsp;<br>&nbsp;<br> </p>
      </div>
      <div class="row">
        <p>
		        <?= Html::a(Yii::t('app', 'Ausweis drucken'), ['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 'txtid' => 1 ], [
		            'class' => 'btn btn-success',
		            'data' => [
//		                'confirm' => Yii::t('app', 'Wirklich Ausweis drucken?'),
		                'method' => 'post',
		            ],
		        ]) ?>
		    </p>
      </div>
      <div class="row">
        <p>
		        <?= Html::a(Yii::t('app', 'Beitrittsschreiben'), ['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 'txtid' => 2 ], [
		            'class' => 'btn btn-success',
		            'data' => [
		                'confirm' => Yii::t('app', 'Wirklich Beitrittsschreiben drucken?'),
		                'method' => 'post',
		            ],
		        ]) ?>
		    </p>
      </div>
      <div class="row">
        <p>
					<?php
/*						$mg = new MitgliedergradePrint();
						$datum = date('Y-m-d');
    				$mg->Datum = $datum;
            $mg->MitgliedId = $model->MitgliederId;
            $mg->GradId = '';
*/            
						$txtid = '';
          ?>
					<?php Html::beginForm( $id = 'mg-pr-txt',
																	$method = 'post',
																	$action = ['texte/print',
																									'datamodel' => 'mitglieder',
																									'dataId' => $model->MitgliederId,
																									'txtid' => $txtid ]
	//																						'fieldConfig'=>['showLabels'=>true],
	//																					'type' => ActiveForm::TYPE_HORIZONTAL,							
																		); 
					?>
					<?php Modal::begin([ 
						'header' => '<h2>Texte</h2>',
						'toggleButton' => ['label' => 'Weitere Texte... ', 'class' => 'btn btn-sm btn-primary'],
						'footer' => Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary','formtarget'=>'_blank']) .
											Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
					]);
					?>
					<div class="row" style="margin-bottom: 8px">
						<div class="col-sm-10">
  						<?= Html::dropDownList('txtid', $txtid, array_merge(["" => ""], ArrayHelper::map( Texte::find()->andWhere('fuer LIKE "mitglieder" ')->all(), 'id', 'code' )),
									[ 'prompt' => 'Text' ]
									); 
							?>
						</div>
					</div>
					<?php Modal::end();?>
					<?php Html::endForm(); ?>
		    </p>
      </div>
    </div><!-- right -->

  </div>

</div>
