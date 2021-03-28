<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefer */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Pruefer',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pruefer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pruefer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
