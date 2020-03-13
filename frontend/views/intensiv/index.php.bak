<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\IntensivSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Intensiv');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intensiv-index">

    <h1><?= Html::encode($this->title) ?></h1>

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
