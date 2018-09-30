<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederschulenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliederschulen');
$this->params['breadcrumbs'][] = $this->title;

// Set LinkPager defaults
\Yii::$container->set('yii\widgets\LinkPager', [
        'options' => ['class' => 'pagination'],
        'firstPageCssClass' => 'prev',
        'lastPageCssClass' => 'next',
        'prevPageCssClass' => 'prev',
        'nextPageCssClass' => 'next',
        'activePageCssClass' => 'active',
        'disabledPageCssClass' => 'disabled',
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last'
]);  
?>
<div class="mitgliederschulen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Mitgliederschulen',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'NameLink',
             'format' => 'raw', 
//             'value' => function ($data) { return Html::a($data->msID, Url::to(['/mitglieder/view', 'id'=>$data->msID, 'tabnum' => 1]), []);},
             'width' => '100px'
            ],
//            'mitglieder.Vorname',
//            'mitglieder.Name',
            'schul.SchulDisp',
            'SchulId',
            'VDatum',
            'Von',
            'Bis',
            'VertragId',
            'MonatsBeitrag',
            'ZahlungsArt',
            'Zahlungsweise',

            ['class' => '\kartik\grid\ActionColumn', 'width' => '60px'],
        ],
    ]); ?>

</div>
