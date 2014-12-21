<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiter */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Schulleiter',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulleiters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schulleiter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
