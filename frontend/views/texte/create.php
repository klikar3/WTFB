<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Texte */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Texte',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Textes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="texte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
