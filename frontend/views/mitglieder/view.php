<?php

use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
//use yii\helpers\BaseHtml;
use yii\bootstrap4\Html;
use yii\bootstrap4\BaseHtml;
use yii\bootstrap4\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;

use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\datecontrol;
use kartik\widgets\DatePicker;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitgliedersektionen;
use frontend\models\MitgliedersektionenSearch;
use frontend\models\Numbers;
use frontend\models\Pruefer;
use frontend\models\Texte;
?>
<?php //Pjax::begin(['id'=>'pjaxGridView_'.$model->MitgliederId, 'linkSelector' => 'a:not(.linksWithTarget)']); ?>
<?php
    $items = [
		    [
				    'label'=>'<i class="glyphicon glyphicon-user"></i> '.Yii::t('app', 'Person'),
				    'content'=>$this->render('_view_allgemein', array(
				//                                'form' => $form, 
				                                'model'=>$model,  'tabnum' => 1, 'openv' => $openv, 
//                                        'intensiv' => $intensiv
                                        'schulen' => $schulen, 'anreden' => $anreden, 'functions' => $functions, 'sifus' => $sifus, 'disziplinen' => $disziplinen,
                                        'schulorte' => $schulorte,
				                        ) ),
						'active' => $tabnum == 1?true:false,
				//    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=1'])]
		    ],
		    [
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> '.Yii::t('app', 'Contract'),
				    'content'=>$this->render('_view_vertrag', array(
				                                'model'=>$model, 'contracts' => $contracts,  'tabnum' => 3,  'openv' => $openv, 'formedit' => $formedit,
                                        'schulen' => $schulen, 'anreden' => $anreden, 'functions' => $functions, 'sifus' => $sifus, 'disziplinen' => $disziplinen,
                                        'schulorte' => $schulorte,
				                        ) ),
						'active' => $tabnum == 3?true:false,
		    ],
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> '.Yii::t('app', 'Levels'),
						'content'=>$this->render('_view_grade_index', array(
		                                'model'=>$model, 'grade' => $grade, 'sektionen' => $sektionen, 
																		'tabnum' => 5, 'openv' => $openv, 
																		'grade_zur_auswahl' => $grade_zur_auswahl,
																		'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
																		'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
                                    'schulen' => $schulen, 'anreden' => $anreden, 'functions' => $functions, 'sifus' => $sifus, 'disziplinen' => $disziplinen,
                                    'schulorte' => $schulorte,		                        ) ),
						'active' => $tabnum == 5?true:false,				
				],
/*				[
				    'label'=>'<i class="glyphicon glyphicon-pencil"></i> Notiz',
						'content'=>$this->render('_view_notiz', array(
		                                'model'=>$model, 'tabnum' => 6,
		                        ) ),
						'active' => $tabnum == 6?true:false, 
				],
*/			  [
				    'label'=>'<i class="glyphicon glyphicon-list-alt"></i> '.Yii::t('app', 'Texts'),
						'content'=>$this->render('_view_texte', array(
		                                'model'=>$model, 'tabnum' => 8, 
		                        ) ),
						'active' => $tabnum == 8?true:false,
						'headerOptions' => Yii::$app->user->identity->isAdmin ? ['class'=>'enabled'] : ['class'=>'disabled'],
						
		    ],  
			  [
				    'label'=>'<div class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> '.Yii::t('app', 'Delete').'</div>',
						'content'=> Html::a(Yii::t('app', '<i class="glyphicon glyphicon-remove"></i> '.Yii::t('app', 'Delete this Member')), ['delete', 'id' => $model->MitgliederId], [
			          'class' => 'btn btn-sm btn-danger',
			          'data' => [
			              'confirm' => Yii::t('app', 'Do you really want to delete this Record?'),
			              'method' => 'post',
    			          ],
//			          'style' => 'width: 80px; text-align: left;',
			
    			      ]),                                                      
    						'active' => $tabnum == 9?true:false, 
		    ],  
/*			  [
				    'label'=>'<div class="btn btn-sm btn-success" onclick="js:history.go(-1);return false;"><i class="glyphicon glyphicon-remove"></i> Zurück</div>',
						'content'=> '',                                                      
    						'active' => false, 
		    ],
*/          
    ];

 
/* @var $this yii\web\View */
/* @var $model frontend\models\Mitglieder */

$this->title = $model->Name . ', ' . $model->Vorname . ' - ' . $model->MitgliedsNr;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieder'), 'url' => ['/mitgliederliste/index']];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => 'zurück', 'url' => Yii::$app->request->getReferrer()];

if ($model->hasErrors()) {
  echo Html::errorSummary($model);
}?>
		        <?php /*echo Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-sm btn-primary',
		        ])*/ ?>
		        <?php // Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            //'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        //]) 
						?>				

<div class="col-12" style="font-size:12pt !important;">
				<?php  // <div class="d-none d-sm-block" style="font-size:12pt !important;">
                  // Ajax Tabs top
				    echo TabsX::widget([
				    		'id' => 'main-tab',
						    'enableStickyTabs' => true,
						    'items'=>$items,
						    'position'=>TabsX::POS_ABOVE,
		//				    'height' => TabsX::SIZE_LARGE,
			 					'bordered'=>true,
						    'encodeLabels'=>false,
				    ]);
				?>
</div>
<div class="d-block d-sm-block">
				<?php //<div class="d-block d-sm-none">
                   // Ajax Tabs Left
/*				    echo TabsX::widget([
				    		'id' => 'main-tab-2',
						    'enableStickyTabs' => true,
						    'items'=>$items,
//						    'position'=>TabsX::POS_LEFT,
						    'position'=>TabsX::POS_ABOVE,
//						    'sideways'=>true,
			 					'bordered'=>true,
						    'encodeLabels'=>false,
				    ]);
*/				?>
</div>
<?php //Pjax::end(); ?>
