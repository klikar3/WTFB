<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Anrede */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Anrede',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anredes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anrede-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
