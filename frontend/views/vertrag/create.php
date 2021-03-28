<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vertrag */

$this->title = Yii::t('app', 'Create Vertrag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vertrags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vertrag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
