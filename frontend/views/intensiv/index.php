<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\IntensivSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Intensiv');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Create Intensiv'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mitgliederId',
            'kontaktNachricht:ntext',
            'telefonatAm', 
            'alter',
            'graduierung',
            //'wieLangeWt',
            //'ausbQuali',
            //'unterrichtet',
            //'eigeneSchule',
            //'eigeneLehrer',
            //'organisation',
            //'erfAndereStile',
            //'ziel',
            //'wievielZeit',
            //'trainingsPartner',
            //'erstTermin',
            //'bemerkung:ntext',

            ['class' => 'yii\grid\ActionColumn',                 
             'options' => [
                    'style' => 'width:6em;',
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
