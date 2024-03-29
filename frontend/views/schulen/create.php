<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Schulen */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Schulen',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schulen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
