<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\InteressentVorgaben */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Interessent Vorgaben',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Interessent Vorgabens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interessent-vorgaben-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
