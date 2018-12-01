<?php
use yii\data\ArrayDataProvider;
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

<div class="row">
<div class="col-md-6">   
  <?php echo $content_grade; ?>  
</div>
<div class="col-md-6">
  <?php echo $content_sekt;
  ?>
</div>
</div>

<?php if (1==0) {?>

<?php // Pjax::begin(['id'=>'pjaxGridView_'.$model->MitgliederId,]); ?>
<div class="row  hidden-xs hidden-sm hidden-md hidden-lg hidden-xl">
<div class="col-md-6 ">
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


<?php //Pjax::end(); ?>

<?php 

$data = [
    ['id' => 1, 'name' => 'Prüfungen',],
    ['id' => 2, 'name' => 'Programme',],
];

$provider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => false,
    'sort' => false,
]);

// get the rows in the currently requested page
$rows = $provider->getModels();

echo GridView::widget([
	        'dataProvider' => $provider,
	        'responsiveWrap' => false,
          'headerRowOptions' => [ 'style' => 'font-size:0.85em', 'hidden' => true
//					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
					],
          'summary' => false,
					'rowOptions' => [ 'style' => 'font-size:0.85em',
					],
	        'columns' => [
							[ 'class' => '\kartik\grid\ExpandRowColumn',
                'options' => ['id' => 'exp_row', //function ($data, $model, $key, $index ) { return 'exp_row_'.(string)$key;},
                ], 
                'value' => function ($data, $model, $key, $index ) use ($openv) { 
//                				($data->msID == $openv) ? GridView::ROW_EXPANDED : GridView::ROW_COLLAPSED;
/*                				if ($data->id == $openv) 
													return GridView::ROW_EXPANDED;
												else 	
*/                        	return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $model, $key, $index) use ($content_grade, $content_sekt) {
	                return ($key == 0) ? $content_grade : $content_sekt;
            		},
            		'enableRowClick' => true,
                'hidden' => false,
							],
							[ 'attribute' => 'name', 'value' => 'name' ],
				],
    			'options' => ['htmlOptions' => [
      											'style' => 'overflow-y:scroll;height:800px;text-size:0.8em;',
  											],
					],				
	    ]);

?>
</div>

<?php }?>

