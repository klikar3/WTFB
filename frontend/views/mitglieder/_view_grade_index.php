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
<?php


$items1 = [
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Graduierung',
						'content'=>$this->render('_view_grade', array(
		                                'model'=>$model, 'grade' => $grade, 'tabnum' => 5, 'openv' => $openv, 
																		'grade_zur_auswahl' => $grade_zur_auswahl, 'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
		                        ) ),
//						'active' => $tabnum == 5?true:false,				
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Sektion',
						'content'=>$this->render('_view_sektionen', array(
		                                'model'=>$model, 'sektionen' => $sektionen, 'tabnum' => 5, 'openv' => $openv, 
		                        ) ),
//						'active' => $tabnum == 5?true:false,				
				],
];

$this->title = $model->MitgliedsNr;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieder'), 'url' => ['/mitgliederliste/index']];
//$this->params['breadcrumbs'][] = $this->title;

if($model->hasErrors()){
  echo BaseHtml::errorSummary($model);
}?>
<?php Pjax::begin(['id'=>'pjaxGridView_'.$model->MitgliederId,]); ?>

<div class="col-xs-12 visible modal-content">
		        <?php /*echo Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-sm btn-primary',
		        ])*/ ?>
		        <?php // Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            //'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        //]) 
						?>				
				<?php    // Ajax Tabs Left
				    echo TabsX::widget([
				    		'id' => 'main-grade',
						    'enableStickyTabs' => true,
						    'items'=>$items1,
						    'position'=>TabsX::POS_ABOVE,
		//				    'height' => TabsX::SIZE_LARGE,
			 					'bordered'=>true,
						    'encodeLabels'=>false,
				    ]);
				?>
</div>
<div class="col-xs-12 hidden modal-content">
				<?php    // Ajax Tabs Left
				    echo TabsX::widget([
				    		'id' => 'main-grade',
						    'enableStickyTabs' => true,
						    'items'=>$items1,
						    'position'=>TabsX::POS_LEFT,
//						    'sideways'=>true,
			 					'bordered'=>true,
						    'encodeLabels'=>false,
				    ]);
				?>
</div>
<?php Pjax::end(); ?>


