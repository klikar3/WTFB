<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedersektionenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliedersektionens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliedersektionen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Mitgliedersektionen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'msekt_id',
            'mitglied_id',
            'sektion_id',
            'vdatum',
            'vermittler_id',
            'pdatum',
            'pruefer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
