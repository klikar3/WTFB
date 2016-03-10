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
use frontend\models\Numbers;
use frontend\models\Pruefer;
use frontend\models\Texte;
?>
<?php
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
				    'label'=>'<i class="glyphicon glyphicon-euro"></i> Konto',
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
			    [
				    'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Texte',
						'content'=>$this->render('_view_texte', array(
		                                'model'=>$model,  
		                        ) ),
						'active' => $tabnum == 8?true:false,
						'headerOptions' => Yii::$app->user->identity->isAdmin ? ['class'=>'enabled'] : ['class'=>'disabled'],
						
		    ],  
    ];
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

//$this->title = $model->Vorname . ' ' . $model->Name;
$this->title = $model->MitgliedsNr;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieder'), 'url' => ['/mitgliederliste/index']];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => 'zurück', 'url' => Yii::$app->request->getReferrer()];

if($model->hasErrors()){
  echo BaseHtml::errorSummary($model);
}?>
<div class="mitglieder-view">
  <div class="row">
    <div id="content" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		        <?php /*echo Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-sm btn-primary',
		        ])*/ ?>
		        <?php // Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            //'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        //]) 
						?>				
				<?php    // Ajax Tabs Left
				    echo TabsX::widget([
				    'items'=>$items,
				    'position'=>TabsX::POS_ABOVE,
//				    'height' => TabsX::SIZE_LARGE,
	 					'bordered'=>true,
				    'encodeLabels'=>false
				    ]);
				?>
	    </div><!-- content -->
    <div id="right" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	      <?= Html::a(Yii::t('app', '<i class="glyphicon glyphicon-remove"></i>&nbsp;Löschen'), ['delete', 'id' => $model->MitgliederId], [
	          'class' => 'btn btn-sm btn-danger',
	          'data' => [
	              'confirm' => Yii::t('app', 'Soll dieser Datensatz wirklich gelöscht werden?'),
	              'method' => 'post',
	          ],
	          'style' => 'width: 80px; text-align: left;',
	
	      ]); ?>
    </div><!-- right -->

  </div>

</div>
