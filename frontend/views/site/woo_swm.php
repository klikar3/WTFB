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
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;


/* @var $this yii\web\View */
$this->title = 'WooCommerce - Superwebmailer Abgleich';
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);

if (Yii::$app->controller->action->id == 'woo-swm-abgleich') {
  $this->title = 'WooCommerce-WT-Shop - Superwebmailer Abgleich';
  $zielSwm = ['site/get-swm-data',];
  $zielWoo = ['site/get-woo-data',];
  $mli = 14;
  $fi = 4;
  $bt = 'In Newsletter für Dvd-Besteller eintragen';  
}  
if (Yii::$app->controller->action->id == 'woo-aka-swm-abgleich') {
  $this->title = 'WooCommerce-OnlineAkdemie-Shop - Superwebmailer Abgleich';
  $zielSwm = ['site/get-aka-swm-data',];
  $zielWoo = ['site/get-aka-woo-data',];  
  $mli = 14;
  $fi = 5;
  $bt = 'In Newsletter für Online-Akademie-Besteller eintragen';  
}  
 ?> 
<div class="row card bg-info panel panel-info">
  <div class="card card-header my-card panel-heading"> 
          <?= Html::encode($this->title) ?>
  </div>     
<div class="card card-body panel-body"> 
    <div class="row"> 
      <div class="col-md-5" style="text-align:left;"> 
        Anzahl Datensätze in Swm: <?= $swmRows ?>   
      </div>
      <div class="col-md-5" style="text-align:left;"> 
        <?= Html::a('SWM Daten holen', Url::toRoute($zielSwm), ['class' => 'btn btn-success', ]) ?>
        <br><br>
      </div>
    </div>
    <div class="row"> 
      <div class="col-md-5" style="text-align:left"> 
        Anzahl Datensätze in Woo: <?= $wooRows ?>   
     </div>
      <div class="col-md-5" style="text-align:left"> 
        <?= Html::a('Woo Daten holen', Url::toRoute($zielWoo), ['class' => 'btn btn-success', ]) ?>
        <br><br>
     </div>
    </div>
    
    <div class="row">
      <div class="col-12" style="text-align:left">     
     
        <?php if (!empty($dataProvider)) echo GridView::widget([
            'dataProvider' => $dataProvider,
//            'filterModel' => ($print==0) ? $searchModel : false,
            'filterModel' => false,
//            'layout'=>"{items}",
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
//            'showPageSummary' => true,
            'tableOptions' => [
                'style' => 'font-size: 10pt!important;font-weight:normal;',
            ],
    //        'emptyCell'=>'-',
            'columns' => [
    //            ['attribute' => 'msID', 'width' => '60px'],
                ['class' => 'kartik\grid\SerialColumn'],
                'email',
                'vorname',
                'nachname',
    
                ['class' => '\kartik\grid\ActionColumn', 'width' => '25em',
                  	'template' => '<div class="row"><div class="col-sm-6">{eintragen} </div>&nbsp;<div class="col-sm-5">{blockieren}</div></div>',
//      							'controller' => 'site',
      							'mergeHeader' => false,
      //							'label' => 'Aktion',
      							'buttons' => [ 
      								'eintragen' => function ($url, $model) use ($fi, $mli, $bt){
      									return  Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model['email']]) 
                              . Html::hiddenInput('MailingListId', $mli)
                              . Html::hiddenInput('FormId', $fi)
                              . Html::hiddenInput('FormEncoding', 'utf-8')
                              . Html::hiddenInput('u_EMail', $model['email'],['id' => "u_EMail"])
                              . Html::hiddenInput('u_FirstName', $model['vorname'],['id' => "u_FirstName"])
                              . Html::hiddenInput('u_LastName', $model['nachname'],['id' => "u_LastName"])
                              . Html::hiddenInput('Action', 'subscribe')
                              . Html::submitButton('<span class="fas fa-envelope glyphicon glyphicon-envelope"></span>&nbsp;NL eintragen', 
                                                        ['class' => 'btn btn-sm btn-success', 
                                                        'title' => $bt,
//                                                        'style' => 'font-size: 8pt!important;'
                                                        ])
                              . Html::endForm(); 
                  
      							    },
      								'blockieren' => function ($url, $model) {
//                          Yii::warning($model['email']) ;
      									return Html::a('<span class="fas fa-trash glyphicon glyphicon-remove" style="color:red"></span>&nbsp;Blockieren',
                            Url::to(['site/block', 'email' => $model['email'] ]), [
                					'target'=>'_blank',
      										'class' => 'btn btn-sm btn-danger', 'title' => 'Für Newsletter blockieren',
                          'id' => 'block'.$model['id'],
//                          'style' => 'font-size: 8pt!important;'
      							        ]);
      							    }
      							    
      							],
                ],
           ],     
        ]); ?>
      </div>  
    </div>
  </div>    
</div>    
