<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\grid\GridView;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

use frontend\models\AuswertungenForm;
use frontend\models\Schulen;
use frontend\models\Mitglieder;


/* @var $this yii\web\View */
$this->title = 'DVDListe';
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);

$schulen = ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp' );
$schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
//Yii::warning(VarDumper::dumpAsString($schulen),'application');
//Yii::warning(VarDumper::dumpAsString($schulauswahl),'application');
 if (1==0){
?>
<div class="row">
  <div class="col-md-3"> </div>   
  <div class="col-md-4"> 
  <div class="panel panel-info"> 
    <div class="panel-heading" style="margin: 5px;padding:5px;">   
    <h4><?= Html::encode($this->title.' für') ?></h4>
    </div>
    <div class="panel-body" style="margin: 5px;padding:5px;">   
			<?php 
		 			$form = ActiveForm::begin( ['method' => 'post',
					 														'action' => Url::to(['site/schuelerzahlen',]),
																			'type' => ActiveForm::TYPE_HORIZONTAL,																																
																		 ]	); 
			?>
			<?php /*$form->field($model, 'schule')->dropDownList( ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp', 'disziplinen.DispName' ),
							['multiple'=>'multiple',
//							'style'=>'width:200px'
                ])										
									->label(false); 
*/			?>
      <?= $form->field($model, 'schule')->widget(Select2::classname(), [
          'data' => $schulauswahl,
          'language' => 'de',
          'options' => ['multiple' => true, 'placeholder' => 'Schule auswählen ...'],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ])->label(false);
			?>
					<div style="text-align: right;padding-bottom:5px;">
					<?= Html::submitButton('Auswählen', ['class'=>'btn btn-sm btn-primary']);
					?>
					</div>
			<?php 
				$form = ActiveForm::end();
		 	?>

  </div>
  </div>
  </div> 
</div>
<?php } ?> 
<?php
 //echo VarDumper::dumpAsString($dataProvider->query->createCommand()->getRawSql())
?>
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            window.print();
        });
    </script>

   <div class="row"> 
      <div class="col-md-6">
          <h1><?= Html::encode($this->title) ?></h1>
      </div>  
      <div class="col-md-6" style="text-align:right">    
   <?= ($print == 0) ? Html::a('Druckversion',Url::toRoute(['site/dvdliste', 'schule' => $schule, 'print' => 1]),['class' => 'btn btn-primary']) : '' ?>
        <?php
          if ($print == 1) {
        ?>
          <form id="form1">
            <input type="button" value="Drucken" id="btnPrint" class="btn btn-primary"/>
          </form>
        <?php
          }
        ?> 
      </div>
   </div>
   <?php if (!empty($print)) {$dataProvider->sort = false; $dataProvider->pagination = false;} ?>

<div class="row">
 
 
    <?php if (!empty($dataProvider)) echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'filterModel' => false,
        'layout'=>"{items}",
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'showPageSummary' => true,
        'tableOptions' => [
            'style' => 'font-size: 11pt!important;font-weight:normal;',
        ],
//        'emptyCell'=>'-',
        'columns' => [
//            ['attribute' => 'msID', 'width' => '60px'],
            ['attribute' => 'Name',
             'format' => 'raw', 
             'width' => '200px',
              'label' => 'Name',
              'value' => function ($data) {
//                  Yii::warning(VarDumper::dumpAsString($data),'application');
          		    $url = Url::to(['/mitglieder/view', 'id'=>$data->MitgliederId, 'tabnum' => 1]); // your url code to retrieve the profile view
          		    $options = ['target' => '_blank']; // any HTML attributes for your link
          		    return Html::a($data->Name, $url, $options); // assuming you have a relation called profile
//                  return $data->Nachname.', '.$data->Vorname;
//                  return empty($data->NameLink) ? $data->NameLink : '-';
                  },
          		 'contentOptions' => ['style' => 'font-size: 11pt!important;font-weight:normal;'],
            ],
//            'mitglieder.Vorname',
//            'mitglieder.Name',
            [ 'attribute' => 'Vertrag',
              'label' => 'Schule',
              'value' => function ($data) {
                  return !empty($data->mgl->Vertrag) ? $data->mgl->Vertrag /*. $data->schul->dispKurz*/ : '-';
                  },
        		 'contentOptions' => ['style' => 'font-size: 11pt!important;font-weight:normal;'],
            ],
            [ 'attribute' => 'SchulId',
              'visible' => false,
            ],
            ['attribute' => 'Von',
              'label' => 'Eintritt',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Von)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'Bis',
              'label' => 'Austritt',
             'value' => function ($data) {
                  return (($data->Bis == '0000-00-00') or empty($data->Bis)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->Bis)->format('d.m.Y');
                  }
            ], 
            [ 'attribute' => 'DVDgesendetAm',
              'label' => 'DVD am',
              'value' => function ($data) {
                  return !empty($data->mitglieder->DVDgesendetAm) ? \DateTime::createFromFormat('Y-m-d', $data->mitglieder->DVDgesendetAm)->format('d.m.Y') : '-';
                  },
            ],
            [ 'attribute' => 'letzteDVD',
              'label' => 'Letzte DVD',
              'value' => function ($data) {
                  return !empty($data->mitglieder->letzteDvd) ? $data->mitglieder->letzteDvd : '-';
                  },
            ],
/*
//             'enableSorting' => ($print == 1) ? false : true,
             'width' => '100px',
             'pageSummary' => true,
            ],
*/            
//            'VertragId',

//            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>
</div>
