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
$this->title = 'Schülerzahlen';
$this->params['breadcrumbs'][] = $this->title.' für '.$model->von;
//RGraphAsset::register($this);

$schulen = ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp' );
$schulauswahl = (Yii::$app->user->identity->username == 'evastgt') ? [18 => "Stuttgart K"] + $schulen : $schulen;
//Yii::warning(VarDumper::dumpAsString($schulen),'application');
//Yii::warning(VarDumper::dumpAsString($schulauswahl),'application');

 //echo VarDumper::dumpAsString($dataProvider->query->createCommand()->getRawSql())
 $diesesJahr = \DateTime::createFromFormat('Y-m-d', $model->von)->format('Y');
 $dieserMonat = \DateTime::createFromFormat('Y-m-d', $model->von)->format('m');
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
            [ 'attribute' => 'Grad',
              'label' => 'Grad',
              'value' => function ($data) {
                  return !empty($data->mgl->Grad) ? $data->mgl->Grad : '-';
                  },
            ],
            ['attribute' => 'VDatum',
              'label' => 'Vertrag',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->VDatum)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'Von',
              'label' => 'Eintritt',
             'value' => function ($data) {
                  return \DateTime::createFromFormat('Y-m-d', $data->Von)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'KuendigungAm',
              'label' => 'Kündigung',
             'value' => function ($data) {
                  return (($data->KuendigungAm == '0000-00-00') or empty($data->KuendigungAm)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->KuendigungAm)->format('d.m.Y');
                  }
            ], 
            ['attribute' => 'Bis',
              'label' => 'Austritt',
             'value' => function ($data) {
                  return (($data->Bis == '0000-00-00') or empty($data->Bis)) ? '' : \DateTime::createFromFormat('Y-m-d', $data->Bis)->format('d.m.Y');
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
              'label' => 'Anteilig',
              'value' => function ($data) use ($diesesJahr, $dieserMonat) {
                  Yii::warning(VarDumper::dumpAsString($data),'application');
                  //von und bis nicht in diesem Jahr
                  $aussetzenVon = empty($data->BeitragAussetzenVon)  ? '1900-01-01' : $data->BeitragAussetzenVon;
                  $aussetzenBis = empty($data->BeitragAussetzenBis)  ? '1900-01-01' : $data->BeitragAussetzenBis;                  
                  $vonJahr = \DateTime::createFromFormat('Y-m-d', empty($data->Von) ? '1900-01-01' : $data->Von)->format('Y');
                  $bisJahr = \DateTime::createFromFormat('Y-m-d', empty($data->Bis) ? '2999-01-01' : $data->Bis)->format('Y');
                  Yii::warning('vonjahr '.$vonJahr);
                  Yii::warning('bisjahr '.$bisJahr);
                  //Yii::warning('bisjahr '.\DateTime::createFromFormat('Y-m-d', $data->Bis)->format('Y'));
                  Yii::warning('aussetzenvon '.\DateTime::createFromFormat('Y-m-d', $aussetzenVon)->format('m'));
                  Yii::warning('$dieserMonat '.$dieserMonat);
                  if (($vonJahr != $diesesJahr ) and ($bisJahr != $diesesJahr)) { 
                    if ((\DateTime::createFromFormat('Y-m-d', $aussetzenVon)->format('m') <= $dieserMonat) and
                        (\DateTime::createFromFormat('Y-m-d', $aussetzenBis)->format('m') >= $dieserMonat) )
                       { return 0.00; 
                    } else {    
                      return $data->MonatsBeitrag; 
                    }
                  }
                  
                  // von ist in diesem Jahr  
                  if ($vonJahr == $diesesJahr) {
                    if (\DateTime::createFromFormat('Y-m-d', $data->Von)->format('m') == $dieserMonat) {
            		      return number_format($data->MonatsBeitrag * ((\DateTime::createFromFormat('Y-m-d', $data->Von)->format('t')-\DateTime::createFromFormat('Y-m-d', $data->Von)->format('j')+1) / \DateTime::createFromFormat('Y-m-d', $data->Von)->format('t')),2); 
                    }
                    else { if (\DateTime::createFromFormat('Y-m-d', $data->Von)->format('m') > $dieserMonat) {
                             return 0.00; 
                           }
                           else {
                             if ((\DateTime::createFromFormat('Y-m-d', $aussetzenVon)->format('m') <= $dieserMonat) and
                                (\DateTime::createFromFormat('Y-m-d', $aussetzenBis)->format('m') >= $dieserMonat) )
                               { return 0.00; 
                             } else {    
                               return $data->MonatsBeitrag; 
                             }
                           }
                         }
                  }
                  
                  // bis ist in diesem Jahr
                  if ($bisJahr == $diesesJahr) {
                    if (\DateTime::createFromFormat('Y-m-d', $data->Bis)->format('m') == $dieserMonat) {
            		       return number_format($data->MonatsBeitrag * (\DateTime::createFromFormat('Y-m-d', $data->Bis)->format('j')/\DateTime::createFromFormat('Y-m-d', $data->Bis)->format('t')),2); 
                    } else {
                       if (\DateTime::createFromFormat('Y-m-d', $data->Bis)->format('m') < $dieserMonat) {
                         return 0.00;
                       } else {
                           if ((\DateTime::createFromFormat('Y-m-d', $aussetzenVon)->format('m') <= $dieserMonat) and
                               (\DateTime::createFromFormat('Y-m-d', $aussetzenBis)->format('m') >= $dieserMonat) )
                             { return 0.00; 
                           } else {    
                             return $data->MonatsBeitrag; 
                           }
                       }
                    }   
                  }
                },
          		 'contentOptions' => ['style' => 'font-size: 11pt!important;font-weight:normal;'],
            ],
            [
              'label' => Yii::t('app', 'A'),
              'value' => function ($data) use ($diesesJahr, $dieserMonat) {
                          $aussetzenVon = empty($data->BeitragAussetzenVon)  ? '1900-01-01' : $data->BeitragAussetzenVon;
                          $aussetzenBis = empty($data->BeitragAussetzenBis)  ? '1900-01-01' : $data->BeitragAussetzenBis;                  
                          $vonJahr = \DateTime::createFromFormat('Y-m-d', $data->Von)->format('Y');
                          $bisJahr = \DateTime::createFromFormat('Y-m-d', empty($data->Bis) ? '1900-01-01' : $data->Bis)->format('Y');                        
                          if ((\DateTime::createFromFormat('Y-m-d', $aussetzenVon)->format('m') <= $dieserMonat) and
                               (\DateTime::createFromFormat('Y-m-d', $aussetzenBis)->format('m') >= $dieserMonat) )
                             { return 'A'; 
                           } else {    
                             return ''; 
                           }  
                          }
            ],
//            'VertragId',

//            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>
</div>
