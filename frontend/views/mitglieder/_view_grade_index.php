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

$content_grade = $this->render('_view_grade', array(
		                                'model'=>$model, 'grade' => $grade, 'tabnum' => 5, 'openv' => $openv, 
																		'grade_zur_auswahl' => $grade_zur_auswahl, 'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
		                        ) );
$content_sekt =  $this->render('_view_sektionen', array(
		                                'model'=>$model, 'sektionen' => $sektionen, 'tabnum' => 5, 'openv' => $openv, 
																		'sektionen_zur_auswahl' => $sektionen_zur_auswahl, 'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
		                        ) );                           

$items1 = [
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Graduierung',
            'id' => 'grade',
						'content' => $content_grade,
//						'active' => $tabnum == 5?true:false,				
				],
				[
				    'label'=>'<i class="glyphicon glyphicon-ok-sign"></i> Sektion',
            'id' => 'sektionen',
						'content'=>$content_sekt,
//						'active' => $tabnum == 5?true:false,				
				],
];

$this->title = $model->MitgliedsNr;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieder'), 'url' => ['/mitgliederliste/index']];
//$this->params['breadcrumbs'][] = $this->title;

if($model->hasErrors()){
  echo BaseHtml::errorSummary($model);
}?>
<?php if (1==0) {?>
<div class="hidden-xs hidden-sm hidden-md hidden-lg"> XL </div>
<div class="hidden-xs hidden-sm hidden-md hidden-xl"> LG </div>
<div class="hidden-xs hidden-sm hidden-lg hidden-xl"> MD </div>
<div class="hidden-xs hidden-md hidden-lg hidden-xl"> SM </div>
<div class="hidden-sm hidden-md hidden-lg hidden-xl"> XS </div>
<?php }?>

<div class="row hidden-xs hidden-sm">
<div class="col-md-6">   
  <?php echo $content_grade; ?>  
</div>
<div class="col-md-6">
  <?php echo $content_sekt;
  ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjaxGridView_'.$model->MitgliederId,]); ?>
<div class="hidden-xs hidden-md hidden-lg hidden-xl">
		        <?php /*echo Html::a(Yii::t('app', 'Zurück'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:history.go(-1);return false;",'class'=>'btn btn-sm btn-primary',
		        ])*/ ?>
		        <?php // Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            //'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        //]) 
						?>				
				<?php    // Ajax Tabs Left
				    echo TabsX::widget([
				    		'id' => 'main-grade-t',
						    'enableStickyTabs' => true,
						    'items'=>$items1,
						    'position'=>TabsX::POS_ABOVE,
		//				    'height' => TabsX::SIZE_LARGE,
			 					'bordered'=>true,
						    'encodeLabels'=>false,
				    ]);
				?>
</div>
<div class="hidden-sm  hidden-md hidden-lg hidden-xl">
				<?php    // Ajax Tabs Left
				    echo TabsX::widget([
				    		'id' => 'main-grade-l',
						    'enableStickyTabs' => true,
						    'items'=>$items1,
						    'position'=>TabsX::POS_LEFT,
						    'sideways'=>true,
			 					'bordered'=>true,
						    'encodeLabels'=>false,
				    ]);
				?>
</div>

<?php Pjax::end(); ?>


