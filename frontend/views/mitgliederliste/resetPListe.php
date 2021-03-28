<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\helpers\Url;
/*use yii\grid\GridView; */
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
 


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitgliederliste');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-index">

    <h1><?= Html::encode($this->title) ?></h1>

</div>
