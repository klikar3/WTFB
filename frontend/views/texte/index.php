<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TexteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Texte');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="texte-index">

    <p>
        <?= Html::a(Yii::t('app', 'Text erstellen', [
    'modelClass' => 'Texte',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],
						[ 'class' => 'yii\grid\SerialColumn'],
	           'id',
  	         'code',
  	         'SchulId',
    	       'fuer',
      	     'txt:ntext',
             'betreff', 
		        'quer',         
				],
    ]); ?>

</div>
