<?php

use yii\helpers\Html;
use yii\helpers\Url;
/*use yii\grid\GridView; */
use kartik\grid\GridView;
 


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliederliste');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
          <div class="row">

            <div id="content" class="col-sm-12">

    <p>
        <?= Html::a(Yii::t('app', 'Neues Mitglied anlegen', [
    			'modelClass' => 'Mitglieder',
				]), ['/mitglieder/create'], [ 'class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\ActionColumn',
            	'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete}',
							'controller' => 'mitglieder',
							'width' => '100px',
/*							'dropdown' => true,     */
						],
             ['format' => 'raw',
             'attribute' => 'NameLink',
            ],
//						'Name',
//            'Vorname',
            'Schulname',
            'LeiterName',
            'DispName', 
            'Vertrag',
        ],
/*        'export' => true,    */
        'responsive' => true,    
				'toolbar' => [
						'{export}',
						'{toggleData}',
				],
		]); ?>
            </div><!-- content -->

         </div>

</div>
