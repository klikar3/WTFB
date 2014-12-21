<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Mitglieder',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitglieders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
