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
     

$this->title = $model->Vorname . ' ' . $model->Name;
$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-view">
  <div class="row">
    <div id="content" class="col-sm-12">
      <div class="row">
		 		<div class="col-sm-4">
		       <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->MitgliederId], ['class' => 'btn btn-primary']) ?>
		        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->MitgliederId], [
		            'class' => 'btn btn-danger',
		            'data' => [
		                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
		                'method' => 'post',
		            ],
		        ]) ?> 
		        <?= Html::a(Yii::t('app', 'Close'), Yii::$app->request->getReferrer(), [
		            'onclick'=>"js:window.close();return false;",'class'=>'btn btn-primary',
		        ]) ?>
				</div>
			</div>
                <p>

	<?= GridView::widget([
	        'dataProvider' => $grade,
//	        'filterModel' => $searchModel,
	        'columns' => [
//	            ['class' => 'yii\grid\SerialColumn'],
//							'MitgliedId', 
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz' ],
							[ 'attribute' => 'Disziplin', 'value' => 'disziplinen.DispKurz' ],
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName' ],
				],
	    ]); ?>
                </p>
			<?php    
					echo $model->MitgliederId;
			?>
    						<?php $form = ActiveForm::begin(['action' => ['mitglieder/mark', 'id' => $model->MitgliederId],
    																							'fieldConfig'=>['showLabels'=>false]]); ?>
							
							<div class="row" style="margin-bottom: 8px">
								<div class="col-sm-10">
							<?=  $form->field($model, 'MitgliederId'); ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($model, 'PruefungZum')->dropdownList(ArrayHelper::map( Grade::find()->all(), 'gradId', 'gKurz', 'DispName' ),
[ 'prompt' => 'Grad' ]
) ?>
								</div>
							</div>
							<?= Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) ?>
							<?php $form = ActiveForm::end(); ?>
    </div><!-- content -->

  </div>

</div>
