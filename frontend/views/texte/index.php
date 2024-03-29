<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TexteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Texte');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Text erstellen', [
    'modelClass' => 'Texte',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
    						'template' => '{update}&nbsp;&nbsp;&nbsp;{delete}',
								'controller' => 'texte',
								'header' => '<center>Aktion</center>',
                 'options' => [
                    'style' => 'width:70px;',
                ],
								'buttons' => [ 
/*									'email' => function ($url, $model) {
										return ''.Html::a('<span class="glyphicon glyphicon-envelope"></span>', 
																	Url::toRoute(['/texte/print', 'datamodel' => 'vertrag', 'txtid' => 0 ] ), [
            					'target'=>'_blank',
											'title' => Yii::t('app', 'Email Erzeugen'),
								        ]) . '';
								    }, */
								], 
							],
//						[ 'class' => 'yii\grid\SerialColumn'],
	           'id',
  	         'code',
  	         ['attribute' => 'SchulId',
              'value' => function ($data) { return $data->schul->SchulDisp;},
              ],
    	       'fuer',
//      	     'txt:ntext',
             'betreff', 
		        'quer',         
				],
    ]); ?>

</div>
