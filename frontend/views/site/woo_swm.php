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


/* @var $this yii\web\View */
$this->title = 'WooCommerce - Superwebmailer Abgleich';
$this->params['breadcrumbs'][] = $this->title;
//RGraphAsset::register($this);

 ?> 
<div class="col-sm-1"> 
</div>
<div class="col-sm-10"> 
<div class="row panel panel-info">
  <div class="panel-heading"> 
          <?= Html::encode($this->title) ?>
  </div>     
<div class="panel-body"> 
    <div class="row"> 
      <div class="col-md-3" style="text-align:left;"> 
        Anzahl Datensätze in Swm: <?= $swmRows ?>   
      </div>
      <div class="col-md-2" style="text-align:left;"> 
        <?= Html::a('SWM Daten holen', Url::toRoute(['site/get-swm-data',]), ['class' => 'btn btn-primary', ]) ?>
        <br><br>
      </div>
    </div>
    <div class="row"> 
      <div class="col-md-3" style="text-align:left"> 
        Anzahl Datensätze in Woo: <?= $wooRows ?>   
     </div>
      <div class="col-md-2" style="text-align:left"> 
        <?= Html::a('Woo Daten holen', Url::toRoute(['site/get-woo-data',]), ['class' => 'btn btn-primary', ]) ?>
        <br><br>
     </div>
    </div>
    
    <div class="row">
     
     
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
    
                ['class' => '\kartik\grid\ActionColumn', 'width' => '230px',
                  	'template' => '<div class="col-sm-6">{eintragen} </div>&nbsp;<div class="col-sm-5">{blockieren}</div>',
//      							'controller' => 'site',
      							'mergeHeader' => false,
      //							'label' => 'Aktion',
      							'buttons' => [ 
      								'eintragen' => function ($url, $model) {
      									return  Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model['email']]) 
                              . Html::hiddenInput('MailingListId', 14)
                              . Html::hiddenInput('FormId', 4)
                              . Html::hiddenInput('FormEncoding', 'utf-8')
                              . Html::hiddenInput('u_EMail', $model['email'],['id' => "u_EMail"])
                              . Html::hiddenInput('u_FirstName', $model['vorname'],['id' => "u_FirstName"])
                              . Html::hiddenInput('u_LastName', $model['nachname'],['id' => "u_LastName"])
                              . Html::hiddenInput('Action', 'subscribe')
                              . Html::submitButton('<span class="glyphicon glyphicon-envelope"></span>&nbsp;NL eintragen', 
                                                        ['class' => 'btn btn-sm btn-success', 
                                                        'title' => 'In Newsletter für Dvd-Besteller eintragen',
                                                        'style' => 'font-size: 8pt!important;'])
                              . Html::endForm(); 
                  
      							    },
      								'blockieren' => function ($url, $model) {
//                          Yii::warning($model['email']) ;
      									return Html::a('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;Blockieren',
                            Url::to(['site/block', 'email' => $model['email'] ]), [
                					'target'=>'_blank',
      										'class' => 'btn btn-sm btn-danger', 'title' => 'Für Newsletter blockieren',
                          'id' => 'block'.$model['id'],
                          'style' => 'font-size: 8pt!important;'
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
