<?php
use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\grid\GridView;
use kartik\popover\PopoverX;
use kartik\datecontrol\datecontrol;
use kartik\widgets\DatePicker;

use frontend\models\AuswertungenForm;
use frontend\models\Schulen;
use frontend\models\Mitglieder;

use frontend\controllers\SiteController;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Student numbers');
$this->params['breadcrumbs'][] = $this->title.Yii::t('app', ' for ').Yii::t('app', \DateTime::createFromFormat('d.m.Y',$model->von)->format('F')).' '.\DateTime::createFromFormat('d.m.Y',$model->von)->format('Y');
//RGraphAsset::register($this);

$schulen = ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp' );
$schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
//Yii::warning(VarDumper::dumpAsString($schulen),'application');
//Yii::warning(VarDumper::dumpAsString($schulauswahl),'application');

 //echo VarDumper::dumpAsString($dataProvider->query->createCommand()->getRawSql())
 $diesesJahr = \DateTime::createFromFormat('d.m.Y', $model->von)->format('Y');
 $dieserMonat = \DateTime::createFromFormat('d.m.Y', $model->von)->format('m');
 $monatsBeginn = $model->von;
?>
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
              'label' => Yii::t('app', 'Name'),
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
              'label' => Yii::t('app', 'School'),
              'value' => function ($data) {
                  return !empty($data->mgl->Vertrag) ? $data->mgl->Vertrag /*. $data->schul->dispKurz*/ : '-';
                  },
        		 'contentOptions' => ['style' => 'font-size: 11pt!important;font-weight:normal;'],
            ],
            [ 'attribute' => 'SchulId',
              'visible' => false,
            ],
            [ 'attribute' => 'Grad',
              'label' => Yii::t('app', 'Level'),
              'value' => function ($data) {
                  return !empty($data->mgl->Grad) ? $data->mgl->Grad : '-';
                  },
            ],
            ['attribute' => 'VDatum',
              'label' => Yii::t('app', 'Contract'),
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->VDatum)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'Von',
              'label' => Yii::t('app', 'Entry'),
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Von)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'KuendigungAm',
              'label' => Yii::t('app', 'Termination'),
             'value' => function ($data) {
                  return (($data->KuendigungAm == '0000-00-00') or empty($data->KuendigungAm)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->KuendigungAm)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'Bis',
              'label' => Yii::t('app', 'Exit'),
             'value' => function ($data) {
                  return (($data->Bis == '0000-00-00') or empty($data->Bis)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->Bis)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'BeitragAussetzenVon',
              'label' => Yii::t('app', 'Susp. from'),
             'value' => function ($data) {
                  return (($data->BeitragAussetzenVon == '0000-00-00') or empty($data->BeitragAussetzenVon)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->BeitragAussetzenVon)->format('d.m.Y');
                  }
            ],
            ['attribute' => 'BeitragAussetzenBis',
              'label' => Yii::t('app', 'Susp. to'),
             'value' => function ($data) {
                  return (($data->BeitragAussetzenBis == '0000-00-00') or empty($data->BeitragAussetzenBis)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->BeitragAussetzenBis)->format('d.m.Y');
                  }
            ],
            ['attribute' => 'MonatsBeitrag',
//             'enableSorting' => ($print == 1) ? false : true,
             'width' => '100px',
             'pageSummary' => true,
            ],
            ['attribute' => 'Anteilig',
             'format' => 'raw', 
             'width' => '80px',
             'pageSummary' => true,
              'label' => Yii::t('app', 'Computed'),
              'value' => function ($data) use ($monatsBeginn, $diesesJahr, $dieserMonat)  {
                  return SiteController::computeAnteil  ($data, $monatsBeginn, $diesesJahr, $dieserMonat);
                },
          		 'contentOptions' => ['style' => 'font-size: 11pt!important;font-weight:normal;'],
            ],
            [
              'label' => Yii::t('app', 'A'),
              'value' => function ($data) use ($monatsBeginn, $diesesJahr, $dieserMonat)  {
                  return SiteController::computeA  ($data, $monatsBeginn, $diesesJahr, $dieserMonat);
                },
/*              'value' => function ($data) use ($diesesJahr, $dieserMonat) {
                                // Aussetzen
                                $aussetzenVon = \DateTime::createFromFormat('!Y-m-d', empty($data->BeitragAussetzenVon)  ? '2999-01-01' : substr($data->BeitragAussetzenVon,0,10));
                                $aussetzenBis = \DateTime::createFromFormat('!Y-m-d', empty($data->BeitragAussetzenBis)  ? '1900-01-01' : substr($data->BeitragAussetzenBis,0,10));
                                // Wenn Aussetzen vorbei
                                $firstDayThisMonth = \DateTime::createFromFormat('!Y-m-d', date('Y-m-01'));
                                $firstDayNextMonth = \DateTime::createFromFormat('!Y-m-d', date('Y-m-d', mktime(0, 0, 0, date('m')+1, 1, date('Y'))));
                                //Yii::warning('$firstDayThisMonth '.Vardumper::dumpAsString($firstDayThisMonth));
                                //Yii::warning('$firstDayNextMonth '.Vardumper::dumpAsString($firstDayNextMonth));
                                if ($aussetzenBis < $firstDayThisMonth) {
                                    //Yii::warning('2');
                                    return '';
                                }
                                // wenn Aussetzen noch nicht begonnen hat
                                if ($aussetzenVon >= $firstDayNextMonth) {
                                    //Yii::warning('$firstDayNextMonth '.Vardumper::dumpAsString($firstDayNextMonth));
                                    //Yii::warning('3');
                                    return '';
                                }
                                if (($aussetzenVon <= $firstDayThisMonth) and
                                        ($aussetzenBis >= $firstDayNextMonth ))
                                       { 
                                    //Yii::warning('date(01-m-Y) '.Vardumper::dumpAsString(date('01-m-Y')));
                                    return 'A'; 
                                } 
                                    //Yii::warning('WTF?');
                          }   */
            ],
//            'VertragId',

//            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>
</div>

